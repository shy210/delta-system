<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Mostrar las sucursales.
     */
    public function index()
{
    $branches = Branch::all();

    return view('admin.sucursales.index', compact('branches'));
}

    /**
     * Mostrar el formulario para crear una sucursal.
     */
    public function create()
{
    return view('admin.sucursales.create');
}

    /**
     * Guardar una nueva sucursal.
     */
  public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',

        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'pais' => 'required|string|max:100',

        'moneda' => 'required|in:MXN,USD,EUR',

        'telefono' => 'required|string|max:20',

        'descripcion' => 'nullable|string',

        'codigo_postal' => 'required|string|max:5',

        'estado' => 'required|string|max:100',

        'municipio' => 'required|string|max:100',

        'colonia' => 'required|string|max:150',

        'calle' => 'required|string|max:255',

        'numero_exterior' => 'required|string|max:20',

        'numero_interior' => 'nullable|string|max:20',
    ]);


    /*
     * Guardar el logo.
     */
    if ($request->hasFile('logo')) {

        $validated['logo'] = $request
            ->file('logo')
            ->store('logos/sucursales', 'public');
    }


    /*
     * Crear la sucursal.
     */
    Branch::create($validated);


    /*
     * Regresar al listado de sucursales.
     */
    return redirect()
        ->route('branches.index')
        ->with(
            'success',
            'La sucursal se creó correctamente.'
        );
}
    /**
     * Mostrar una sucursal específica.
     */
    public function show(Branch $branch)
    {
        return view('branches.show', compact('branch'));
    }

    /**
     * Mostrar el formulario para editar una sucursal.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    /**
     * Actualizar una sucursal.
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pais' => 'required|string|max:100',
            'moneda' => 'required|in:MXN,USD,EUR',
            'telefono' => 'required|string|max:20',
            'descripcion' => 'nullable|string',
            'codigo_postal' => 'required|string|max:10',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'colonia' => 'required|string|max:150',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:20',
            'numero_interior' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos/sucursales', 'public');
        }

        $branch->update($validated);

        return redirect()->route('branches.index')
            ->with('success', 'La sucursal se actualizó correctamente.');
    }
}