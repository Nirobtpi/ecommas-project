<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
// Frontend Route 
Route::get('/', [FrontendController::class,'home'])->name('home');

// Backend Route 
Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('logout',[HomeController::class,'logout']);
});

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/profile/edit',[UserController::class,'editProfile'])->name('admin.edit.profile');
    Route::post('/profile/update/{id}',[UserController::class,'updateProfile'])->name('admin.update.profile');
    Route::post('/profile/update/password/{id}',[UserController::class,'updatePassword'])->name('admin.update.password');
    Route::post('/profile/update/photo/{id}',[UserController::class,'update_photo'])->name('admin.update.photo');
});


require __DIR__.'/auth.php';
