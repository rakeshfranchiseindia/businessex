<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
});


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/quick-register', [AuthController::class, 'quickRegister'])->name('quick.register');;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginForm');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Verify email address at the time regisration
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);


// routing for static pages start here
Route::view('/about-us', 'statics.about');
Route::view('/disclaimer', 'statics.disclaimer');
Route::view('/privacy-policy', 'statics.privacy');
Route::view('/terms', 'statics.terms');
Route::view('/contact-us', 'statics.contact');
Route::view('/sitemap', 'statics.sitemap');

//Shivani Chauhan
Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('update.password');
Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-submit', [ProfileController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
Route::get('/reset-password/{token}', [ProfileController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password-submit', [ProfileController::class, 'resetPasswordSubmit'])->name('reset.password.submit');





