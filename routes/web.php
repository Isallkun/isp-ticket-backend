<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;

// ✅ Halaman awal: redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');

// ✅ Protected routes — hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard/Home - All authenticated users
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Customer Management - CS and Admin only
    Route::middleware(['role:CS,Admin'])->group(function () {
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
        Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    // Ticket Management - Different permissions for different roles
    Route::middleware(['permission:create-tickets'])->group(function () {
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    });

    // View tickets - All roles can view, but with different data
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

    // Ticket Management - NOC and Admin only
    Route::middleware(['role:NOC,Admin'])->group(function () {
        Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
        Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
        Route::patch('/tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    });

    // User Management - Admin only
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });
});
