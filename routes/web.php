<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGymController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Frontend\EnquiryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JymListDetailsController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Partner\Auth\AuthController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerEnquiryController;
use App\Http\Controllers\Partner\PartnerGymController;
use App\Http\Controllers\Partner\PartnerGymGalleryController;
use App\Http\Controllers\Partner\PartnerGymMemberController;
use App\Http\Controllers\Partner\PartnerProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/partner/welcome', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gyms', [HomeController::class, 'gyms'])->name('gyms.index');
Route::get('/gyms/suggest', [HomeController::class, 'suggest'])->name('gyms.suggest');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::post('/gym-enquiry', [EnquiryController::class, 'store'])->name('Enquiry.store');
Route::post('/gym-review', [ReviewController::class, 'store'])->name('Review.store');
Route::post('/set-user-city', [HomeController::class, 'setUserCity'])->name('set.user.city');

// Sitemap & SEO
Route::any('/sitemap.xml', [SitemapController::class, 'index']);

// ============================================
// ADMIN ROUTES (User Management & Stats)
// ============================================
Route::prefix('gymhai')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // User Management CRUD
        Route::resource('users', AdminUserController::class)->middleware(\App\Http\Middleware\AdminRoleMiddleware::class);

        // Platform Data Management
        Route::resource('gyms', AdminGymController::class)->scoped(['gym' => 'uuid'])->except(['create', 'store', 'show']);
        Route::resource('partners', AdminPartnerController::class)->except(['create', 'store', 'show']);
    });
});

// THIS MUST BE LAST
Route::get('/{slug}', [JymListDetailsController::class, 'getJymDetails'])->name('Jymlist.details');

Route::any('partner/register', [AuthController::class, 'signup']);
Route::any('partner/login', [AuthController::class, 'login'])->name('partner.login');

Route::middleware(['partner.auth'])->group(function () {
    Route::any('/partner/logout', [PartnerDashboardController::class, 'logout']);

    // Pricing Routes
    Route::get('/partner/pricing', [\App\Http\Controllers\Partner\PartnerSubscriptionController::class, 'pricing'])->name('partner.pricing');
    Route::post('/partner/verify-payment', [\App\Http\Controllers\Partner\PartnerSubscriptionController::class, 'verifyPayment'])->name('partner.verifyPayment');

    Route::middleware(['partner.plan'])->group(function () {
        Route::any('/partner/dashboard', [PartnerDashboardController::class, 'dashboard']);

        Route::any('/partner/gymlist-dashboard', [PartnerGymController::class, 'index'])->name('Partnerjym.index');

        // listing Jym
        Route::any('/partner/gyms-create', [PartnerGymController::class, 'addJymData'])->name('Partnerjym.create');
        Route::any('/partner/gyms-store', [PartnerGymController::class, 'StoreJymData'])->name('Partnerjym.store');
        Route::any('/partner/gyms-edit/{uuid}', [PartnerGymController::class, 'editJymData'])->name('Partnerjym.edit');
        Route::any('/partner/gyms-update/{uuid}', [PartnerGymController::class, 'updateJymData'])->name('Partnerjym.update');

        // Gym Gallery
        Route::get('/partner/gym-gallery', [PartnerGymGalleryController::class, 'index'])->name('Partnerjym.gallery.index');
        Route::post('/partner/gym-gallery', [PartnerGymGalleryController::class, 'store'])->name('Partnerjym.gallery.store');
        Route::delete('/partner/gym-gallery/{id}', [PartnerGymGalleryController::class, 'destroy'])->name('Partnerjym.gallery.destroy');

        // Enquiries
        Route::get('/partner/enquiries', [PartnerEnquiryController::class, 'index'])->name('Partnerjym.enquiries.index');

        // Gym Members CRM
        Route::get('/partner/members', [PartnerGymMemberController::class, 'index'])->name('Partnerjym.members.index');
        Route::get('/partner/members/create', [PartnerGymMemberController::class, 'create'])->name('Partnerjym.members.create');
        Route::post('/partner/members/store', [PartnerGymMemberController::class, 'store'])->name('Partnerjym.members.store');
        Route::get('/partner/members/{id}/edit', [PartnerGymMemberController::class, 'edit'])->name('Partnerjym.members.edit');
        Route::put('/partner/members/{id}', [PartnerGymMemberController::class, 'update'])->name('Partnerjym.members.update');
        Route::delete('/partner/members/{id}', [PartnerGymMemberController::class, 'destroy'])->name('Partnerjym.members.destroy');
        Route::get('/partner/members/{id}/invoice', [PartnerGymMemberController::class, 'invoice'])->name('Partnerjym.members.invoice');
        Route::get('/partner/members/{id}/id-card', [PartnerGymMemberController::class, 'idCard'])->name('Partnerjym.members.id-card');

        // Partner profile
        Route::any('/partner/{token}', [PartnerProfileController::class, 'Partnerprofile'])->name('Partnerjym.profile');

    });
});
