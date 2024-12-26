<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Branch;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/branch', [FrontendController::class, 'branch'])->name('frontend.branch');
//Route::get('/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::match(['get', 'post'], '/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');

// Backend User Routes
Route::get('/user/dashboard', [DashboardController::class, 'user'])->middleware(['auth'])->name('backend.user.dashboard'); 
Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->middleware(['auth'])->name('backend.staff.dashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware(['auth'])->name('backend.admin.dashboard');

// Logout Route
Route::post('/logout', function () { 
    Auth::logout(); 
    return redirect('/login'); 
})->name('logout');

// Backend Admin Routes (Profile, Members, Contacts)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Profile routes
    Route::get('/profile', [BackendController::class, 'viewProfile'])->name('viewProfile');
    Route::get('/profile/edit', [BackendController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/update', [BackendController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/profile/change-password', [BackendController::class, 'changePasswordForm'])->name('changePasswordForm');
    Route::put('/profile/change-password', [BackendController::class, 'changePassword'])->name('changePassword');

    // Contact info management
    //Route::get('/contacts', [BackendController::class, 'showContacts'])->name('contacts.index');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard/view-members', [BackendController::class, 'viewMembers'])->name('viewMembers');
    Route::get('/dashboard/view-member/{id}', [BackendController::class, 'viewMember'])->name('viewMember');
    Route::get('/dashboard/download-member/{id}', [BackendController::class, 'downloadMember'])->name('downloadMember');
    Route::get('/dashboard/reset-password/{id}', [BackendController::class, 'resetPassword'])->name('resetPassword');
    Route::get('/dashboard/send-message/{id}', [BackendController::class, 'sendMessage'])->name('sendMessage');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::match(['get', 'post'], '/change-logo', [WebsiteController::class, 'changeLogo'])->name('changeLogo');
    Route::get('/view-contact', [WebsiteController::class, 'viewContact'])->name('viewContact');
    Route::get('/view-slider', [WebsiteController::class, 'viewSlider'])->name('viewSlider');
    Route::match(['get', 'post'], '/change-slider', [WebsiteController::class, 'changeSlider'])->name('changeSlider');
    Route::get('/branches', [WebsiteController::class, 'branches'])->name('branches');
    Route::get('/view-about', [WebsiteController::class, 'viewAbout'])->name('viewAbout');
    Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
    Route::get('/create-branch', [WebsiteController::class, 'createBranch'])->name('createBranch');
    Route::post('/store-branch', [WebsiteController::class, 'storeBranch'])->name('storeBranch');
    Route::get('/edit-branch/{id}', [WebsiteController::class, 'editBranch'])->name('editBranch');
    Route::put('/update-branch/{id}', [WebsiteController::class, 'updateBranch'])->name('updateBranch');
    Route::delete('/delete-branch/{id}', [WebsiteController::class, 'destroyBranch'])->name('deleteBranch');
});


// Registration Routes
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
Route::get('/register/success', [RegistrationController::class, 'success'])->name('register.success');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

// Login Routes
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
