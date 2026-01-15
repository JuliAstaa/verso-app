<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

Route::get('/', function(){
    return view('pages.landing');
})->name('home');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// --- PROSES REGISTER ---
// Route::post('/register-proses', function (Request $request) {
//     return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
// })->name('register.submit');

// --- PROSES LOGIN ---
// Route::post('/login-proses', function (Request $request) {
//     return redirect()->route('home');
// })->name('login.submit');

// routes/web.php
Route::post('/login-submit', function () {
    return back()->with('error', 'This account has been suspended for violating community terms.');
})->name('login.submit');

Route::post('/register-submit', function () {
    return back()->with('error', 'This username is already in use. Please choose a different one or try to sign in to your existing account.');
})->name('register.submit');

Route::get('/profile/bio', function () {
    return view('pages.user-profile.profile'); // Nama file blade kamu (profile.blade.php)
});

Route::get('/profile/payment', function () {
    return view('pages.user-profile.payment'); // Nama file blade kamu (profile.blade.php)
});

Route::get('/profile/transaction', function () {
    return view('pages.user-profile.transaction'); // Nama file blade kamu (profile.blade.php)
});

Route::get('/profile/wishlist', function () {
    return view('pages.user-profile.wishlist'); // Nama file blade kamu (profile.blade.php)
});

Route::get('/profile/address-list', function () {
    return view('pages.user-profile.address-list'); // Nama file blade kamu (profile.blade.php)
});

// Route Admin
// Route Tampilan Dashboard
// Route::get('/admin/dashboard', function(){
//     return view('pages.admin.dashboard');
// })->name('admin.dashboard');
// // Route Tampilan Products
// Route::get('/admin/products', function(){
//     return view('pages.admin.products');
// })->name('admin.products');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('dashboard', function(){
        return view('pages.admin.dashboard');
    })->name('dashboard');
    Route::resource('sizes', SizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
