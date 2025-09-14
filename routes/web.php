<?php

use App\Http\Controllers\Admin\{
    AnimalController,
    DashboardController,
    CategoryController,
    UserController,
    GroupSaleController
};
use App\Http\Controllers\Buyer\{
    ProfileController as BuyerProfileController,
};
use App\Http\Controllers\Seller\{
    OrderController,
    ProfileController as SellerProfileController
};

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.home.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('animals', AnimalController::class)->middleware(['auth', 'verified']);
Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);
Route::resource('orders', OrderController::class)->middleware(['auth', 'verified']);
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
Route::resource('group-sales', GroupSaleController::class)->middleware(['auth', 'verified']);


Route::get('admin/users', [UserController::class, 'admins'])->name('admin.users.index')->middleware(['auth', 'verified']);
// Route::get('buyer/users', [UserController::class, 'buyers'])->name('buyer.users.index')->middleware(['auth', 'verified']);
// Route::get('seller/users', [UserController::class, 'sellers'])->name('seller.users.index')->middleware(['auth', 'verified']);

Route::post('/animals/{animal}/images', [AnimalController::class, 'uploadImages'])->name('animal.images.upload');
Route::delete('/animal-images/{image}', [AnimalController::class, 'destroyImage'])->name('animal.images.destroy');
Route::post('/animals/temp/upload-images', [AnimalController::class, 'uploadTempImages']);
Route::delete('/animals/temp/delete-image/{image}', [AnimalController::class, 'deleteTempImage']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Seller Routes
Route::prefix('sellers')->group(function () {
    Route::get('/', [SellerProfileController::class, 'index'])->name('sellers.index');
    Route::get('/create', [SellerProfileController::class, 'create'])->name('sellers.create');
    Route::post('/', [SellerProfileController::class, 'store'])->name('sellers.store');
    // Add other routes as needed
});

// Buyer Routes
Route::prefix('buyers')->group(function () {
    Route::get('/', [BuyerProfileController::class, 'index'])->name('buyers.index');
    Route::get('/create', [BuyerProfileController::class, 'create'])->name('buyers.create');
    Route::post('/', [BuyerProfileController::class, 'store'])->name('buyers.store');
    // Add other routes as needed
});


Route::post('/theme', function () {
    $theme = request('theme');
})->name('theme.update');

require __DIR__ . '/auth.php';
