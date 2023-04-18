<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShoeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;



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

Route::get('/', [AdminHomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/', [GuestHomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/shoes/trash',[ShoeController::class, 'trash'])->name('shoes.trash');

Route::get('/shoes/{shoe}/restore',[ShoeController::class, 'restore'])->name('shoes.restore');

Route::get('/shoes/{shoe}/force-delete',[ShoeController::class, 'forceDelete'])->name('shoes.force-delete');

Route::resource( 'shoes', ShoeController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';