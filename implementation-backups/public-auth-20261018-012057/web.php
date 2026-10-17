<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/test-route', function () {
    return response('ADMIN ROUTE TEST OK', 200);
});

Route::get('/route-probe', function () {
    return response('ROOT ROUTE TEST OK', 200);
});

Route::view('/', 'public.home')->name('home');
Route::view('/about', 'public.about')->name('about');
Route::view('/programs', 'public.programs')->name('programs');
Route::view('/impact', 'public.impact')->name('impact');
Route::view('/stories', 'public.stories')->name('stories');
Route::view('/gallery', 'public.gallery')->name('gallery');
Route::view('/get-involved', 'public.get-involved')->name('get-involved');
Route::view('/contact', 'public.contact')->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        abort_unless(session()->has('charity_admin_id'), 403, 'Administrator sign-in required.');
        return view('admin.dashboard');
    })->name('dashboard');
});
