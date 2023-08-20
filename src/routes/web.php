<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ManagerController;
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

// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/register/thanks', function () {
    return view('registerThanks');
})->middleware(['auth', 'verified']);

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');

Route::post('/search', [SearchController::class, 'search']);
Route::post('/favorite', [FavoriteController::class, 'create']);
Route::post('/booking/add', [BookingController::class, 'add'])->middleware(['auth', 'verified']);
Route::post('/booking/delete', [BookingController::class, 'delete'])->middleware(['auth', 'verified']);
Route::post('/booking/change', [BookingController::class, 'change'])->middleware(['auth', 'verified']);
Route::post('/booking/review', [BookingController::class, 'review'])->middleware(['auth', 'verified']);
Route::get('/booking/manager', [BookingController::class, 'manager'])->middleware(['auth', 'verified']);
Route::get('/booking/manager/detail/{booking_id}', [BookingController::class, 'detail'])->middleware(['auth', 'verified']);
Route::get('/mypage', [MypageController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/manager', [ManagerController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/manager',[ManagerController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/shop', [ManagerController::class, 'shopIndex'])->middleware(['auth', 'verified']);
Route::post('/shop/register', [ManagerController::class, 'shopRegister'])->middleware(['auth', 'verified']);
Route::get('/shop/update/{shop_id}',[ManagerController::class, 'update_index'])->middleware(['auth', 'verified']);
Route::post('/shop/update/{shop_id}', [ManagerController::class, 'update'])->middleware(['auth', 'verified']);