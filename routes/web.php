<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\YourController; // Import the controller

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard/sa', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('User', UserController::class);
    Route::get('/users/data', [UserController::class, 'getUsers'])->name(name: 'users.data');
    Route::get('/leads/data', [DataController::class, 'dataServer'])->name('leads.data');
    Route::get('/leads/filters', [DataController::class, 'getFilterValues'])->name('leads.filters');

    Route::resource('roles', RoleController::class);
});

// routes/web.php
// Route::get('/sheet-list', [SheetListController::class, 'index']);
// Route::get('/sheet-list/create', [SheetListController::class, 'create']);
// Route::post('/sheet-list', [SheetListController::class, 'store']);
// Route::resource('sheet-lists', SheetListController::class);



Route::resource('sheets', SheetController::class);

//TicketController

Route::middleware(['auth'])->group(function () {
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::resource('tickets', TicketController::class);
    Route::get('tickets/{ticket}/answer', [TicketController::class, 'answer'])->name('tickets.answer');
    Route::put('tickets/{ticket}/answer', [TicketController::class, 'updateAnswer'])->name('tickets.updateAnswer');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('tickets/{ticket}/answer', [TicketController::class, 'storeAnswer'])->name('tickets.storeAnswer');
    // TicketController Show
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Answer Store
    Route::post('tickets/{ticket}/answer', [TicketController::class, 'storeAnswer'])->name('tickets.storeAnswer');


    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}/answer', [TicketController::class, 'answer'])->name('tickets.answer');
    Route::post('/tickets/{id}/answer', [TicketController::class, 'updateAnswer'])->name('tickets.updateAnswer');




    Route::get('/export', [YourController::class, 'export'])->name('export');
    Route::get('/import', [YourController::class, 'import'])->name('import');
    Route::get('/all-sheets', [YourController::class, 'allSheets'])->name('all_sheets');
    Route::get('/reset', [YourController::class, 'reset'])->name('reset');
    Route::get('/global-filter', [YourController::class, 'globalFilter'])->name('global_filter');


Route::resource('lead-server', DataController::class);
// Route::post('/leads', [DataController::class, 'store'])->name('leads.store');
Route::get('/dashboard', [DataController::class, 'dashboard_TotalLead'])->name('dashboard.totalLeads');
// Route::get('/sheets/lead/{sheet}', [SheetController::class, 'leadServerLink'])->name('sheets.lead');

    Route::resource('lead-server', DataController::class);
    // Route::post('/leads', [DataController::class, 'store'])->name('leads.store');
    Route::get('/dashboard', [DataController::class, 'dashboard_TotalLead'])->name('dashboard.totalLeads');
    Route::get('/leads/sheet/{sheetId}', [SheetController::class, 'leadsBySheet'])->name('leads.bySheet');
    Route::get('/leads/user/{userId}', [SheetController::class, 'leadsByUser'])->name('leads.byUser');



});
