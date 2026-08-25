<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\MentorController as DashboardMentorController;
use App\Http\Controllers\Dashboard\LenderController as DashboardLenderController;
use App\Http\Controllers\Dashboard\InstantResponseController;
use App\Http\Controllers\Dashboard\StartupController as DashboardStartupController;
use App\Http\Controllers\Dashboard\RecommendationController;
use App\Http\Controllers\Dashboard\MyProfilesController;
use App\Http\Controllers\Dashboard\BusinessController as DashboardBusinessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\ContactUsController;


use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\InvestorProfileController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\StartupProfileController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ServiceListingController;
use App\Http\Controllers\BxInsightController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\LenderProfileController;
use App\Http\Controllers\BxServicePaymentController;



// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/newsLetterSubscribe', [SubscribeController::class, 'newsLetterSubscribe'])->name('newsLetterSubscribe')->withoutMiddleware('auth');

Route::get('/businesslisting', [BusinessController::class, 'businessListing'])->name('business.listing');
Route::get('/businesslisting/{business_profile}', [BusinessController::class, 'businessDetail'])->name('business.detail');
Route::get('/investorlisting', [InvestorController::class, 'investorListing'])->name('investor.listing');
Route::get('/investorlisting/{investor_profile}', [InvestorController::class, 'investorDetail'])->name('investor.detail');
Route::get('/mentorlisting', [MentorController::class, 'mentorListing'])->name('mentor.listing');
Route::get('/mentorlisting/{mentor_profile}', [MentorController::class, 'mentorDetail'])->name('mentor.detail');
Route::get('/startuplisting', [StartupController::class, 'startupListing'])->name('startup.listing');
Route::get('/startuplisting/{startup_profile}', [StartupController::class, 'startupDetail'])->name('startup.detail');


Route::get('/registration/create-mentor-profile', [MentorProfileController::class, 'createMentorProfile'])->name('register.create-mentor-profile');
Route::post('/registration/create-mentor-profile', [MentorProfileController::class, 'createMentor'])->name('register.create-mentor');
Route::get('/registration/create-business-profile', [BusinessProfileController::class, 'createBusinessProfile'])->name('register.create-business-profile');
Route::post('/registration/create-business-profile', [BusinessProfileController::class, 'storeBusinessProfile'])->name('register.create-business');
Route::get('/registration/create-investor-profile', [InvestorProfileController::class, 'createInvestorProfile'])->name('register.create-investor-profile');
Route::post('/registration/create-investor-profile', [InvestorProfileController::class, 'createInvestor'])->name('register.create-investor');
Route::get('/registration/create-startup-profile', [StartupProfileController::class, 'createStartupProfile'])->name('register.create-startup-profile');
Route::post('/registration/create-startup-profile', [StartupProfileController::class, 'createStartup'])->name('register.create-startup');
Route::get('/registration/create-lender-profile', [LenderProfileController::class, 'createLenderProfile'])->name('register.create-lender-profile');
Route::post('/registration/create-lender-profile', [LenderProfileController::class, 'createLender'])->name('register.create-lender');

Route::get('/pricing', [PriceController::class, 'priceListing'])->name('pricing.listing');

Route::get('/articles', [BxInsightController::class, 'index'])->name('bxinsight.index');
Route::get('/articles/{id}', [BxInsightController::class, 'show'])->name('bxinsight.show');
Route::post('/articles/{id}/comments', [BxInsightController::class, 'storeComment'])->name('bxinsight.comments.store');

