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

use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\InvestorProfileController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\StartupProfileController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ServiceListingController;
use App\Http\Controllers\BxInsightController;
use App\Http\Controllers\SubscribeController;


// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/newsLetterSubscribe', [SubscribeController::class, 'newsLetterSubscribe'])->name('newsLetterSubscribe');

Route::get('/businesslisting', [BusinessController::class, 'businessListing'])->name('business.listing');
Route::get('/investorlisting', [InvestorController::class, 'investorListing'])->name('investor.listing');
Route::get('/mentorlisting', [MentorController::class, 'mentorListing'])->name('mentor.listing');
Route::get('/startuplisting', [StartupController::class, 'startupListing'])->name('startup.listing');


Route::get('/registration/create-mentor-profile', [MentorProfileController::class, 'createMentorProfile'])->name('register.create-mentor-profile');
Route::get('/registration/create-business-profile', [BusinessProfileController::class, 'createBusinessProfile'])->name('register.create-business-profile');
Route::get('/registration/create-investor-profile', [InvestorProfileController::class, 'createInvestorProfile'])->name('register.create-investor-profile');
Route::get('/registration/create-startup-profile', [StartupProfileController::class, 'createStartupProfile'])->name('register.create-startup-profile');

Route::get('/pricing', [PriceController::class, 'priceListing'])->name('pricing.listing');

Route::get('/articles', [BxInsightController::class, 'index'])->name('bxinsight.index');
Route::get('/articles/{id}', [BxInsightController::class, 'show'])->name('bxinsight.show');

Route::get('/service/business-valuation', [ServiceListingController::class, 'businessValuation'])->name('service.business-valuation');
Route::get('/service/business-plan', [ServiceListingController::class, 'businessPlan'])->name('service.business-plan');
Route::get('/service/due-diligence', [ServiceListingController::class, 'dueDiligence'])->name('service.due-diligence');
Route::get('/service/certified-business-broker', [ServiceListingController::class, 'certifiedBusinessBroker'])->name('service.certified-business-broker');



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
    
Route::get('dashboard/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('update.password');
Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-submit', [ProfileController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
Route::get('/reset-password/{token}', [ProfileController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password-submit', [ProfileController::class, 'resetPasswordSubmit'])->name('reset.password.submit');
Route::get('/dashboard/investor-account', [ProfileController::class,'getUserProfileDetails'])->name('get.user.details');
Route::get('dashboard/user/edit', [ProfileController::class, 'userEditPage'])->name('user.edit.page');
Route::put('/user', [ProfileController::class, 'update'])->name('user.update');
// Route::get('/dashboard/profileview', [ProfileController::class, 'profileView'])->name('profileview');
Route::get('/dashboard/mentorConfidentials/{user_rand_id}', [ProfileController::class, 'edit'])->name('confidential.edit');
Route::post('/dashboard/mentorConfidentials/{user_rand_id}', [ProfileController::class, 'updateConfidential_info'])->name('confidential.update');
Route::get('/dashboard/investorAdvertisement/{user_rand_id?}', [ProfileController::class, 'getInvestorAdvertisementDetails'])->name('confidential.advert_detail');
Route::post('/dashboard/investorAdvertisement/{user_rand_id?}', [ProfileController::class, 'updateInvestorProfileDetails'])->name('advertisement.save');
Route::get('/dashboard/investorMultiPref/{user_rand_id}', [ProfileController::class, 'getInvestorPreferenceDetails'])->name('investorMultiPref');
Route::post('/dashboard/preferences/save', [ProfileController::class, 'savePreferences'])->name('preferences.save');
Route::get('/dashboard/profileview', [ProfileController::class, 'getVisitor'])->name('profileview');
Route::get('/dashboard/profileinfo/{user_rand_id}', [ProfileController::class, 'profileInfo'])->name('profileinfo');
Route::post('/dashboard/investorUpdate', [ProfileController::class, 'investorUpdate'])->name('investor.update');



});



