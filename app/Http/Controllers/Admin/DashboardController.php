<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Customer::count();
        $totalSucursales = Branch::count();
        $totalUsuarios = User::count();

        $clientesRecientes = Customer::latest()
            ->take(5)
            ->get();

        $sucursalesRecientes = Branch::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalClientes',
            'totalSucursales',
            'totalUsuarios',
            'clientesRecientes',
            'sucursalesRecientes'
        ));
    }
}