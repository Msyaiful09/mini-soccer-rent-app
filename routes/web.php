<?php

use App\Http\Controllers\Admin\AdminFieldController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminIncomeController;
use App\Http\Controllers\Admin\AdminPlayingTimeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\General\GeneralBookedController;
use App\Http\Controllers\General\GeneralFieldController;
use App\Http\Controllers\General\GeneralHomeController;
use App\Http\Controllers\General\GeneralProfileController;
use App\Http\Controllers\General\GeneralRentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --------------------
// Auth Routes (Public)
// --------------------
Route::get('/daftar', [RegisterController::class, 'index'])->name('register');
Route::post('/daftar', [RegisterController::class, 'store'])->name('register.store');

Route::get('/masuk', [LoginController::class, 'index'])->name('login');
Route::post('/masuk', [LoginController::class, 'auth'])->name('login.auth');
Route::post('/keluar', [LoginController::class, 'logout'])->name('logout');

// General Routes (accessible only for customer)
Route::get('/', [GeneralHomeController::class, 'index'])->name('home');
Route::get('/lapangan', [GeneralFieldController::class, 'index'])->name('field');
Route::get('/lapangan/{field}', [GeneralFieldController::class, 'show'])->name('field.show');
Route::get('/lapangan-tersewa', [GeneralBookedController::class, 'index'])->name('booked-field');


// ----------------------
// Customer Routes Group
// ----------------------
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/profil', [GeneralProfileController::class, 'index'])->name('profile');
    Route::put('/profil', [GeneralProfileController::class, 'update'])->name('profile.update');
    Route::get('/sewa-saya', [GeneralRentController::class, 'index'])->name('rent.index');
    Route::post('/sewa', [GeneralRentController::class, 'store'])->name('rent.store');
    Route::get('/sewa-saya/{rent:rent_receipt}', [GeneralRentController::class, 'show'])->name('rent.show');
    Route::get('/sewa-saya/{rent:rent_receipt}/status-pembayaran', [GeneralRentController::class, 'paymentStatus'])->name('rent.payment-status');
    Route::get('/sewa-saya/{rent:rent_receipt}/invoice', [GeneralRentController::class, 'invoiceView'])->name('rent.invoice.view');
    Route::put('/sewa-lapangan/{rent:rent_receipt}/cancel', [GeneralRentController::class, 'cancel'])->name('rent.cancel');
});

// ----------------------
// Admin Routes Group
// ----------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminHomeController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.users.index');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->middleware(['auth', 'role:admin'])->name('admin.users.update');

    Route::get('/admin/fields', [AdminFieldController::class, 'index'])->name('admin.fields.index');
    Route::post('/admin/fields', [AdminFieldController::class, 'store'])->name('admin.fields.store');
    Route::put('/admin/fields/{id}', [AdminFieldController::class, 'update'])->name('admin.fields.update');
    Route::delete('/admin/fields/{id}', [AdminFieldController::class, 'destroy'])->name('admin.fields.destroy');

    Route::get('/admin/lapangan/{field}/waktu-main', [AdminPlayingTimeController::class, 'index'])->name('admin.fields.playing-times.index');
    Route::post('/admin/lapangan/{field}/waktu-main', [AdminPlayingTimeController::class, 'store'])->name('admin.fields.playing-times.store');
    Route::put('/admin/waktu-main/{playingTime}', [AdminPlayingTimeController::class, 'update'])->name('admin.playing-times.update');
    Route::delete('/admin/waktu-main/{playingTime}', [AdminPlayingTimeController::class, 'destroy'])->name('admin.playing-times.destroy');

    Route::get('/admin/profil', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::put('/admin/profil/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/rents', [AdminRentController::class, 'index'])->name('admin.rents.index');

    Route::get('admin/pemasukan', [AdminIncomeController::class, 'index'])->name('admin.income');
    Route::get('admin/pemasukan/cetak', [AdminIncomeController::class, 'printPdf'])
        ->name('admin.income.print-pdf');
});
