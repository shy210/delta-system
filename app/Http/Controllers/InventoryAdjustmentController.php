<?php

namespace App\Http\Controllers;

use App\Exports\InventoryAdjustmentExport;
use App\Models\InventoryAdjustment;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class InventoryAdjustmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $adjustments = InventoryAdjustment::query()
            ->with([
                'producto',
                'usuarioRegistro',
                'usuarioAprobo',
            ])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tipo', 'like', "%{$search}%")
                        ->orWhere('descripcion', 'like', "%{$search}%")
                        ->orWhere('codigo_barras', 'like', "%{$search}%")
                        ->orWhere('estatus', 'like', "%{$search}%")
                        ->orWhereHas('producto', function ($productQuery) use ($search) {
                            $productQuery
                                ->where('nombre', 'like', "%{$search}%")
                                ->orWhere('codigo', 'like', "%{$search}%");
                        })
                        ->orWhereHas('usuarioRegistro', function ($userQuery) use ($search) {
                            $userQuery
                                ->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('inventory_adjustments.index', compact(
            'adjustments',
            'search'
        ));
    }

   public function create()
{
    $products = Product::query()
        ->orderBy('nombre')
        ->get();

    return view('inventory_adjustments.create', compact('products'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => ['required', 'in:entrada,salida'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'product_id' => ['required', 'exists:products,id'],
            'cantidad' => ['required', 'numeric', 'min:0.01'],
            'codigo_barras' => ['nullable', 'string', 'max:255'],
        ], [
            'tipo.required' => 'Selecciona el tipo de ajuste.',
            'tipo.in' => 'El tipo de ajuste no es válido.',
            'product_id.required' => 'Selecciona un producto.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'cantidad.required' => 'Ingresa la cantidad.',
            'cantidad.numeric' => 'La cantidad debe ser numérica.',
            'cantidad.min' => 'La cantidad debe ser mayor a cero.',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $validated['codigo_barras'] = $product->codigo;

        InventoryAdjustment::create([
            'tipo' => $validated['tipo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'product_id' => $product->id,
            'cantidad' => $validated['cantidad'],
            'codigo_barras' => $validated['codigo_barras'],
            'estatus' => 'pendiente',
            'usuario_registro_id' => auth()->id(),
        ]);

        return redirect()
            ->route('inventory-adjustments.index')
            ->with('success', 'Ajuste creado correctamente y enviado a aprobación.');
    }

    public function show(InventoryAdjustment $inventoryAdjustment)
    {
        $inventoryAdjustment->load([
            'producto',
            'usuarioRegistro',
            'usuarioAprobo',
        ]);

        return view(
            'inventory_adjustments.show',
            compact('inventoryAdjustment')
        );
    }

    public function approve(InventoryAdjustment $inventoryAdjustment)
    {
        if ($inventoryAdjustment->estatus !== 'pendiente') {
            return back()->with(
                'error',
                'Este ajuste ya fue procesado anteriormente.'
            );
        }

        DB::transaction(function () use ($inventoryAdjustment) {
            $adjustment = InventoryAdjustment::query()
                ->lockForUpdate()
                ->findOrFail($inventoryAdjustment->id);

            if ($adjustment->estatus !== 'pendiente') {
                throw ValidationException::withMessages([
                    'adjustment' => 'Este ajuste ya fue procesado.',
                ]);
            }

            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($adjustment->product_id);

            $cantidad = (float) $adjustment->cantidad;
            $stockActual = (float) $product->stock;

            if ($adjustment->tipo === 'salida' && $cantidad > $stockActual) {
                throw ValidationException::withMessages([
                    'adjustment' => 'No hay existencia suficiente para aprobar esta salida.',
                ]);
            }

            if ($adjustment->tipo === 'entrada') {
                $product->stock = $stockActual + $cantidad;
            } else {
                $product->stock = $stockActual - $cantidad;
            }

            $product->save();

            $adjustment->update([
                'estatus' => 'aprobado',
                'usuario_aprobo_id' => auth()->id(),
                'fecha_aprobacion' => now(),
            ]);
        });

        return back()->with(
            'success',
            'Ajuste aprobado correctamente y la existencia fue actualizada.'
        );
    }

    public function reject(InventoryAdjustment $inventoryAdjustment)
    {
        if ($inventoryAdjustment->estatus !== 'pendiente') {
            return back()->with(
                'error',
                'Este ajuste ya fue procesado anteriormente.'
            );
        }

        $inventoryAdjustment->update([
            'estatus' => 'rechazado',
            'usuario_aprobo_id' => auth()->id(),
            'fecha_aprobacion' => now(),
        ]);

        return back()->with(
            'success',
            'Ajuste rechazado correctamente.'
        );
    }

    public function destroy(InventoryAdjustment $inventoryAdjustment)
    {
        if ($inventoryAdjustment->estatus === 'aprobado') {
            return back()->with(
                'error',
                'No puedes eliminar un ajuste que ya fue aprobado.'
            );
        }

        $inventoryAdjustment->delete();

        return redirect()
            ->route('inventory-adjustments.index')
            ->with('success', 'Ajuste eliminado correctamente.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new InventoryAdjustmentExport($request->input('search')),
            'ajustes-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $adjustments = $this->adjustmentsQuery($search)
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'inventory_adjustments.export-pdf',
            compact('adjustments', 'search')
        )->setPaper('letter', 'landscape');

        return $pdf->download(
            'ajustes-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    private function adjustmentsQuery(?string $search = null)
    {
        return InventoryAdjustment::query()
            ->with([
                'producto',
                'usuarioRegistro',
                'usuarioAprobo',
            ])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tipo', 'like', "%{$search}%")
                        ->orWhere('descripcion', 'like', "%{$search}%")
                        ->orWhere('codigo_barras', 'like', "%{$search}%")
                        ->orWhere('estatus', 'like', "%{$search}%")
                        ->orWhereHas('producto', function ($productQuery) use ($search) {
                            $productQuery
                                ->where('nombre', 'like', "%{$search}%")
                                ->orWhere('codigo', 'like', "%{$search}%");
                        })
                        ->orWhereHas('usuarioRegistro', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            });
    }
}