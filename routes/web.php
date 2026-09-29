<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CreditApplicationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryAdjustmentController;
use App\Http\Controllers\ServiceComboController;
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

    // Listado de clientes
    Route::get('/clientes', [CustomerController::class, 'index'])
        ->name('customers.index');

    // Agregar cliente
    Route::get('/clientes/agregar', [CustomerController::class, 'create'])
        ->name('customers.create');

    Route::post('/clientes', [CustomerController::class, 'store'])
        ->name('customers.store');

    // Exportaciones
    Route::get('/clientes/exportar-pdf', [CustomerController::class, 'exportPdf'])
        ->name('customers.export.pdf');

    Route::get('/clientes/exportar-excel', [CustomerController::class, 'exportExcel'])
        ->name('customers.export.excel');

    /*
    |--------------------------------------------------------------------------
    | Solicitudes de crédito
    |--------------------------------------------------------------------------
    */

    // Listar líneas de crédito
    Route::get('/clientes/creditos', [CreditApplicationController::class, 'index'])
        ->name('credit-applications.index');

    // Mostrar formulario de agregar crédito
    Route::get('/clientes/creditos/agregar', [CreditApplicationController::class, 'create'])
        ->name('credit-applications.create');

    // Guardar solicitud de crédito
    Route::post('/clientes/creditos', [CreditApplicationController::class, 'store'])
        ->name('credit-applications.store');

    // Exportaciones de líneas de crédito
    Route::get('/clientes/creditos/exportar-excel', [CreditApplicationController::class, 'exportExcel'])
        ->name('credit-applications.export-excel');

    Route::get('/clientes/creditos/exportar-pdf', [CreditApplicationController::class, 'exportPdf'])
        ->name('credit-applications.export-pdf');

    Route::get('/clientes/creditos/imprimir', [CreditApplicationController::class, 'print'])
        ->name('credit-applications.print');

    // Ver una solicitud de crédito
    Route::get(
        '/clientes/creditos/{creditApplication}',
        [CreditApplicationController::class, 'show']
    )->name('credit-applications.show');

    // Formulario para editar una solicitud de crédito
    Route::get(
        '/clientes/creditos/{creditApplication}/editar',
        [CreditApplicationController::class, 'edit']
    )->name('credit-applications.edit');

    // Actualizar una solicitud de crédito
    Route::put(
        '/clientes/creditos/{creditApplication}',
        [CreditApplicationController::class, 'update']
    )->name('credit-applications.update');

    // Eliminar una solicitud de crédito
    Route::delete(
        '/clientes/creditos/{creditApplication}',
        [CreditApplicationController::class, 'destroy']
    )->name('credit-applications.destroy');

    /*
    |--------------------------------------------------------------------------
    | Consultar, editar y eliminar clientes
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes/{customer}/editar', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::get('/clientes/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');

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
| Mi Taller - Órdenes de servicio
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,employee'])->group(function () {

    // Listado de órdenes
    Route::get('/mi-taller/ordenes', [ServiceOrderController::class, 'index'])
        ->name('service-orders.index');

    // Crear orden
    Route::get('/mi-taller/ordenes/crear', [ServiceOrderController::class, 'create'])
        ->name('service-orders.create');

    Route::post('/mi-taller/ordenes', [ServiceOrderController::class, 'store'])
        ->name('service-orders.store');

    // Consultar orden
    Route::get('/mi-taller/ordenes/{serviceOrder}', [ServiceOrderController::class, 'show'])
        ->name('service-orders.show');

    // Editar orden
    Route::get('/mi-taller/ordenes/{serviceOrder}/editar', [ServiceOrderController::class, 'edit'])
        ->name('service-orders.edit');

    Route::put('/mi-taller/ordenes/{serviceOrder}', [ServiceOrderController::class, 'update'])
        ->name('service-orders.update');

    // Eliminar orden
    Route::delete('/mi-taller/ordenes/{serviceOrder}', [ServiceOrderController::class, 'destroy'])
        ->name('service-orders.destroy');
});

/*
|--------------------------------------------------------------------------
| Cotizaciones
|--------------------------------------------------------------------------
*/

