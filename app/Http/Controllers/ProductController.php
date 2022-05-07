<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showProducts(Request $request)
    {
        $products = Product::where("user_id", "!=", Auth::id())->get();

        return view("dashboard", ["products" => $products]);
    }

    public function showUserProducts(Request $request)
    {
        $products = Product::where("user_id", "=", Auth::id())->get();

        $products = $products->map(function ($product) {
            $timesOrdered = 0;
            $timesOrdered = DB::table("order_product")
                ->selectRaw("sum(quantity) as total")
                ->whereRaw("product_id = ?", [$product->id])->get();
            // dd($timesOrdered[0]->total);
            $product->timesOrdered = $timesOrdered[0]->total;
            return $product;
        });

        return view("product.index", ["products" => $products]);
    }

    public function showProductCreator(Request $request)
    {
        return view("product.create");
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "max:255"],
            "price" => ["required", "numeric", "min:0", "max:1000"],
            "image" => ["mimes:jpg,png", "max:5048"]
        ]);

        if (!$request->hasFile("image")) {
            $newImageName = "default-product.png";
        } else {
            $newImageName = time() . "-" . $request->name . "." . $request->image->extension();
            $request->image->move(public_path("product_images"), $newImageName);
        }

        $instance = new Product([
            "name" => $validated["name"],
            "price" => $validated["price"],
            "image_path" => $newImageName
        ]);

        $instance->user()->associate(Auth::user());
        $instance->save();

        return redirect("/products");
    }

    public function deleteProduct(Request $request, $id)
    {
        // Resolver como señalar las ordenes con productos eliminados y eliminar las ordenes pendientes con productos eliminados
        $pendingOrders = Order::where("user_id", "!=", Auth::id())->where("status", "=", "pending")->get();
        $toDelete = $pendingOrders->filter(function ($order) use ($id) {
            $products = $order->products->map(fn ($product) => $product->id);
            $containsDeleted = $products->contains(fn ($product) => $product == $id);
            return $containsDeleted;
        });

        $toDelete->each(function ($order) {
            $order->status = "canceled";
            $order->save();
        });
        $product = Product::find($id);
        $product->delete();

        return redirect("/products")->with("message", "Product Deleted");
    }
}
