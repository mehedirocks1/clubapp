<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\MemberController;






/*
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::get('members/edit/{id}', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('members/update/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('members.destroy'); 
    Route::put('members/status/{id}', [MemberController::class, 'updateStatus'])->name('members.updateStatus');
    Route::get('members/show/{id}', [MemberController::class, 'show'])->name('members.show');

});
*/


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::get('members/edit/{id}', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('members/update/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::put('members/status/{id}', [MemberController::class, 'updateStatus'])->name('members.updateStatus');
    Route::get('members/show/{id}', [MemberController::class, 'show'])->name('members.show');
});











// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/branch', [FrontendController::class, 'branch'])->name('frontend.branch');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');


//Backend User Routes


Route::get('/user/dashboard', [DashboardController::class, 'user'])
    ->middleware(['auth'])
    ->name('backend.user.dashboard'); // Correct route name for user dashboard

Route::get('/staff/dashboard', [DashboardController::class, 'staff'])
    ->middleware(['auth'])
    ->name('backend.staff.dashboard'); // Correct route name for staff dashboard

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth'])
    ->name('backend.admin.dashboard'); // Correct route name for admin dashboard




//Logout ROute
 Route::post('/logout', function () { Auth::logout(); return redirect('/login'); })->name('logout');




 //Backend Admin Routes
 Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
     Route::get('/dashboard/view-members', [BackendController::class, 'viewMembers'])->name('viewMembers');
     Route::get('/dashboard/view-member/{id}', [BackendController::class, 'viewMember'])->name('viewMember');
     Route::get('/dashboard/download-member/{id}', [BackendController::class, 'downloadMember'])->name('downloadMember');
     Route::get('/dashboard/reset-password/{id}', [BackendController::class, 'resetPassword'])->name('resetPassword');
     Route::get('/dashboard/send-message/{id}', [BackendController::class, 'sendMessage'])->name('sendMessage');
 });
 






 
 Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Show Admin Profile
    Route::get('/profile', [BackendController::class, 'viewProfile'])->name('viewProfile');
    
    // Edit Admin Profile
    Route::get('/profile/edit', [BackendController::class, 'editProfile'])->name('editProfile');

    // Update Admin Profile
    Route::post('/profile/update', [BackendController::class, 'updateProfile'])->name('updateProfile');
    
    // Show Change Password Form
    Route::get('/profile/change-password', [BackendController::class, 'changePasswordForm'])->name('changePasswordForm');

    // Change Admin Password
    Route::post('/profile/change-password', [BackendController::class, 'changePassword'])->name('changePassword');
});








// Custom Registration Routes
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
//oute::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::get('/register/success', [RegistrationController::class, 'success'])->name('register.success');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');


//Login System
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
