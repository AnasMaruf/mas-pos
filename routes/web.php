<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RecordTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Models\Category;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterControllerArgumentLocatorsPass;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/', function () {
    $cart = session('cart');
    $grandtotal = 0;
    if ($cart) {
        foreach ($cart as $ct => $val) {
            $product_id = $ct;
            $subtotal = $val['price'] * $val['qty'];
            $grandtotal += $subtotal;
        }
        return view('dashboard.index', [
            'active' => 'home',
            'title' => 'Halaman Dashboard',
            'categories' => Category::all(),
            'products'  => Product::all(),
            'grandtotal' => number_format($grandtotal)
        ])->with("cart", $cart);
    } else {
        return view('dashboard.index', [
            'active' => 'home',
            'title' => 'Halaman Dashboard',
            'categories' => Category::all(),
            'products'  => Product::all(),
            'grandtotal' => number_format($grandtotal)
        ]);
    }
})->middleware('auth');
// Route::get('/{Keranjang:product_id}', function (Keranjang $keranjang) {
//     $cart = session('cart');
//     $product = Product::where('id', $keranjang->product_id)->first();
//     $cart[$keranjang->product_id] = [
//         "name" => $product->name,
//         "price" => $product->price,
//         "image" => $product->image,
//         "qty"   => 1
//     ];
//     $grandtotal = 0;
//     foreach ($cart as $val) {
//         $subtotal = $val['price'] * $val['qty'];
//         $grandtotal += $subtotal;
//     }
//     session(["cart" => $cart]);
//     return redirect("/")->with(['subtotal' => number_format($grandtotal)]);
// });
Route::resource('/dashboard/category', CategoryController::class)->middleware('auth');
Route::resource('/dashboard/products', ProductsController::class)->middleware('auth');
Route::get('/cart/tambah/{id}', [ProductsController::class, 'do_tambah_cart'])->where("id", "[0-9]+")->middleware('auth');
Route::get('/cart', [ProductsController::class, 'cart'])->middleware('auth');
Route::post('/cart/increment-decrement/{id}', [CartController::class, 'increment_decrement'])->middleware('auth');
Route::get('/cart/hapus/{id}', [ProductsController::class, 'do_hapus_cart'])->where("id", "[0-9]+")->middleware('auth');
Route::get('/transaksi/tambah', [ProductsController::class, 'do_tambah_transaksi'])->middleware('auth');

Route::get('/payment', [TransaksiController::class, 'payment'])->middleware('auth');

Route::get('/categories/{category:id}', function (Category $category) {
    $cart = session('cart');
    $grandtotal = 0;
    if ($cart) {
        foreach ($cart as $ct => $val) {
            $product_id = $ct;
            $qty = $val['qty'];
            $subtotal = $val['price'] * $val['qty'];
            $grandtotal += $subtotal;
        }
        return view('dashboard.category.product_category', [
            'title' => $category->name,
            'id' => rand(1, 100),
            'products' => $category->products,
            'categories' => Category::all(),
            'grandtotal' => number_format($grandtotal)
        ])->with("cart", $cart);
    } else {
        return view('dashboard.category.product_category', [
            'title' => $category->name,
            'products' => $category->products,
            'categories' => Category::all(),
            'grandtotal' => number_format($grandtotal)
        ]);
    }
})->middleware('auth');
Route::post('/addtocart/categories/{id}', [AddToCartController::class, 'index']);
Route::resource('/record/transaksi', RecordTransaksiController::class)->parameters([
    'transaksi' => 'transaksi:id',
    'keranjang' => 'keranjang:id'
]);
Route::get('/record/keranjang/{id}', [RecordTransaksiController::class, 'fetchData']);
Route::get('/record/keranjang/{id}/edit', [RecordTransaksiController::class, 'edit_transaksi']);
Route::put('/record/keranjang/{id}', [RecordTransaksiController::class, 'update_transaksi']);
Route::put('/update/quantity-transaksi/{id}', [RecordTransaksiController::class, 'update_quantity']);
Route::put('/transaksi/update/{id}', [RecordTransaksiController::class, 'update_grandtotal_transaksi']);

// Route::resource('/detail/record-transaksi/{id}', DetailTransaksiController::class)->parameters([
//     'record-transaksi' => 'transaksis:id'
// ]);
Route::get('/modal/price/{id}', [ProductsController::class, 'modal']);
Route::put('/modal/grandtotal/{id}', [ProductsController::class, 'grandtotal']);
