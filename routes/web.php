<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| AUTH GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        $products = Product::latest()->get();

        return view('home', compact('products'));
    })->name('home');


    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
        ->name('cart.increase');

    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
        ->name('cart.decrease');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/success/{order}', function (Order $order) {
        return view('checkout.success', compact('order'));
    })->name('checkout.success');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN USER
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', function () {

        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));

    })->name('orders.index');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {

        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $latestProducts = Product::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalStock',
            'latestProducts'
        ));

    })->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | CRUD PRODUK
    |--------------------------------------------------------------------------
    */

    Route::resource('admin/products', ProductController::class)
        ->names('admin.products');


    /*
    |--------------------------------------------------------------------------
    | PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/orders', function () {

        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));

    })->name('admin.orders.index');


    Route::post('/admin/orders/{order}/status', function (
        Request $request,
        Order $order
    ) {

        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Sudah Dibayar,Diproses,Selesai',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );

    })->name('admin.orders.status');
});