<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserSettingsController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\MediaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'serviceShow'])->name('services.show');
Route::post('/services/{slug}/enquire', [HomeController::class, 'serviceEnquire'])->name('services.enquire');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-us', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-services', [HomeController::class, 'terms'])->name('terms');
Route::get('/term-of-use', [HomeController::class, 'terms'])->name('terms.alias');
Route::get('/page/{slug}', [HomeController::class, 'show'])->name('page.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'sendOtp'])->name('login.send');
Route::get('/login/otp', [LoginController::class, 'showOtpForm'])->name('login.otp');
Route::post('/login/otp', [LoginController::class, 'verifyOtp'])->name('login.verify');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [UserSettingsController::class, 'settings'])->name('settings');
    Route::post('settings', [UserSettingsController::class, 'updateSettings'])->name('settings.update');
    Route::get('profile', [UserSettingsController::class, 'profile'])->name('profile');
    Route::post('profile', [UserSettingsController::class, 'updateProfile'])->name('profile.update');

    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

    Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('menus', [MenuController::class, 'store'])->name('menus.store');
    Route::post('menus/seed', [MenuController::class, 'seed'])->name('menus.seed');
    Route::get('menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');

    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('staff/{staff}', [StaffController::class, 'show'])->name('staff.show');
    Route::get('staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('services-catalog', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services-catalog/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services-catalog', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services-catalog/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services-catalog/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services-catalog/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
    Route::put('enquiries/{enquiry}/status', [EnquiryController::class, 'updateStatus'])->name('enquiries.status');
    Route::delete('enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');

    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::get('states', [StateController::class, 'index'])->name('states.index');
    Route::get('states/create', [StateController::class, 'create'])->name('states.create');
    Route::post('states', [StateController::class, 'store'])->name('states.store');
    Route::get('states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
    Route::put('states/{state}', [StateController::class, 'update'])->name('states.update');
    Route::delete('states/{state}', [StateController::class, 'destroy'])->name('states.destroy');

    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

    Route::get('seos', [SeoController::class, 'index'])->name('seos.index');
    Route::get('seos/create', [SeoController::class, 'create'])->name('seos.create');
    Route::post('seos', [SeoController::class, 'store'])->name('seos.store');
    Route::get('seos/{seo}/edit', [SeoController::class, 'edit'])->name('seos.edit');
    Route::put('seos/{seo}', [SeoController::class, 'update'])->name('seos.update');
    Route::delete('seos/{seo}', [SeoController::class, 'destroy'])->name('seos.destroy');

    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::get('media/create', [MediaController::class, 'create'])->name('media.create');
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::get('media/{media}/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::put('media/{media}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});
