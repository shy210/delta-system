<?php

namespace App\Http\Controllers;

use App\Exports\ServiceComboExport;
use App\Models\Product;
use App\Models\ServiceCombo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ServiceComboController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $serviceCombos = ServiceCombo::query()
            ->with('productos.producto')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where(
                        'codigo',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'nombre',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'descripcion',
                        'like',
                        "%{$search}%"
                    );
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view(
            'service_combos.index',
            compact(
                'serviceCombos',
                'search'
            )
        );
    }

    public function create()
    {
        $products = Product::query()
            ->orderBy('nombre')
            ->get();

        return view(
            'service_combos.create',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'service_combos',
                    'codigo'
                ),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'precio_venta' => [
                'required',
                'numeric',
                'min:0',
            ],

            'productos' => [
                'required',
                'array',
                'min:1',
            ],

            'productos.*.product_id' => [
                'required',
                'exists:products,id',
            ],

            'productos.*.cantidad' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'activo' => [
                'nullable',
                'boolean',
            ],
        ], [
            'codigo.required' =>
                'El código es obligatorio.',

            'codigo.unique' =>
                'El código ya está registrado.',

            'nombre.required' =>
                'El nombre del servicio es obligatorio.',

            'precio_venta.required' =>
                'El precio de venta es obligatorio.',

            'precio_venta.numeric' =>
                'El precio de venta debe ser numérico.',

            'precio_venta.min' =>
                'El precio de venta no puede ser negativo.',

            'productos.required' =>
                'Debes agregar al menos un producto.',

            'productos.min' =>
                'Debes agregar al menos un producto.',

            'productos.*.product_id.required' =>
                'Debes seleccionar un producto.',

            'productos.*.product_id.exists' =>
                'Uno de los productos seleccionados no existe.',

            'productos.*.cantidad.required' =>
                'La cantidad es obligatoria.',

            'productos.*.cantidad.min' =>
                'La cantidad debe ser mayor a cero.',
        ]);

        $productos = $request->input(
            'productos',
            []
        );

        $productIds = collect($productos)
            ->pluck('product_id')
            ->filter()
            ->values();

        if (
            $productIds->count() !==
            $productIds->unique()->count()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'productos' =>
                        'No puedes agregar el mismo producto más de una vez al combo.',
                ]);
        }

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $costoTotal = 0;

        foreach ($productos as $item) {
            $product = $products->get(
                $item['product_id']
            );

            if (!$product) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'productos' =>
                            'Uno de los productos seleccionados no existe.',
                    ]);
            }

            $costoTotal +=
                (float) $item['cantidad'] *
                (float) $product->costo_compra;
        }

        $precioVenta =
            (float) $validated['precio_venta'];

        $ganancia =
            $precioVenta - $costoTotal;

        DB::transaction(function () use (
            $validated,
            $productos,
            $costoTotal,
            $ganancia
        ) {
            $combo = ServiceCombo::create([
                'codigo' =>
                    $validated['codigo'],

                'nombre' =>
                    $validated['nombre'],

                'descripcion' =>
                    $validated['descripcion'] ?? null,

                'precio_venta' =>
                    $validated['precio_venta'],

                'costo_total' =>
                    $costoTotal,

                'ganancia' =>
                    $ganancia,

                'activo' =>
                    array_key_exists(
                        'activo',
                        $validated
                    )
                        ? request()->boolean('activo')
                        : true,
            ]);

            foreach ($productos as $item) {
                $combo->productos()->create([
                    'product_id' =>
                        $item['product_id'],

                    'cantidad' =>
                        $item['cantidad'],
                ]);
            }
        });

        return redirect()
            ->route('service-combos.index')
            ->with(
                'success',
                'Servicio combo creado correctamente.'
            );
    }

    public function show(
        ServiceCombo $serviceCombo
    ) {
        $serviceCombo->load(
            'productos.producto'
        );

        return view(
            'service_combos.show',
            compact('serviceCombo')
        );
    }

    public function edit(
        ServiceCombo $serviceCombo
    ) {
        $serviceCombo->load(
            'productos.producto'
        );

        $products = Product::query()
            ->orderBy('nombre')
            ->get();

        return view(
            'service_combos.edit',
            compact(
                'serviceCombo',
                'products'
            )
        );
    }

    public function update(
        Request $request,
        ServiceCombo $serviceCombo
    ) {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'service_combos',
                    'codigo'
                )->ignore($serviceCombo->id),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'precio_venta' => [
                'required',
                'numeric',
                'min:0',
            ],

            'productos' => [
                'required',
                'array',
                'min:1',
            ],

            'productos.*.product_id' => [
                'required',
                'exists:products,id',
            ],

            'productos.*.cantidad' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'activo' => [
                'nullable',
                'boolean',
            ],
        ]);

        $productos = $request->input(
            'productos',
            []
        );

        $productIds = collect($productos)
            ->pluck('product_id')
            ->filter()
            ->values();

        if (
            $productIds->count() !==
            $productIds->unique()->count()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'productos' =>
                        'No puedes agregar el mismo producto más de una vez al combo.',
                ]);
        }

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $costoTotal = 0;

        foreach ($productos as $item) {
            $product = $products->get(
                $item['product_id']
            );

            if (!$product) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'productos' =>
                            'Uno de los productos seleccionados no existe.',
                    ]);
            }

            $costoTotal +=
                (float) $item['cantidad'] *
                (float) $product->costo_compra;
        }

        $precioVenta =
            (float) $validated['precio_venta'];

        $ganancia =
            $precioVenta - $costoTotal;

        DB::transaction(function () use (
            $serviceCombo,
            $validated,
            $productos,
            $costoTotal,
            $ganancia
        ) {
            $serviceCombo->update([
                'codigo' =>
                    $validated['codigo'],

                'nombre' =>
                    $validated['nombre'],

                'descripcion' =>
                    $validated['descripcion'] ?? null,

                'precio_venta' =>
                    $validated['precio_venta'],

                'costo_total' =>
                    $costoTotal,

                'ganancia' =>
                    $ganancia,

                'activo' =>
                    array_key_exists(
                        'activo',
                        $validated
                    )
                        ? request()->boolean('activo')
                        : $serviceCombo->activo,
            ]);

            $serviceCombo
                ->productos()
                ->delete();

            foreach ($productos as $item) {
                $serviceCombo->productos()->create([
                    'product_id' =>
                        $item['product_id'],

                    'cantidad' =>
                        $item['cantidad'],
                ]);
            }
        });

        return redirect()
            ->route('service-combos.index')
            ->with(
                'success',
                'Servicio combo actualizado correctamente.'
            );
    }

    public function destroy(
        ServiceCombo $serviceCombo
    ) {
        $serviceCombo->delete();

        return redirect()
            ->route('service-combos.index')
            ->with(
                'success',
                'Servicio combo eliminado correctamente.'
            );
    }

    /**
     * Exportar servicios combo a Excel.
     */
    public function exportExcel()
    {
        return Excel::download(
            new ServiceComboExport(),
            'servicios-combo.xlsx'
        );
    }

    /**
     * Exportar servicios combo a PDF.
     */
    public function exportPdf(
        Request $request
    ) {
        $search = $request->input('search');

        $combos = ServiceCombo::query()
            ->with('productos.producto')
            ->when($search, function (
                $query,
                $search
            ) {
                $query->where(function ($q) use (
                    $search
                ) {
                    $q->where(
                        'codigo',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'nombre',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'descripcion',
                        'like',
                        "%{$search}%"
                    );
                });
            })
            ->orderBy('nombre')
            ->get();

        $pdf = Pdf::loadView(
            'service_combos.pdf',
            compact(
                'combos',
                'search'
            )
        );

        $pdf->setPaper(
            'letter',
            'landscape'
        );

        return $pdf->download(
            'servicios-combo-' .
            now()->format('Y-m-d-His') .
            '.pdf'
        );
    }
}