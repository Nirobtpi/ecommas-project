<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('users',[UserController::class,'User'])->name('user');
    Route::Post('user/add',[UserController::class,'addUser'])->name('user.add');
    Route::get('user/delete/{id}',[UserController::class,'userDelete'])->name('user.delete');

    // ===== Categorty ====

    Route::get('category',[CategoryController::class,'category'])->name('category');
    Route::post('category/store',[CategoryController::class,'category_store'])->name('category.store');
    Route::get('category/edit/{id}',[CategoryController::class,'category_edit'])->name('category.edit');
    Route::post('category/update/{id}',[CategoryController::class,'category_update'])->name('category.update');
    Route::get('category/delete/{id}',[CategoryController::class,'category_delete'])->name('category.delete');
    Route::get('category/trash',[CategoryController::class,'categoryTrash'])->name('category.trash');
    Route::get('category/restore/{id}',[CategoryController::class,'categoryRestore'])->name('category.restore');
    Route::get('category/force/delete/{id}',[CategoryController::class,'categoryForceDelete'])->name('category.froceDelete');
    Route::post('category/check_delete',[CategoryController::class,'categoryCheckDelete'])->name('category.froceCheckDelete');
    Route::post('category/check_restore',[CategoryController::class,'check_restore'])->name('category.check.restore');

    //=========== Tags ==========
    Route::get('tag',[TagController::class,'tag'])->name('tag');
    Route::post('tag/store',[TagController::class,'tag_store'])->name('tag.store');
    Route::get('tag/softdelete/{id}',[TagController::class,'tag_softdelete'])->name('tag.softdelete');
    Route::post('tag/checkdelete',[TagController::class,'tag_checkdelete'])->name('tag.checkdelete');
    Route::post('tag/checkrestoredelete',[TagController::class,'checkrestoredelete'])->name('tag.checkrestoredelete');
    Route::get('tag/trash',[TagController::class,'trash'])->name('tag.trash');
    Route::get('tag/delete',[TagController::class,'tag_delete'])->name('tag.delete');

    // Tag Edit
    Route::get('tag/edit/{id}',[TagController::class,'tagEdit'])->name('tag.edit');
    Route::post('tag/update/{id}',[TagController::class,'tagUpdate'])->name('tag.update');


});


require __DIR__.'/auth.php';