Route::get('/service/business-valuation', [ServiceListingController::class, 'businessValuation'])->name('service.business-valuation');
Route::post('/service/payment/initiate', [BxServicePaymentController::class, 'initiateServicePayment'])->name('service.payment.initiate');
Route::post('/service/payment/payu/success', [BxServicePaymentController::class, 'verifyServicePayment'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
    ->name('service.payment.payu.success');
Route::post('/service/payment/payu/cancel', [BxServicePaymentController::class, 'cancelledServicePayment'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
    ->name('service.payment.payu.cancel');
Route::post('/service/payment/payu/failure', [BxServicePaymentController::class, 'failedServicePayment'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
    ->name('service.payment.payu.failure');
Route::get('/service/business-plan', [ServiceListingController::class, 'businessPlan'])->name('service.business-plan');
Route::get('/service/due-diligence', [ServiceListingController::class, 'dueDiligence'])->name('service.due-diligence');
Route::get('/service/certified-business-broker', [ServiceListingController::class, 'certifiedBusinessBroker'])->name('service.certified-business-broker');



Route::post('/quick-register', [AuthController::class, 'quickRegister'])->name('quick.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard/myaccount', [AuthController::class, 'myaccount'])->middleware('auth')->name('myaccount');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Verify email address at the time regisration
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);
//Shivani
Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-submit', [ProfileController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
Route::get('/reset-password/{token}', [ProfileController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password-submit', [ProfileController::class, 'resetPasswordSubmit'])->name('reset.password.submit');
// routing for static pages start here
Route::view('/about-us', 'statics.about');
Route::view('/disclaimer', 'statics.disclaimer');
Route::view('/privacy-policy', 'statics.privacy');
Route::view('/terms', 'statics.terms');
Route::view('/contact-us', 'statics.contact');
Route::post('/contact-us', [ContactUsController::class, 'submitContactForm'])->name('contact.submit');
Route::view('/sitemap', 'statics.sitemap');
//Shivani Chauhan
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/myinteraction', [ProfileController::class, 'showBxInbox'])->name('myinteraction.index');
    Route::post('/dashboard/myinteraction/fetch', [ProfileController::class, 'getBxInboxNotification'])->name('myinteraction.fetch');
    Route::post('/dashboard/myinteraction/update', [ProfileController::class, 'updateBxinboxNotification'])->name('myinteraction.update');
    Route::get('/dashboard/proposals-sent', [ProfileController::class, 'proposalsSent'])->name('myinteraction.proposals-sent');
    Route::get('/dashboard/proposals-received', [ProfileController::class, 'proposalsReceived'])->name('myinteraction.proposals-received');
    Route::get('/dashboard/instant-responses', [InstantResponseController::class, 'index'])->name('myinteraction.instant-responses');
    Route::post('/dashboard/instant-responses/count', [InstantResponseController::class, 'getInstaRevealCount'])->name('instaresponse.count');
    Route::post('/dashboard/instant-responses/list', [InstantResponseController::class, 'getInstaResponse'])->name('instaresponse.list');
    Route::post('/dashboard/instant-responses/view-update', [InstantResponseController::class, 'viewInstaStatusUpdate'])->name('instaresponse.view-update');
    Route::get('dashboard/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('dashboard/change-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::get('/dashboard/investor-account', [ProfileController::class, 'getUserProfileDetails'])->name('get.user.details');
    Route::get('/set-profile-type/{type}/{profileStr?}', [ProfileController::class, 'setProfileType'])->name('set.profile.type');
    Route::get('/dashboard/recommendations/{profileType}', [RecommendationController::class, 'getRecommendations'])->name('dashboard.recommendations');
    Route::get('/dashboard/myprofiles/new-listings', [MyProfilesController::class, 'newListings'])->name('myprofiles.new-listings');
    Route::get('/dashboard/myprofiles/saved-searches', [MyProfilesController::class, 'savedSearches'])->name('myprofiles.saved-searches');
    Route::get('/dashboard/myprofiles/search-history', [MyProfilesController::class, 'searchHistory'])->name('myprofiles.search-history');
    Route::get('dashboard/user/edit', [ProfileController::class, 'userEditPage'])->name('user.edit.page');
    Route::put('/user', [ProfileController::class, 'update'])->name('user.update');
    Route::get('/dashboard/investorConfidentials/{user_rand_id}',[ProfileController::class, 'edit'])->name('confidential.edit');
    Route::get('/dashboard/investorConfidentials/{user_rand_id}/confidential',[ProfileController::class, 'getConfidentialInfo'])->name('confidential.ajax.get');
    Route::post('/dashboard/investorConfidentials/{user_rand_id}/confidential-update',[ProfileController::class, 'updateConfidential_info'])->name('confidential.ajax.update');
    Route::get('/dashboard/investorConfidentials/{user_rand_id}/advertisement',[ProfileController::class, 'getAdvertisementDetails'])->name('advertisement.ajax.get');
    Route::post('/dashboard/investorConfidentials/{user_rand_id}/advertisement-update',[ProfileController::class, 'updateInvestorProfileDetails'])->name('advertisement.ajax.update');
    Route::get('/dashboard/investorConfidentials/{user_rand_id}/profile',[ProfileController::class, 'getInvestorProfileDetails'])->name('investor.ajax.get');
    Route::post('/dashboard/investorConfidentials/{user_rand_id}/profile-update',[ProfileController::class, 'investorUpdate'])->name('investor.ajax.update');
    Route::get('/dashboard/investorConfidentials/{user_rand_id}/preferences',[ProfileController::class, 'getInvestorPreferenceDetails'])->name('preferences.ajax.get');
    Route::post('/dashboard/investorConfidentials/{user_rand_id}/preferences-update',[ProfileController::class, 'updateInvestorPreferenceDetails'])->name('preferences.ajax.update');
    Route::get('/preferences/sectors/search',[ProfileController::class, 'searchInvestorSectors'])->name('preferences.ajax.sectors');
    Route::get('/dashboard/investorAdvertisement/{user_rand_id?}', [ProfileController::class, 'getAdvertisementDetails'])->name('confidential.advert_detail');
    Route::post('/dashboard/investorAdvertisement/{user_rand_id?}', [ProfileController::class, 'updateInvestorProfileDetails'])->name('advertisement.save');
    Route::post('/dashboard/preferences/save', [ProfileController::class, 'savePreferences'])->name('preferences.save');
    Route::get('/dashboard/investorMultipref/{user_rand_id}',[ProfileController::class, 'getInvestorPreferenceDetails'])->name('preferences.edit');
    Route::get('/dashboard/profileview', [ProfileController::class, 'getVisitor'])->name('profileview');
    Route::get('/dashboard/profileinfo/{user_rand_id}', [ProfileController::class, 'profileInfo'])->name('profileinfo');
    Route::post('/dashboard/investorUpdate/{user_rand_id}', [ProfileController::class, 'investorUpdate'])->name('investor.update');

    // ================= MENTOR DASHBOARD =================
    Route::get('/dashboard/mentor-account', [DashboardMentorController::class, 'getUserProfileDetails'])->name('mentor.get.user.details');
    Route::get('/dashboard/mentorConfidentials/{user_rand_id}', [DashboardMentorController::class, 'edit'])->name('mentor.confidential.edit');
    Route::get('/dashboard/mentorConfidentials/{user_rand_id}/confidential', [DashboardMentorController::class, 'getConfidentialInfo'])->name('mentor.confidential.ajax.get');
    Route::post('/dashboard/mentorConfidentials/{user_rand_id}/confidential-update', [DashboardMentorController::class, 'updateConfidentialInfo'])->name('mentor.confidential.ajax.update');
    Route::get('/dashboard/mentorConfidentials/{user_rand_id}/advertisement', [DashboardMentorController::class, 'getAdvertisementDetails'])->name('mentor.advertisement.ajax.get');
    Route::post('/dashboard/mentorConfidentials/{user_rand_id}/advertisement-update', [DashboardMentorController::class, 'updateAdvertisementDetails'])->name('mentor.advertisement.ajax.update');
    Route::get('/dashboard/mentorConfidentials/{user_rand_id}/profile', [DashboardMentorController::class, 'getMentorProfileDetails'])->name('mentor.profile.ajax.get');
    Route::post('/dashboard/mentorConfidentials/{user_rand_id}/profile-update', [DashboardMentorController::class, 'updateMentorProfileDetails'])->name('mentor.profile.ajax.update');
    Route::get('/dashboard/mentorConfidentials/{user_rand_id}/preferences', [DashboardMentorController::class, 'getMentorPreferenceDetails'])->name('mentor.preferences.ajax.get');
    Route::post('/dashboard/mentorConfidentials/{user_rand_id}/preferences-update', [DashboardMentorController::class, 'updateMentorPreferenceDetails'])->name('mentor.preferences.ajax.update');
    Route::get('/mentor-categories/search', [DashboardMentorController::class, 'searchMentorCategories'])->name('mentor.categories.ajax.search');

    // ================= LENDER DASHBOARD =================
    Route::get('/dashboard/lender-account', [DashboardLenderController::class, 'getUserProfileDetails'])->name('lender.get.user.details');
    Route::get('/dashboard/lenderConfidentials/{user_rand_id}', [DashboardLenderController::class, 'edit'])->name('lender.confidential.edit');
    Route::get('/dashboard/lenderConfidentials/{user_rand_id}/confidential', [DashboardLenderController::class, 'getConfidentialInfo'])->name('lender.confidential.ajax.get');
    Route::post('/dashboard/lenderConfidentials/{user_rand_id}/confidential-update', [DashboardLenderController::class, 'updateConfidentialInfo'])->name('lender.confidential.ajax.update');
    Route::get('/dashboard/lenderConfidentials/{user_rand_id}/advertisement', [DashboardLenderController::class, 'getAdvertisementDetails'])->name('lender.advertisement.ajax.get');
    Route::post('/dashboard/lenderConfidentials/{user_rand_id}/advertisement-update', [DashboardLenderController::class, 'updateAdvertisementDetails'])->name('lender.advertisement.ajax.update');
    Route::get('/dashboard/lenderConfidentials/{user_rand_id}/preferences', [DashboardLenderController::class, 'getLenderPreferenceDetails'])->name('lender.preferences.ajax.get');
    Route::post('/dashboard/lenderConfidentials/{user_rand_id}/preferences-update', [DashboardLenderController::class, 'updateLenderPreferenceDetails'])->name('lender.preferences.ajax.update');

    // ================= STARTUP DASHBOARD =================
    Route::get('/dashboard/startup-account', [DashboardStartupController::class, 'getUserProfileDetails'])->name('startup.get.user.details');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}', [DashboardStartupController::class, 'edit'])->name('startup.confidential.edit');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/confidential', [DashboardStartupController::class, 'getConfidentialInfo'])->name('startup.confidential.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/confidential-update', [DashboardStartupController::class, 'updateConfidentialInfo'])->name('startup.confidential.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/advertisement', [DashboardStartupController::class, 'getAdvertisementDetails'])->name('startup.advertisement.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/advertisement-update', [DashboardStartupController::class, 'updateAdvertisementDetails'])->name('startup.advertisement.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/business-info', [DashboardStartupController::class, 'getBusinessInfo'])->name('startup.business.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/business-info-update', [DashboardStartupController::class, 'updateBusinessInfo'])->name('startup.business.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/financial', [DashboardStartupController::class, 'getFinancialDetails'])->name('startup.financial.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/financial-update', [DashboardStartupController::class, 'updateFinancialDetails'])->name('startup.financial.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/headquarters', [DashboardStartupController::class, 'getHeadquarters'])->name('startup.headquarters.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/headquarters-update', [DashboardStartupController::class, 'updateHeadquarters'])->name('startup.headquarters.ajax.update');
    Route::get('/dashboard/startupConfidentials/cities-by-state/{stateCode}', [DashboardStartupController::class, 'getCitiesByState'])->name('startup.headquarters.cities.ajax.get');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/team', [DashboardStartupController::class, 'getTeamDetails'])->name('startup.team.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/team-update', [DashboardStartupController::class, 'updateTeamDetails'])->name('startup.team.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/business-plan', [DashboardStartupController::class, 'getBusinessPlan'])->name('startup.plan.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/business-plan-update', [DashboardStartupController::class, 'updateBusinessPlan'])->name('startup.plan.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/requirement', [DashboardStartupController::class, 'getRequirement'])->name('startup.requirement.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/requirement-update', [DashboardStartupController::class, 'updateRequirement'])->name('startup.requirement.ajax.update');
    Route::get('/dashboard/startupConfidentials/{user_rand_id}/attachments', [DashboardStartupController::class, 'getAttachments'])->name('startup.attachments.ajax.get');
    Route::post('/dashboard/startupConfidentials/{user_rand_id}/attachments-update', [DashboardStartupController::class, 'updateAttachments'])->name('startup.attachments.ajax.update');
    Route::post('/dashboard/startupConfidentials/attachments/{startup_image_id}/delete', [DashboardStartupController::class, 'deleteAttachment'])->name('startup.attachments.ajax.delete');

    // ================= BUSINESS DASHBOARD =================
    Route::get('/dashboard/business-account', [DashboardBusinessController::class, 'getUserProfileDetails'])->name('business.get.user.details');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}', [DashboardBusinessController::class, 'edit'])->name('business.confidential.edit');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/confidential', [DashboardBusinessController::class, 'getConfidentialInfo'])->name('business.confidential.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/confidential-update', [DashboardBusinessController::class, 'updateConfidentialInfo'])->name('business.confidential.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/advertisement', [DashboardBusinessController::class, 'getAdvertisementDetails'])->name('business.advertisement.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/advertisement-update', [DashboardBusinessController::class, 'updateAdvertisementDetails'])->name('business.advertisement.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/business-info', [DashboardBusinessController::class, 'getBusinessInfo'])->name('business.info.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/business-info-update', [DashboardBusinessController::class, 'updateBusinessInfo'])->name('business.info.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/financial', [DashboardBusinessController::class, 'getFinancialDetails'])->name('business.financial.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/financial-update', [DashboardBusinessController::class, 'updateFinancialDetails'])->name('business.financial.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/team', [DashboardBusinessController::class, 'getTeamDetails'])->name('business.team.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/team-update', [DashboardBusinessController::class, 'updateTeamDetails'])->name('business.team.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/headquarters', [DashboardBusinessController::class, 'getHeadquarters'])->name('business.headquarters.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/headquarters-update', [DashboardBusinessController::class, 'updateHeadquarters'])->name('business.headquarters.ajax.update');
    Route::get('/dashboard/businessConfidentials/cities-by-state/{stateCode}', [DashboardBusinessController::class, 'getCitiesByState'])->name('business.headquarters.cities.ajax.get');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/requirement', [DashboardBusinessController::class, 'getRequirement'])->name('business.requirement.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/requirement-update', [DashboardBusinessController::class, 'updateRequirement'])->name('business.requirement.ajax.update');
    Route::get('/dashboard/businessConfidentials/{user_rand_id}/attachments', [DashboardBusinessController::class, 'getAttachments'])->name('business.attachments.ajax.get');
    Route::post('/dashboard/businessConfidentials/{user_rand_id}/attachments-update', [DashboardBusinessController::class, 'updateAttachments'])->name('business.attachments.ajax.update');
    Route::post('/dashboard/businessConfidentials/attachments/{business_image_id}/delete', [DashboardBusinessController::class, 'deleteAttachment'])->name('business.attachments.ajax.delete');
});

