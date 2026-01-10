<?php

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
Route::post('/register-proses', function (Request $request) {
    return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
})->name('register.submit');

// --- PROSES LOGIN ---
Route::post('/login-proses', function (Request $request) {
    return redirect()->route('home');
})->name('login.submit');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
//     Volt::route('settings/password', 'settings.password')->name('user-password.edit');
//     Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

//     Volt::route('settings/two-factor', 'settings.two-factor')
//         ->middleware(
//             when(
//                 Features::canManageTwoFactorAuthentication()
//                     && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
//                 ['password.confirm'],
//                 [],
//             ),
//         )
//         ->name('two-factor.show');
// });
