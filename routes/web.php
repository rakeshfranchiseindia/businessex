<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StartupController;

Route::get('/', function () {
    return view('index');
});

//Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/businesslisting', [BusinessController::class, 'businessListing'])->name('business.listing');
Route::get('/investorlisting', [InvestorController::class, 'investorListing'])->name('investor.listing');
Route::get('/mentoringlisting', [MentorController::class, 'mentoringListing'])->name('mentoring.listing');
Route::get('/startuplisting', [StartupController::class, 'startupListing'])->name('startup.listing');


Route::post('/quick-register', [AuthController::class, 'quickRegister'])->name('quick.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard/myaccount', [AuthController::class, 'myaccount'])->middleware('auth')->name('myaccount');
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
Route::middleware(['auth', 'verified'])->group(function () {
    
Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('update.password');
Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-submit', [ProfileController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
Route::get('/reset-password/{token}', [ProfileController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password-submit', [ProfileController::class, 'resetPasswordSubmit'])->name('reset.password.submit');
Route::get('/investor-details', [ProfileController::class,'getUserProfileDetails'])->name('get.user.details');
Route::get('/user/edit', [ProfileController::class, 'userEditPage'])->name('user.edit.page');
Route::put('/user', [ProfileController::class, 'update'])->name('user.update');
Route::get('/dashboard/mentorConfidentials/{user_rand_id}', [ProfileController::class, 'edit'])->name('confidential.edit');
Route::post('/dashboard/mentorConfidentials{user_rand_id}', [ProfileController::class, 'updateConfidential_info'])->name('confidential.update');
Route::get('/dashboard/mentorConfidentialss/{user_rand_id}', [ProfileController::class, 'advert_detail'])->name('confidential.advert_detail');
Route::post('/dashboard/mentorConfidentialss{user_rand_id}', [ProfileController::class, 'advertisement_add'])->name('advertisement.save');


});



