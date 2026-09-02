<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')
            ->latest()
            ->get();

        return view('admin.clientes.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',

            'pais' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'correo' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'contacto_alternativo' => 'nullable|string|max:255',

            'codigo_postal' => 'required|string|max:10',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'colonia' => 'required|string|max:150',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:20',
            'numero_interior' => 'nullable|string|max:20',

            'fecha_nacimiento' => 'required|date',

            'precio' => [
                'required',
                'in:Precio público,Precio mayoreo,Precio técnico',
            ],

            'tipo_identificacion' => 'required|string|max:100',
            'razon_social' => 'required|string|max:255',
            'regimen_fiscal' => 'required|string|max:150',
            'empresa' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => trim(
                    $validated['nombre'] . ' ' .
                    $validated['apellido_paterno'] . ' ' .
                    $validated['apellido_materno']
                ),
                'email' => $validated['correo'],
                'password' => 'Delta12345',
                'role' => 'client',
            ]);

            Customer::create([
                ...$validated,
                'user_id' => $user->id,
            ]);
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'El cliente se agregó correctamente.');
    }

    public function show(Customer $customer)
    {
        $customer->load('user');

        return view('admin.clientes.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.clientes.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',

            'pais' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'correo' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($customer->user_id),
            ],
            'contacto_alternativo' => 'nullable|string|max:255',

            'codigo_postal' => 'required|string|max:10',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'colonia' => 'required|string|max:150',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:20',
            'numero_interior' => 'nullable|string|max:20',

            'fecha_nacimiento' => 'required|date',

            'precio' => [
                'required',
                'in:Precio público,Precio mayoreo,Precio técnico',
            ],

            'tipo_identificacion' => 'required|string|max:100',
            'razon_social' => 'required|string|max:255',
            'regimen_fiscal' => 'required|string|max:150',
            'empresa' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $customer) {

            $customer->update($validated);

            $customer->user->update([
                'name' => trim(
                    $validated['nombre'] . ' ' .
                    $validated['apellido_paterno'] . ' ' .
                    $validated['apellido_materno']
                ),
                'email' => $validated['correo'],
            ]);
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'El cliente se actualizó correctamente.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'El cliente se eliminó correctamente.');
    }
}