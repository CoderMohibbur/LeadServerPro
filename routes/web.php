<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\YourController; // Import the controller
use App\Http\Controllers\RoleManagementController;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    'role:admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('User', controller: UserController::class);
    Route::post('/update-status/{id}', [UserController::class, 'updateStatus'])->name('update.status');
    Route::get('/users/data', [UserController::class, 'getUsers'])->name(name: 'users.data');
    Route::get('/leads/data', [DataController::class, 'dataServer'])->name('leads.data');
    Route::get('/leads/filters', [DataController::class, 'getFilterValues'])->name('leads.filters');
    Route::resource('roles', RoleController::class);
    Route::get('/role-management', [RoleManagementController::class, 'index'])->name('role.management');
    Route::post('/role-management/update', [RoleManagementController::class, 'update'])->name('role.update');
    Route::resource('sheets', controller: SheetController::class);
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::resource('tickets', TicketController::class);
    // Route::get('tickets/{ticket}/answer', [TicketController::class, 'answer'])->name('tickets.answer');
    // Route::put('tickets/{ticket}/answer', [TicketController::class, 'updateAnswer'])->name('tickets.updateAnswer');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('tickets/{ticket}/answer', [TicketController::class, 'storeAnswer'])->name('tickets.storeAnswer');
    // TicketController Show
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    // Answer Store
    Route::post('tickets/{ticket}/answer', [TicketController::class, 'storeAnswer'])->name('tickets.storeAnswer');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::prefix('tickets')->group(function () {
        Route::get('{id}/answer', [TicketController::class, 'answer'])->name('tickets.answer');
        Route::post('{id}/answer', [TicketController::class, 'updateAnswer'])->name('tickets.updateAnswer');
    });
    Route::get('/export', [YourController::class, 'export'])->name('export');
    Route::get('/import', [YourController::class, 'import'])->name('import');
    Route::get('/all-sheets', [YourController::class, 'allSheets'])->name('all_sheets');
    Route::get('/reset', [YourController::class, 'reset'])->name('reset');
    Route::get('/global-filter', [YourController::class, 'globalFilter'])->name('global_filter');
    Route::resource('lead-server', DataController::class);
    Route::get('/leads/sheet/{sheetId}', [SheetController::class, 'leadsBySheet'])->name('leads.bySheet');
    Route::get('/leads/user/{userId}', [SheetController::class, 'leadsByUser'])->name('leads.byUser');
    Route::post('/update-filter-values', [DataController::class, 'updateFilterValues'])->name('updateFilterValues');
    Route::post('/validate-email', [UserController::class, 'validateEmail']);
    Route::post('/validate-username', [UserController::class, 'validateUsername']);
});

Route::middleware([
    'auth:sanctum',
    'role:admin|user',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_TotalLead'])->name('dashboard');
});

// User / Client Route
Route::prefix('client')->middleware(['role:user'])->group(function () {
    Route::get('sheets', [SheetController::class, 'userindex'])->name('client.sheets.index');
    Route::get('tickets', [TicketController::class, 'ticketindex'])->name('client.tickets.index');
    Route::get('tickets/create', [TicketController::class, 'ticketcreate'])->name('client.tickets.create');
    Route::post('tickets/store', [TicketController::class, 'ticketstore'])->name('client.tickets.store');
    Route::resource('lead-server', DataController::class);
    Route::get('/leads/data', [DataController::class, 'dataServer'])->name('leads.data');
    Route::get('/leads/sheet/{sheetId}', [SheetController::class, 'leadsBySheet'])->name('client.leads.bySheet');
    // Route::get('/leads/user/{userId}', [SheetController::class, 'leadsByUser'])->name('leads.byUser');
});



