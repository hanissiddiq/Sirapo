<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
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

require __DIR__.'/auth.php';
