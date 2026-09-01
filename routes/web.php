<?php

use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostalCodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Sucursales
|--------------------------------------------------------------------------
*/

// Crear y editar sucursales - Solo Administrador
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/sucursales/crear', [BranchController::class, 'create'])
        ->name('branches.create');

    Route::post('/sucursales', [BranchController::class, 'store'])
        ->name('branches.store');

    Route::get('/sucursales/{branch}/editar', [BranchController::class, 'edit'])
        ->name('branches.edit');

    Route::put('/sucursales/{branch}', [BranchController::class, 'update'])
        ->name('branches.update');
});


// Ver sucursales - Administrador y Empleado
Route::middleware(['auth', 'role:admin,employee'])->group(function () {

    Route::get('/sucursales', [BranchController::class, 'index'])
        ->name('branches.index');

    Route::get('/sucursales/{branch}', [BranchController::class, 'show'])
        ->name('branches.show');
});

Route::middleware('auth')->get(
    '/api/codigo-postal/{codigoPostal}',
    [PostalCodeController::class, 'search']
)->name('postal-code.search');

require __DIR__.'/profile.php';
require __DIR__.'/auth.php';