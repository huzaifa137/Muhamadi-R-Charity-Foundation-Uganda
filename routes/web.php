<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\AboutPageController as AdminAboutPageController;
use App\Http\Controllers\ProgramPageController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\PublicAuthController;
use App\Http\Controllers\OperationsPublicController;
use App\Http\Controllers\Admin\OperationsController;
use App\Http\Controllers\Admin\SitePageContentController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('public.home', ['page' => \App\Models\SitePageContent::where('page_key', 'home')->firstOrFail()]))->name('home');
Route::get('/about', AboutPageController::class)->name('about');
Route::get('/programs', ProgramPageController::class)->name('programs');
Route::get('/impact', [OperationsPublicController::class, 'impact'])->name('impact');
Route::get('/stories', [OperationsPublicController::class, 'stories'])->name('stories');
Route::get('/stories/{slug}', [OperationsPublicController::class, 'story'])->where('slug', '[a-zA-Z0-9-]+')->name('stories.show');
Route::get('/gallery', [OperationsPublicController::class, 'gallery'])->name('gallery');
Route::get('/get-involved', fn () => view('public.get-involved', ['page' => \App\Models\SitePageContent::where('page_key', 'get-involved')->firstOrFail()]))->name('get-involved');
Route::post('/donate', [OperationsPublicController::class, 'donate'])->middleware('throttle:5,1')->name('donate.submit');
Route::post('/volunteer', [OperationsPublicController::class, 'volunteer'])->middleware('throttle:5,1')->name('volunteer.submit');
Route::get('/contact', fn () => view('public.contact', ['page' => \App\Models\SitePageContent::where('page_key', 'contact')->firstOrFail()]))->name('contact');
Route::post('/contact', [OperationsPublicController::class, 'contact'])->middleware('throttle:5,1')->name('contact.submit');

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

    // Editable public pages use the same active-admin and content-role checks as About and Programs.
    Route::get('/site-pages', [SitePageContentController::class, 'index'])->name('site-pages.index');
    Route::get('/site-pages/{page}/edit', [SitePageContentController::class, 'edit'])->where('page', 'home|impact|stories|contact|get-involved')->name('site-pages.edit');
    Route::put('/site-pages/{page}', [SitePageContentController::class, 'update'])->where('page', 'home|impact|stories|contact|get-involved')->middleware('throttle:20,1')->name('site-pages.update');

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');\n    Route::get('/reports/{report}/export.csv', [ReportsController::class, 'export'])->where('report', 'donations|projects|stories|volunteers|enquiries')->name('reports.export');\n    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');\n    Route::put('/settings', [SettingsController::class, 'update'])->middleware('throttle:10,1')->name('settings.update');\n    Route::get('/activity-log', [SettingsController::class, 'activityLog'])->name('activity-log.index');\n\n    // Unified operations modules. Every controller action re-checks the active admin and role.
    Route::get('/operations/{module}', [OperationsController::class, 'index'])->where('module', 'donations|impact|stories|gallery|volunteers|enquiries')->name('operations.index');
    Route::get('/operations/{module}/create', [OperationsController::class, 'create'])->where('module', 'donations|impact|stories|gallery|volunteers|enquiries')->name('operations.create');
    Route::post('/operations/{module}', [OperationsController::class, 'store'])->where('module', 'donations|impact|stories|gallery|volunteers|enquiries')->middleware('throttle:20,1')->name('operations.store');
    Route::get('/operations/{module}/{id}/edit', [OperationsController::class, 'edit'])->where(['module' => 'donations|impact|stories|gallery|volunteers|enquiries', 'id' => '[0-9]+'])->name('operations.edit');
    Route::put('/operations/{module}/{id}', [OperationsController::class, 'update'])->where(['module' => 'donations|impact|stories|gallery|volunteers|enquiries', 'id' => '[0-9]+'])->middleware('throttle:30,1')->name('operations.update');
    Route::delete('/operations/{module}/{id}', [OperationsController::class, 'destroy'])->where(['module' => 'donations|impact|stories|gallery|volunteers|enquiries', 'id' => '[0-9]+'])->middleware('throttle:10,1')->name('operations.destroy');
    Route::get('/donations/{id}/receipt', [OperationsController::class, 'receipt'])->whereNumber('id')->name('donations.receipt');
});
