<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookTourController;
use App\Http\Controllers\User\IntroductController;
use App\Http\Controllers\User\LienHeController;
use App\Http\Controllers\User\LocationController;
use App\Http\Controllers\User\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BookingTourController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\ToursController;


// Route mặc định cho trang home của người dùng, yêu cầu phải đăng nhập
Route::get('/', [TourController::class, 'index'])->name('common');

Route::get('/tour', [TourController::class, 'index'])->defaults('view', 'user.tour')->name('guest.tour');
Route::get('/tour/{id}', [TourController::class, 'show'])->name('guest.tour.show');

Route::get('/lienhe', [LienHeController::class, 'index'])->name('guest.lienhe');

Route::get('/gioithieu', [IntroductController::class, 'index'])->name('guest.introduct');

Route::get('/diadiem', [LocationController::class, 'index'])->name('guest.location');
Route::get('/diadiem/{id}', [LocationController::class, 'show'])->name('guest.local.show');

// Route::get('/', function () {
//     return view('user.home');
// })->middleware('auth');
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::get('/', [TourController::class, 'index'])->name('home');
    Route::get('/tour', [TourController::class, 'index'])->defaults('view', 'user.tour')->name('user.tour');
    Route::get('/tour/{id}', [TourController::class, 'show'])->name('user.tour.show');
    Route::get('/lienhe', [LienHeController::class, 'index'])->name('user.lienhe');
    Route::get('/gioithieu', [IntroductController::class, 'index'])->name('user.introduct');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/edit_profile/{id}', [ProfileController::class, 'edit'])->name('edit.profile');
    Route::put('/edit_profile/{id}', [ProfileController::class, 'update'])->name('edit.profile.put');

    Route::get('/diadiem', [LocationController::class, 'index'])->name('user.location');
    Route::get('/diadiem/{id}', [LocationController::class, 'show'])->name('user.local.show');

    Route::get('/payment', [BookTourController::class, 'paymentPage'])->name('payment.page');
    Route::post('/payment/process', [BookTourController::class, 'processPayment'])->name('payment.process');

    Route::get('/search', [TourController::class, 'search'])->name('search');

});

// Route group cho các route yêu cầu quyền admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin', 'namespace' => 'Admin', 'name' => 'admin.'], function () {
    // routes/web.php
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    /* Account Routing */
    Route::get('/account', [AccountController::class, 'index'])->name('list_taikhoan');
    Route::get('/edit_account', [AccountController::class, 'show_edit_taikhoan'])->name('edit_taikhoan');
    Route::get('/edit_account/{id}', [AccountController::class, 'edit'])->name('edit_taikhoan');
    Route::put('/edit_account/{id}', [AccountController::class, 'update'])->name('edit_taikhoan_post');
    Route::delete('/delete_account/{id}', [AccountController::class, 'delete_account'])->name('delete_account');
    Route::get('/search_accounts', [AccountController::class, 'search'])->name('search_accounts');


    /* Booking Tour Routing */
    Route::get('/bills', [BookingTourController::class, 'index'])->name('list_booking');
    Route::get('/bills/thanh_toan', [BookingTourController::class, 'thanh_toan'])->name('thanh_toan');
    Route::post('/bills/duyet/{ma_dat_tour}', [BookingTourController::class, 'duyet'])->name('duyet');
    Route::delete('/delete_bill/{ma_dat_tour}', [BookingTourController::class, 'delete_bill'])->name('delete_bill');
    Route::get('/bills/search', [BookingTourController::class, 'search'])->name('bills.search');


    /* Locations Routing */
    Route::get('/locations', [LocationsController::class, 'index'])->name('list_diadiem');
    Route::get('/add_locations', [LocationsController::class, 'show_add_diadiem'])->name('add_diadiem');
    Route::post('/add_diadiem_post', [LocationsController::class, 'store'])->name('add_diadiem_post');
    Route::get('/edit_location/{id}', [LocationsController::class, 'edit'])->name('edit_diadiem');
    Route::put('/edit_location/{id}', [LocationsController::class, 'update'])->name('edit_diadiem_post');
    Route::delete('/delete_locations/{id}', [LocationsController::class, 'delete_locations'])->name('delete_locations');
    Route::get('/search_locations', [LocationsController::class, 'search'])->name('search_locations');


    /* Tours Routing */
    Route::get('/tours', [ToursController::class, 'index'])->name('list_tour');
    Route::get('/add_tour', [ToursController::class, 'show_add_tour'])->name('add_tour');
    Route::post('/add_tour_post', [ToursController::class, 'add_tour'])->name('add_tour_post');
    Route::get('/edit_tour/{ma_tour}', [ToursController::class, 'edit'])->name('edit_tour');
    Route::put('/edit_tour/{ma_tour}', [ToursController::class, 'update'])->name('edit_tour_post');
    Route::delete('/delete_tour/{ma_tour}', [ToursController::class, 'delete_tour'])->name('delete_tour');
    Route::get('/search_tours', [ToursController::class, 'search'])->name('search_tours');


    // BaiViet
    Route::get('/list_noidung', [BlogController::class, 'index'])->name('list_noidung');
    Route::get('/add_noidung', [BlogController::class, 'create'])->name('add_noidung');
    Route::get('/edit_noidung/show/{id}', [BlogController::class, 'show'])->name('edit_noidung');
    Route::delete('/delete_noidung/{bai_viet_id}', [BlogController::class, 'destroy'])->name('delete_noidung');
    Route::get('/search_baiviet', [BlogController::class, 'search'])->name('search_noidung');
});




// Route cho trang login
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route cho trang register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Hiển thị form nhập email
Route::post('/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // Gửi email reset mật khẩu
Route::get('/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset'); // Hiển thị form đặt lại mật khẩu
Route::post('/reset', [ForgotPasswordController::class, 'reset'])->name('password.update'); // Xử lý cập nhật mật khẩu mới
Route::post('/', [LoginController::class, 'logout'])->name('logout');
