<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart(Request $request)
    {
        $itemsId = Session::get("cart.items",[]);
        $cartItems = Product::find(array_unique($itemsId));
        $quantities = array_count_values($itemsId);

        foreach ($cartItems as $item) {
            $item->quantity = $quantities[$item->id];
        }

        return view("cart", ["items" => $cartItems]);
    }

    public function addToCart(Request $request, string $id)
    {
        // dd($id);
        Session::push("cart.items", $id);
        Session::increment("cart.count");

        return redirect()->back();
    }

    public function clearCart(Request $request)
    {
        Session::flush();
        Session::put("cart.items", []);
        Session::put("cart.count", 0); // Remove count

        // dd(Session::get("cart.count"));

        return view("cart");
    }

    public function deleteCartItem(Request $request, string $id)
    {
        $currentItems = Session::get("cart.items",[]);
        $index = array_search($id,$currentItems);
        array_splice($currentItems,$index,1);
        Session::put("cart.items",$currentItems);

        // dd($currentItems);

        return redirect()->action([CartController::class, "showCart"]);
    }
}
