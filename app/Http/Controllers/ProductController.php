<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSeries;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Mostrar catálogo de productos.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query()
            ->with([
                'proveedor',
                'categoriaRelacion',
                'subcategoria',
                'sucursal',
                'series.sucursal',
            ])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nombre', 'like', "%{$search}%")
                        ->orWhere('marca', 'like', "%{$search}%")
                        ->orWhere('categoria', 'like', "%{$search}%")
                        ->orWhere('referencia', 'like', "%{$search}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products', 'search'));
    }

    public function exportExcel()
{
    return Excel::download(
        new ProductExport(),
        'productos-' . now()->format('Y-m-d') . '.xlsx'
    );
}

    /**
     * Mostrar formulario para agregar producto.
     */
    public function create()
    {
        $suppliers = Supplier::query()
            ->orderBy('nombre')
            ->get();

        $categories = Category::query()
            ->where('tipo', 'padre')
            ->orderBy('nombre')
            ->get();

        $subcategories = Category::query()
            ->where('tipo', 'hija')
            ->orderBy('nombre')
            ->get();

        $branches = Branch::query()
            ->orderBy('nombre')
            ->get();

        return view('products.create', compact(
            'suppliers',
            'categories',
            'subcategories',
            'branches'
        ));
    }

    /**
     * Guardar producto.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $series = $request->input('series', []);

        if ($validated['maneja_series']) {
            $request->validate([
                'series' => ['required', 'array', 'min:1'],
                'series.*.sucursal_id' => ['required', 'exists:branches,id'],
                'series.*.serie' => ['required', 'string', 'max:255', 'distinct'],
            ]);
        }

        $validated = $this->prepareProductData($validated, $request);

        DB::transaction(function () use ($validated, $series) {
            $product = Product::create($validated);

            if ($product->maneja_series) {
                foreach ($series as $serie) {
                    ProductSeries::create([
                        'product_id' => $product->id,
                        'sucursal_id' => $serie['sucursal_id'],
                        'serie' => $serie['serie'],
                    ]);
                }
            }
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto agregado correctamente.');
    }

    /**
     * Mostrar información del producto.
     */
    public function show(Product $product)
    {
        $product->load([
            'proveedor',
            'categoriaRelacion',
            'subcategoria',
            'sucursal',
            'series.sucursal',
        ]);

        return view('products.show', compact('product'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Product $product)
    {
        $product->load('series.sucursal');

        $suppliers = Supplier::query()
            ->orderBy('nombre')
            ->get();

        $categories = Category::query()
            ->where('tipo', 'padre')
            ->orderBy('nombre')
            ->get();

        $subcategories = Category::query()
            ->where('tipo', 'hija')
            ->orderBy('nombre')
            ->get();

        $branches = Branch::query()
            ->orderBy('nombre')
            ->get();

        return view('products.edit', compact(
            'product',
            'suppliers',
            'categories',
            'subcategories',
            'branches'
        ));
    }

    /**
     * Actualizar producto.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);

        $series = $request->input('series', []);

        if ($validated['maneja_series']) {
            $request->validate([
                'series' => ['required', 'array', 'min:1'],
                'series.*.sucursal_id' => ['required', 'exists:branches,id'],
                'series.*.serie' => ['required', 'string', 'max:255', 'distinct'],
            ]);
        }

        $validated = $this->prepareProductData($validated, $request);

        DB::transaction(function () use ($product, $validated, $series) {
            $product->update($validated);

            /*
             * Si el producto ya no maneja series,
             * eliminamos todas sus series.
             */
            if (!$product->maneja_series) {
                $product->series()->delete();

                return;
            }

            /*
             * Para simplificar la edición:
             * eliminamos las series actuales y guardamos
             * nuevamente las que vienen del formulario.
             */
            $product->series()->delete();

            foreach ($series as $serie) {
                ProductSeries::create([
                    'product_id' => $product->id,
                    'sucursal_id' => $serie['sucursal_id'],
                    'serie' => $serie['serie'],
                ]);
            }
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar producto.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Validaciones generales del producto.
     */
    private function validateProduct(
        Request $request,
        ?Product $product = null
    ): array {
        $codigoRule = Rule::unique('products', 'codigo');

        if ($product) {
            $codigoRule->ignore($product->id);
        }

        return $request->validate([
            /*
             * Datos generales
             */
            'codigo' => [
                'required',
                'string',
                'max:100',
                $codigoRule,
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'supplier_id' => [
                'nullable',
                'exists:suppliers,id',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'descripcion_corta' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'tipo_venta' => [
                'required',
                'in:unidad,kilogramo,metro',
            ],

            'referencia' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sucursal_id' => [
                'nullable',
                'exists:branches,id',
            ],

            'aplica_descuento' => [
                'required',
                'boolean',
            ],

            'descripcion_larga' => [
                'nullable',
                'string',
            ],

            /*
             * Campos antiguos que se conservan
             * por compatibilidad con Cotizaciones.
             */
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

            /*
             * Inventario
             */
            'maneja_series' => [
                'required',
                'boolean',
            ],

            'stock_minimo' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock_maximo' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            /*
             * Precios
             */
            'costo_compra' => [
                'required',
                'numeric',
                'min:0',
            ],

            'precio_publico' => [
                'required',
                'numeric',
                'min:0',
            ],

            'ganancia_porcentaje' => [
                'required',
                'numeric',
                'min:0',
            ],

            'precio_2' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'precio_3' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'precio_4' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'precio_5' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'precio_6' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            /*
             * Campos antiguos de Cotizaciones.
             */
            'precio_mayoreo' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'precio_tecnicos' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'activo' => [
                'nullable',
                'boolean',
            ],
        ]);
    }

    /**
     * Preparar datos antes de guardar.
     */
    private function prepareProductData(
        array $validated,
        Request $request
    ): array {
        $validated['categoria'] = $validated['categoria'] ?? null;
        $validated['marca'] = $validated['marca'] ?? null;
        $validated['descripcion'] = $validated['descripcion'] ?? null;

        $validated['stock_minimo'] = $validated['stock_minimo'] ?? 0;
        $validated['stock_maximo'] = $validated['stock_maximo'] ?? 0;
        $validated['stock'] = $validated['stock'] ?? 0;

        /*
         * Compatibilidad con Cotizaciones:
         *
         * Precio 1 = precio_publico
         * Precio 2 = precio_mayoreo
         * Precio 3 = precio_tecnicos
         */
        $validated['precio_mayoreo'] =
            $validated['precio_mayoreo']
            ?? $validated['precio_2']
            ?? $validated['precio_publico'];

        $validated['precio_tecnicos'] =
            $validated['precio_tecnicos']
            ?? $validated['precio_3']
            ?? $validated['precio_publico'];

        $validated['activo'] = $request->boolean('activo');

        /*
         * Si no maneja series, no debe conservar
         * información de inventario por series.
         */
        if (!$request->boolean('maneja_series')) {
            $validated['maneja_series'] = false;
        }

        return $validated;
    }

    public function exportPdf(Request $request)
{
    $search = $request->input('search');

    $products = Product::query()
        ->with([
            'proveedor',
            'categoriaRelacion',
            'subcategoria',
            'sucursal',
            'series',
        ])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                    ->orWhere('nombre', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('categoria', 'like', "%{$search}%")
                    ->orWhere('referencia', 'like', "%{$search}%");
            });
        })
        ->orderBy('nombre')
        ->get();

    $pdf = Pdf::loadView('products.export-pdf', compact('products', 'search'))
        ->setPaper('letter', 'landscape');

    return $pdf->download(
        'productos-' . now()->format('Y-m-d') . '.pdf'
    );
}
}