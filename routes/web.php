<?php

use App\Http\Controllers\Admin\{
    AnimalController,
    DashboardController,
    CategoryController,
    UserController,
    GroupSaleController
};
use App\Http\Controllers\Seller\{
    OrderController
};

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('animals', AnimalController::class)->middleware(['auth', 'verified']);
Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);
Route::resource('orders', OrderController::class)->middleware(['auth', 'verified']);
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
Route::resource('group-sales', GroupSaleController::class)->middleware(['auth', 'verified']);


Route::get('admin/users', [UserController::class, 'admins'])->name('admin.users.index')->middleware(['auth', 'verified']);
Route::get('buyer/users', [UserController::class, 'buyers'])->name('buyer.users.index')->middleware(['auth', 'verified']);
Route::get('seller/users', [UserController::class, 'sellers'])->name('seller.users.index')->middleware(['auth', 'verified']);

Route::post('/animals/{animal}/images', [AnimalController::class, 'uploadImages'])
    ->name('animal.images.upload');
Route::delete('/animal-images/{image}', [AnimalController::class, 'destroyImage'])
    ->name('animal.images.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/theme', function () {
    $theme = request('theme');
})->name('theme.update');

require __DIR__ . '/auth.php';
