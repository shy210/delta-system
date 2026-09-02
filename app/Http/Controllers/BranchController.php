<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        return view('admin.sucursales.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.sucursales.create');
    }

    public function store(Request $request)
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
            $validated['logo'] = $request->file('logo')
                ->store('logos/sucursales', 'public');
        }

        Branch::create($validated);

        return redirect()
            ->route('branches.index')
            ->with('success', 'La sucursal se creó correctamente.');
    }

    public function show(Branch $branch)
    {
        return view('admin.sucursales.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        return view('admin.sucursales.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pais' => 'required|string|max:100',
            'moneda' => 'required|in:MXN,USD,EUR',
            'telefono' => 'required|string|max:20',
            'descripcion' => 'nullable|string',
            'codigo_postal' => 'required|string',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'colonia' => 'required|string|max:150',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:20',
            'numero_interior' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('logo')) {

            if ($branch->logo) {
                Storage::disk('public')->delete($branch->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('logos/sucursales', 'public');
        }

        $branch->update($validated);

        return redirect()
            ->route('branches.index')
            ->with('success', 'La sucursal se actualizó correctamente.');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->logo) {
            Storage::disk('public')->delete($branch->logo);
        }

        $branch->delete();

        return redirect()
            ->route('branches.index')
            ->with('success', 'La sucursal se eliminó correctamente.');
    }
}