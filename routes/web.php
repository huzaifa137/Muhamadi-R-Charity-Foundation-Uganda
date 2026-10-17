<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\AboutPageController as AdminAboutPageController;
use App\Http\Controllers\ProgramPageController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\PublicAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/test-route', function () {
    return response('ADMIN ROUTE TEST OK', 200);
});

Route::get('/route-probe', function () {
    return response('ROOT ROUTE TEST OK', 200);
});

Route::view('/', 'public.home')->name('home');
Route::get('/about', AboutPageController::class)->name('about');
Route::get('/programs', ProgramPageController::class)->name('programs');
Route::view('/impact', 'public.impact')->name('impact');
Route::view('/stories', 'public.stories')->name('stories');
Route::view('/gallery', 'public.gallery')->name('gallery');
Route::view('/get-involved', 'public.get-involved')->name('get-involved');
Route::view('/contact', 'public.contact')->name('contact');

// Public-user authentication, separate from the admin route group.
Route::middleware('guest')->group(function () {
    Route::get('/login', [PublicAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PublicAuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
    Route::get('/register', [PublicAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PublicAuthController::class, 'register'])->middleware('throttle:5,1')->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PublicAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [PublicAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // StaffController verifies an active administrator and Super Administrator role
    // on every management action, independently of whether the route is bookmarked.
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::post('/staff', [StaffController::class, 'store'])->middleware('throttle:10,1')->name('staff.store');
    Route::put('/staff/{id}', [StaffController::class, 'update'])->whereNumber('id')->middleware('throttle:20,1')->name('staff.update');

    // ProgramController enforces active-session and content-role access checks.
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
    Route::post('/programs', [ProgramController::class, 'store'])->middleware('throttle:20,1')->name('programs.store');
    Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->middleware('throttle:30,1')->name('programs.update');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->middleware('throttle:10,1')->name('programs.destroy');

    // About page editor uses the same active-admin and content-role checks as programs.
    Route::get('/about', [AdminAboutPageController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AdminAboutPageController::class, 'update'])->middleware('throttle:20,1')->name('about.update');
});
