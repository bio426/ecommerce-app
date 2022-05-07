<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

Route::get('/', function () {
    if(Auth::check()){
        return redirect("dashboard");
    }

    $products = Product::all();

    return view('welcome', ["products" => $products]);
});

Route::get('/dashboard', [ProductController::class, "showProducts"])->middleware(['auth'])->name('dashboard');

Route::get("/products", [ProductController::class, "showUserProducts"])->middleware(["auth"])->name("products");

Route::get("/products/create", [ProductController::class, "showProductCreator"])->middleware(["auth"])->name("products.create");

Route::post("/products/create", [ProductController::class, "createProduct"])->middleware(["auth"]);

Route::delete("/products/{id}", [ProductController::class, "deleteProduct"])->middleware(["auth"]);

Route::get("/orders", [OrderController::class, "showOrders"])->middleware(["auth"])->name("orders");

Route::post("/orders/create", [OrderController::class, "createOrder"])->middleware(["auth"]);

Route::post("/orders/deliver", [OrderController::class, "deliverOrder"])->middleware(["auth"]);

Route::get("/cart", [CartController::class, "showCart"])->middleware(["auth"]);

Route::post("/cart/add/{id}", [CartController::class, "addToCart"])->middleware(["auth"]);

Route::delete("/cart", [CartController::class, "clearCart"])->middleware(["auth"]);

Route::delete("/cart/{id}", [CartController::class, "deleteCartItem"])->middleware(["auth"]);

require __DIR__ . '/auth.php';
