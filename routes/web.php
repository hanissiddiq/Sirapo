<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\BookingController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('admin.index');
    return view('landing');
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/package', [PackageController::class, 'index'])->name('package');
// Route::get('/package/create', [PackageController::class, 'create'])->name('package.create');
// Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
Route::resource('packages', PackageController::class);

//source chatgpt
Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking.index');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
Route::delete('/booking/{id}/delete', [BookingController::class, 'destroy'])->name('booking.destroy');

Route::get('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
Route::get('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::get('/booking/{id}/inprogress', [BookingController::class, 'inProgress'])->name('booking.inprogress');
Route::get('/booking/{id}/finish', [BookingController::class, 'finish'])->name('booking.finish');
Route::get('/booking/{id}/payment', [BookingController::class, 'paymentForm'])->name('booking.payment');
Route::post('/booking/{id}/payment', [BookingController::class, 'makePayment'])->name('booking.makePayment');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

require __DIR__.'/auth.php';
