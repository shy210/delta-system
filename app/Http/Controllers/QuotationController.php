<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['customer', 'user'])
            ->latest()
            ->paginate(10);

        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $users = User::whereIn('role', [
            'admin',
            'empleado',
        ])
            ->orderBy('name')
            ->get();

        $products = Product::where('activo', true)
            ->orderBy('nombre')
            ->get();

        $services = Service::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return view('quotations.create', compact(
            'customers',
            'users',
            'products',
            'services'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'tipo_precio' => [
                'required',
                'in:publico,mayoreo,tecnicos',
            ],

            'fecha_creacion' => [
                'required',
                'date',
            ],

            'fecha_vencimiento' => [
                'nullable',
                'date',
                'after_or_equal:fecha_creacion',
            ],

            'notas' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.tipo' => [
                'required',
                'in:producto,servicio,manual',
            ],

            'items.*.product_id' => [
                'nullable',
                'exists:products,id',
            ],

            'items.*.service_id' => [
                'nullable',
                'exists:services,id',
            ],

            'items.*.nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.descripcion' => [
                'nullable',
                'string',
            ],

            'items.*.cantidad' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'items.*.precio_unitario' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.descuento' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $quotation = DB::transaction(function () use ($validated) {

            $quotation = Quotation::create([
                'folio' => $this->generateFolio(),
                'customer_id' => $validated['customer_id'],
                'user_id' => $validated['user_id'],
                'tipo_precio' => $validated['tipo_precio'],
                'fecha_creacion' => $validated['fecha_creacion'],
                'fecha_vencimiento' => $validated['fecha_vencimiento'] ?? null,
                'estado' => 'borrador',
                'subtotal' => 0,
                'descuento_total' => 0,
                'total' => 0,
                'notas' => $validated['notas'] ?? null,
            ]);

            $subtotal = 0;
            $descuentoTotal = 0;
            $total = 0;

            foreach ($validated['items'] as $item) {

                $cantidad = (float) $item['cantidad'];
                $precio = (float) $item['precio_unitario'];
                $descuento = (float) ($item['descuento'] ?? 0);

                $importe = $cantidad * $precio;

                $descuentoReal = min($descuento, $importe);

                $totalItem = max(
                    0,
                    $importe - $descuentoReal
                );

                $subtotal += $importe;
                $descuentoTotal += $descuentoReal;
                $total += $totalItem;

                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'tipo' => $item['tipo'],
                    'product_id' => $item['product_id'] ?? null,
                    'service_id' => $item['service_id'] ?? null,
                    'nombre' => $item['nombre'],
                    'descripcion' => $item['descripcion'] ?? null,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'descuento' => $descuentoReal,
                    'total' => $totalItem,
                ]);
            }

            $quotation->update([
                'subtotal' => $subtotal,
                'descuento_total' => $descuentoTotal,
                'total' => $total,
            ]);

            return $quotation;
        });

        return redirect()
            ->route('quotations.show', $quotation)
            ->with('success', 'Cotización creada correctamente.');
    }

    /**
     * Crear producto directamente desde el modal de cotización.
     */
    public function storeProductFromQuotation(Request $request)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                'unique:products,codigo',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'categoria' => [
                'nullable',
                'string',
                'max:255',
            ],

            'marca' => [
                'nullable',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'precio_publico' => [
                'required',
                'numeric',
                'min:0',
            ],

            'precio_mayoreo' => [
                'required',
                'numeric',
                'min:0',
            ],

            'precio_tecnicos' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        $product = Product::create([
            ...$validated,
            'costo_compra' => 0,
            'stock' => 0,
            'stock_minimo' => 0,
            'activo' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente.',
            'product' => $product,
        ]);
    }

    /**
     * Crear servicio directamente desde el modal de cotización.
     */
    public function storeServiceFromQuotation(Request $request)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                'unique:services,codigo',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'categoria' => [
                'nullable',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'precio' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        $service = Service::create([
            ...$validated,
            'activo' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Servicio creado correctamente.',
            'service' => $service,
        ]);
    }

    public function show(Quotation $quotation)
    {
        $quotation->load([
            'customer',
            'user',
            'items',
        ]);

        return view('quotations.show', compact('quotation'));
    }

    private function generateFolio(): string
    {
        $lastQuotation = Quotation::latest('id')->first();

        $nextNumber = $lastQuotation
            ? $lastQuotation->id + 1
            : 1;

        return 'COT-' . str_pad(
            $nextNumber,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}