<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PostalCodeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard general
|--------------------------------------------------------------------------
|
| Esta ruta se mantiene porque la navegación de Delta System
| utiliza route('dashboard').
|
| Por ahora redirige al dashboard del administrador.
|
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Dashboard Administrador
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| Sucursales - Administración
|--------------------------------------------------------------------------
|
| Solo el administrador puede crear, editar y eliminar sucursales.
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/sucursales/crear', [BranchController::class, 'create'])
        ->name('branches.create');

    Route::post('/sucursales', [BranchController::class, 'store'])
        ->name('branches.store');

    Route::get('/sucursales/{branch}/editar', [BranchController::class, 'edit'])
        ->name('branches.edit');

    Route::put('/sucursales/{branch}', [BranchController::class, 'update'])
        ->name('branches.update');

    Route::delete('/sucursales/{branch}', [BranchController::class, 'destroy'])
        ->name('branches.destroy');

});


/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
|
| Administrador y empleado pueden gestionar clientes.
|
*/

Route::middleware(['auth', 'role:admin,employee'])->group(function () {

    Route::get('/clientes', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('/clientes/agregar', [CustomerController::class, 'create'])
        ->name('customers.create');

    Route::post('/clientes', [CustomerController::class, 'store'])
        ->name('customers.store');

    Route::get('/clientes/exportar-pdf', [CustomerController::class, 'exportPdf'])
        ->name('customers.export.pdf');

    Route::get('/clientes/exportar-excel', [CustomerController::class, 'exportExcel'])
        ->name('customers.export.excel');

    Route::get('/clientes/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');

    Route::get('/clientes/{customer}/editar', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::put('/clientes/{customer}', [CustomerController::class, 'update'])
        ->name('customers.update');

    Route::delete('/clientes/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');

});


/*
|--------------------------------------------------------------------------
| Sucursales - Consulta
|--------------------------------------------------------------------------
|
| Administrador y empleado pueden consultar sucursales.
|
*/

Route::middleware(['auth', 'role:admin,employee'])->group(function () {

    Route::get('/sucursales', [BranchController::class, 'index'])
        ->name('branches.index');

    Route::get('/sucursales/{branch}', [BranchController::class, 'show'])
        ->name('branches.show');

});


/*
|--------------------------------------------------------------------------
| API - Código Postal
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get(
    '/api/codigo-postal/{codigoPostal}',
    [PostalCodeController::class, 'search']
)->name('postal-code.search');


/*
|--------------------------------------------------------------------------
| Perfil y autenticación
|--------------------------------------------------------------------------
*/

require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php';