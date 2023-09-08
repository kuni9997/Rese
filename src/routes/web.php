<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MailSendController;
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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');

Route::middleware('auth','verified')->group(function (){
    Route::get('/register/thanks', function () {
        return view('registerThanks');
    });

    Route::get('/only-verified', function () {
        return view('only-verified');
     });

    Route::post('/search', [SearchController::class, 'search']);
    Route::post('/favorite', [FavoriteController::class, 'create']);
    Route::post('/booking/add', [BookingController::class, 'add']);
    Route::post('/booking/delete', [BookingController::class, 'delete']);
    Route::post('/booking/change', [BookingController::class, 'change']);
    Route::post('/booking/review', [BookingController::class, 'review']);
    Route::post('/booking/qrCode', [BookingController::class, 'qrCode']);
    Route::get('/booking/manager', [BookingController::class, 'manager']);
    Route::get('/booking/manager/detail/{booking_id}', [BookingController::class, 'detail'])->middleware(['auth', 'verified','manager']);
    Route::get('/mypage', [MypageController::class, 'index']);
    
    Route::get('/manager', [ManagerController::class, 'index']);
    Route::post('/manager',[ManagerController::class, 'store']);
    Route::get('/shop', [ManagerController::class, 'shopIndex']);
    Route::post('/shop/register', [ManagerController::class, 'shopRegister']);
    Route::get('/shop/update/{shop_id}',[ManagerController::class, 'update_index']);
    Route::post('/shop/update/{shop_id}', [ManagerController::class, 'update']);
    
    Route::post('/booking/review', [BookingController::class, 'review']);

    Route::get('/mail/index', [MailSendController::class, 'index']);
    Route::get('/mail',[MailSendController::class, 'send']);

    // 決済ボタンを表示するページ
    Route::get('/payment/index', [PaymentsController::class, 'index']);

    // Stripeの処理
    Route::post('/payment', [PaymentsController::class, 'payment']);

    // 決済完了ページ
    Route::get('/payment/complete',[PaymentsController::class, 'complete'])->name('complete');
});
