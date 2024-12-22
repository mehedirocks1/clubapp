<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;





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


// Custom Registration Routes
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
//oute::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::get('/register/success', [RegistrationController::class, 'success'])->name('register.success');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');


//Login System
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
