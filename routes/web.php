<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\UserController;
use App\Livewire\Auth\Login;
use App\Livewire\Front\Checkout;
use App\Livewire\Front\Payment\Page as PaymentPage;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', function(){
    return view('pages.landing');
})->name('pages.home');

Route::get('/product-detail', function(){
    return view('pages.product-detail');
})->name('pages.product-detail');

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// 👇 HAPUS ROUTE INI KALAU UDAH PRODUCTION YA!
Route::get('/test-create-order', function () {
    
    // 1. Ambil User Customer (Pastikan id nya bener customer)
    $user = User::where('role', 'customer')->first();
    
    if (!$user) return 'Gak ada user customer woi! Seeding dulu.';

    // 2. Login Paksa (Biar logic Auth jalan)
    Auth::login($user);

    // 3. Ambil Variant Produk Sembarang
    $variant = ProductVariant::with('product')->inRandomOrder()->first();
    
    if (!$variant) return 'Produk Variant kosong! Isi dulu.';

    // 4. LOGIC CREATE ORDER (Simulasi Checkout)
    $order = DB::transaction(function () use ($user, $variant) {
        
        // A. Bikin Header Order
        $newOrder = Order::create([
            'user_id' => $user->id,
            'invoice_number' => 'INV/TEST/' . date('Ymd') . '/' . rand(1000, 9999),
            'status' => 'pending', // Default Pending
            'recipient_name' => $user->name,
            'recipient_phone' => $user->profile->phone ?? '08123456789',
            'shipping_address' => 'Jalan Testing Jalur Tikus No. 99, Konoha',
            'total_price' => 0, // Nanti diupdate
        ]);

        // B. Bikin Item (Ceritanya beli 2 pcs)
        $qty = 2;
        $price = $variant->price;
        $subTotal = $qty * $price;

        OrderItem::create([
            'order_id' => $newOrder->id,
            'product_variant_id' => $variant->id,
            'quantity' => $qty,
            'price' => $price,
        ]);

        // C. Update Total
        $newOrder->update(['total_price' => $subTotal]);

        return $newOrder;
    });

    return "Sukses Wok! Order ID: $order->id. Invoice: $order->invoice_number. Cek Admin Panel gih!";
});

Route::middleware(['auth', 'verified'])->group(function () { // Pake verified biar aman
    // ... route lain ...
    
    // 1. Halaman Checkout (Input Alamat)
    Route::get('/checkout', Checkout::class)->name('checkout');

    // 2. Halaman Fake Payment Gateway (Bayar Tipu-tipu)
    Route::get('/payment/{order}', PaymentPage::class)->name('payment.show');
});

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
Route::middleware(['auth'])->group(function () {
    
    // 1. Halaman Notice (Tampilan "Please Verify")
    Route::get('/email/verify', function () {
        // Kalau user iseng buka ini padahal udah verified, lempar ke dashboard
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }
        
        return view('auth.verify-email'); // Kita buat view ini di langkah 3
    })->name('verification.notice');

    // 2. Logic Handler Verifikasi (Ini yang link di email)
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard'); // Balik ke dashboard setelah sukses
    })->middleware(['signed'])->name('verification.verify');

    // 3. Tombol Resend Email (Kirim Ulang)
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('message', 'Link verifikasi baru sudah dikirim ke email kamu!');
    })->middleware(['throttle:6,1'])->name('verification.send'); // throttle: max 6x klik per menit biar ga spam

});


Route::get('/dashboard', function () {
    // 1. Cek Role User yang sedang login
    if (auth()->user()->role === 'admin') {
        // Kalau Admin -> Lempar ke Admin Dashboard
        return redirect()->route('admin.dashboard'); 
    }

    // 2. Kalau Customer -> Lempar ke Home / Landing Page
    return redirect('/'); 

})->middleware(['auth', 'verified'])->name('dashboard');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/cart', function(){
        return view('pages.product-cart');
    })->name('pages.product-cart');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('dashboard', function(){
        return view('pages.admin.dashboard');
    })->name('dashboard');
    // Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    // Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/profile', function () {
        return view('pages.admin.profile');
    })->name('profile');

    Route::get('/customers', [UserController::class, 'index'])->name('customers');

    Route::resource('sizes', SizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
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
