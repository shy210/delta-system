<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $suppliers = Supplier::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('whatsapp', 'like', '%' . $search . '%')
                        ->orWhere('telefono', 'like', '%' . $search . '%')
                        ->orWhere('correo', 'like', '%' . $search . '%')
                        ->orWhere('direccion', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('suppliers.index', compact(
            'suppliers',
            'search'
        ));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:30',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:255',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nombre.required' => 'El nombre del proveedor es obligatorio.',
            'nombre.string' => 'El nombre del proveedor no es válido.',
            'nombre.max' => 'El nombre del proveedor no puede superar los 255 caracteres.',

            'whatsapp.max' => 'El WhatsApp no puede superar los 30 caracteres.',

            'telefono.max' => 'El teléfono no puede superar los 30 caracteres.',

            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.max' => 'El correo no puede superar los 255 caracteres.',

            'direccion.max' => 'La dirección no puede superar los 1000 caracteres.',
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    public function exportExcel(Request $request)
{
    $search = $request->input('search', '');

    return Excel::download(
        new SupplierExport($search),
        'proveedores.xlsx'
    );
}

public function exportPdf(Request $request)
{
    $search = $request->input('search', '');

    $suppliers = Supplier::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('whatsapp', 'like', '%' . $search . '%')
                    ->orWhere('telefono', 'like', '%' . $search . '%')
                    ->orWhere('correo', 'like', '%' . $search . '%')
                    ->orWhere('direccion', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('nombre')
        ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'suppliers.export-pdf',
        compact('suppliers')
    );

    return $pdf->download('proveedores.pdf');
}

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact(
            'supplier'
        ));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact(
            'supplier'
        ));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:30',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:255',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nombre.required' => 'El nombre del proveedor es obligatorio.',
            'nombre.string' => 'El nombre del proveedor no es válido.',
            'nombre.max' => 'El nombre del proveedor no puede superar los 255 caracteres.',

            'whatsapp.max' => 'El WhatsApp no puede superar los 30 caracteres.',

            'telefono.max' => 'El teléfono no puede superar los 30 caracteres.',

            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.max' => 'El correo no puede superar los 255 caracteres.',

            'direccion.max' => 'La dirección no puede superar los 1000 caracteres.',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}