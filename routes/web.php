<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;

// ✅ Halaman awal: redirect ke login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// ✅ Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Protected routes — hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard/Home
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Customer Management
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Ticket Management
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});