Route::get('/cotizaciones', [QuotationController::class, 'index'])
    ->name('quotations.index');

Route::get('/cotizaciones/crear', [QuotationController::class, 'create'])
    ->name('quotations.create');

Route::post('/cotizaciones', [QuotationController::class, 'store'])
    ->name('quotations.store');

Route::get('/cotizaciones/{quotation}', [QuotationController::class, 'show'])
    ->name('quotations.show');

/*
|--------------------------------------------------------------------------
| Productos
|--------------------------------------------------------------------------
*/

Route::get('/productos/exportar-excel', [ProductController::class, 'exportExcel'])
    ->name('products.export-excel');

Route::get('/productos/exportar-pdf', [ProductController::class, 'exportPdf'])
    ->name('products.export-pdf');

Route::resource('productos', ProductController::class)
    ->parameters([
        'productos' => 'product',
    ])
    ->names('products');

/*
|--------------------------------------------------------------------------
| Productos desde Cotizaciones
|--------------------------------------------------------------------------
*/

Route::post('/cotizaciones/productos/crear', [QuotationController::class, 'storeProductFromQuotation'])
    ->name('quotations.products.store');

/*
|--------------------------------------------------------------------------
| Servicios desde Cotizaciones
|--------------------------------------------------------------------------
*/

Route::post('/cotizaciones/servicios/crear', [QuotationController::class, 'storeServiceFromQuotation'])
    ->name('quotations.services.store');

/*
|--------------------------------------------------------------------------
| Categorías
|--------------------------------------------------------------------------
*/

Route::get(
    '/categorias/exportar-excel',
    [CategoryController::class, 'exportExcel']
)->name('categories.export-excel');

Route::get(
    '/categorias/exportar-pdf',
    [CategoryController::class, 'exportPdf']
)->name('categories.export-pdf');

Route::resource('categorias', CategoryController::class)
    ->parameters([
        'categorias' => 'category',
    ])
    ->names('categories');

/*
|--------------------------------------------------------------------------
| Proveedores
|--------------------------------------------------------------------------
*/

Route::get('/proveedores/exportar-excel', [SupplierController::class, 'exportExcel'])
    ->name('suppliers.export-excel');

Route::get('/proveedores/exportar-pdf', [SupplierController::class, 'exportPdf'])
    ->name('suppliers.export-pdf');

Route::resource('proveedores', SupplierController::class)
    ->parameters([
        'proveedores' => 'supplier',
    ])
    ->names('suppliers');

    Route::get('/ajustes/exportar-excel', [InventoryAdjustmentController::class, 'exportExcel'])
    ->name('inventory-adjustments.export-excel');

Route::get('/ajustes/exportar-pdf', [InventoryAdjustmentController::class, 'exportPdf'])
    ->name('inventory-adjustments.export-pdf');

Route::post('/ajustes/{inventoryAdjustment}/aprobar', [InventoryAdjustmentController::class, 'approve'])
    ->name('inventory-adjustments.approve');

Route::post('/ajustes/{inventoryAdjustment}/rechazar', [InventoryAdjustmentController::class, 'reject'])
    ->name('inventory-adjustments.reject');

Route::resource('ajustes', InventoryAdjustmentController::class)
    ->parameters(['ajustes' => 'inventoryAdjustment'])
    ->names('inventory-adjustments');

   Route::get('/servicios-combo/exportar-excel', [ServiceComboController::class, 'exportExcel'])
    ->name('service-combos.export-excel');

Route::get('/servicios-combo/exportar-pdf', [ServiceComboController::class, 'exportPdf'])
    ->name('service-combos.export-pdf');

Route::resource('servicios-combo', ServiceComboController::class)
    ->parameters(['servicios-combo' => 'serviceCombo'])
    ->names('service-combos');

/*
|--------------------------------------------------------------------------
| Perfil y autenticación
|--------------------------------------------------------------------------
*/

require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php';