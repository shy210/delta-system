<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Mostrar listado de categorías.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $categories = Category::with('categoriaPadre')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('tipo', 'like', '%' . $search . '%')
                        ->orWhereHas('categoriaPadre', function ($parentQuery) use ($search) {
                            $parentQuery->where('nombre', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact(
            'categories',
            'search'
        ));
    }

    /**
     * Mostrar formulario para crear una categoría.
     */
    public function create()
    {
        $parentCategories = Category::where('tipo', 'padre')
            ->orderBy('nombre')
            ->get();

        return view('categories.create', compact(
            'parentCategories'
        ));
    }

    /**
     * Guardar una nueva categoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'tipo' => [
                'required',
                Rule::in([
                    'padre',
                    'hija',
                ]),
            ],

            'categoria_padre_id' => [
                'nullable',
                'exists:categories,id',
                Rule::requiredIf(
                    fn () => $request->input('tipo') === 'hija'
                ),
            ],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',

            'nombre.string' => 'El nombre de la categoría no es válido.',

            'nombre.max' => 'El nombre de la categoría no puede superar los 255 caracteres.',

            'tipo.required' => 'Selecciona el tipo de categoría.',

            'tipo.in' => 'El tipo de categoría seleccionado no es válido.',

            'categoria_padre_id.required' => 'Selecciona una categoría padre.',

            'categoria_padre_id.exists' => 'La categoría padre seleccionada no existe.',
        ]);

        if ($validated['tipo'] === 'padre') {
            $validated['categoria_padre_id'] = null;
        }

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar una categoría.
     */
    public function show(Category $category)
    {
        $category->load([
            'categoriaPadre',
            'subcategorias',
        ]);

        return view('categories.show', compact(
            'category'
        ));
    }

    /**
     * Mostrar formulario para editar una categoría.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('tipo', 'padre')
            ->where('id', '!=', $category->id)
            ->orderBy('nombre')
            ->get();

        return view('categories.edit', compact(
            'category',
            'parentCategories'
        ));
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'tipo' => [
                'required',
                Rule::in([
                    'padre',
                    'hija',
                ]),
            ],

            'categoria_padre_id' => [
                'nullable',
                'exists:categories,id',
                Rule::requiredIf(
                    fn () => $request->input('tipo') === 'hija'
                ),
            ],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',

            'nombre.string' => 'El nombre de la categoría no es válido.',

            'nombre.max' => 'El nombre de la categoría no puede superar los 255 caracteres.',

            'tipo.required' => 'Selecciona el tipo de categoría.',

            'tipo.in' => 'El tipo de categoría seleccionado no es válido.',

            'categoria_padre_id.required' => 'Selecciona una categoría padre.',

            'categoria_padre_id.exists' => 'La categoría padre seleccionada no existe.',
        ]);

        if ($validated['tipo'] === 'padre') {
            $validated['categoria_padre_id'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Evitar que una categoría sea su propia categoría padre
        |--------------------------------------------------------------------------
        */

        if (
            $validated['tipo'] === 'hija' &&
            (int) $validated['categoria_padre_id'] === (int) $category->id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'categoria_padre_id' => 'Una categoría no puede ser su propia categoría padre.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Si cambia de padre a hija, se valida correctamente.
        |--------------------------------------------------------------------------
        */

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(Category $category)
    {
        if ($category->subcategorias()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'No puedes eliminar esta categoría porque tiene subcategorías asociadas.'
                );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    /**
     * Exportar categorías a Excel.
     */
    public function exportExcel(Request $request)
    {
        $search = $request->input('search', '');

        return Excel::download(
            new CategoryExport($search),
            'categorias.xlsx'
        );
    }

    /**
     * Exportar categorías a PDF.
     */
    public function exportPdf(Request $request)
    {
        $search = $request->input('search', '');

        $categories = Category::with('categoriaPadre')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('tipo', 'like', '%' . $search . '%')
                        ->orWhereHas('categoriaPadre', function ($parentQuery) use ($search) {
                            $parentQuery->where('nombre', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('nombre')
            ->get();

        $pdf = Pdf::loadView(
            'categories.export-pdf',
            compact(
                'categories',
                'search'
            )
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('categorias.pdf');
    }
}