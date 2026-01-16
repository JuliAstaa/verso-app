<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// --- CONTROLLERS ---
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Front\CheckoutController;

// --- LIVEWIRE COMPONENTS ---
use App\Livewire\Auth\Login;
use App\Livewire\Front\Checkout;
use App\Livewire\Front\Payment\Page as PaymentPage;
use App\Livewire\Product\ProductCategory; 

// --- MODELS (Untuk Testing) ---
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Home / Landing Page
Route::get('/', function(){
    return view('pages.landing');
})->name('pages.home');

// Halaman Produk (Static & Dynamic)
Route::get('/product-detail', function(){
    return view('pages.product-detail');
})->name('pages.product-detail');

Route::get('/product/{slug}', function ($slug) {
    return view('pages.product-detail', ['slug' => $slug]);
})->name('product.detail');

// Halaman Kategori (Catalog)
Route::get('/category/{c?}', function($c = null) {
    return view('pages.product-category', ['c' => $c]);
})->name('product.category');


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION (Login, Register, Google)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login Page (Prioritas pakai Livewire)
    Route::get('/login', Login::class)->name('login');
    
    // Register Page
    Route::get('/register', function () {
        return view('pages.register');
    })->name('register');

    // Google Auth
    Route::controller(GoogleController::class)->group(function () {
        Route::get('auth/google', 'redirectToGoogle')->name('google.login');
        Route::get('auth/google/callback', 'handleGoogleCallback');
    });
});

// Dummy Submit Routes (Bawaan Template Frontend - Hapus jika sudah tidak dipakai)
Route::post('/login-submit', fn() => back()->with('error', 'Account suspended.'))->name('login.submit');
Route::post('/register-submit', fn() => back()->with('error', 'Username taken.'))->name('register.submit');


/*
|--------------------------------------------------------------------------
| 3. EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi dikirim!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});


/*
|--------------------------------------------------------------------------
| 4. CUSTOMER AREA (Harus Login & Verified)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Logic Redirect Dashboard (Admin ke Admin, User ke Home)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        }
        return redirect('/'); 
    })->name('dashboard');

    // Shopping Flow
    Route::get('/cart', fn() => view('pages.product-cart'))->name('pages.product-cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('verified');
    Route::get('/payment/thank-you/{order}', PaymentPage::class)->name('payment.show')->middleware('verified');

    // User Profile (Static View Templates - Bawaan Frontend)
    Route::prefix('profile')->group(function() {
        Route::get('/bio', fn() => view('pages.user-profile.profile'))->name('user.profile');
        Route::get('/payment', fn() => view('pages.user-profile.payment'));
        Route::get('/transaction', fn() => view('pages.user-profile.transaction'));
        Route::get('/wishlist', fn() => view('pages.user-profile.wishlist'));
        Route::get('/address-list', fn() => view('pages.user-profile.address-list'));
        Route::get('/notification', fn() => view('pages.user-profile.notif'));
        Route::get('/security', fn() => view('pages.user-profile.security'));
    });

    // User Settings Logic (Volt / Breeze - Backend Functionality)
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
    
    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(when(Features::canManageTwoFactorAuthentication() && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'), ['password.confirm'], []))
        ->name('two-factor.show');
});


/*
|--------------------------------------------------------------------------
| 5. ADMIN AREA (Hanya Role Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (){
    
    Route::get('dashboard', fn() => view('pages.admin.dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('pages.admin.profile'))->name('profile');

    // Master Data Resources
    Route::get('/customers', [UserController::class, 'index'])->name('customers');
    Route::resource('sizes', SizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    
    // Transactions
    Route::resource('orders', OrderController::class);
    
    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});

