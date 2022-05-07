<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrders()
    {
        $requested = Auth::user()->orders;

        // Label orders with deleted products

        $userProducts = Auth::user()->products->map(fn ($product) => $product->id);
        $received = collect();
        
        if ($userProducts->isNotEmpty()) { // Checkear cuando el usuario tiene producto pero nadie pide
            $received = Order::where("user_id", "!=", Auth::id())->where("status","=","pending")->get();
            $received = $received->filter(function ($order) use ($userProducts) {
                $orderProducts = $order->products->map(fn ($product) => $product->id);
                $forUser = $userProducts->intersect($orderProducts)->isNotEmpty();
                return $forUser;
            });
        }

        return view(
            "order.index",
            [
                "requested" => $requested,
                "received" => $received
            ]
        );
    }

    public function createOrder(Request $request)
    {
        $itemsId = Session::get("cart.items", []);
        if (count($itemsId) < 1) {
            return redirect()->back()->withErrors(["cart" => "Cart needs to have at least one item."]);
        }

        $validated = $request->validate([
            "destination" => ["required", "max:255"]
        ]);

        $products = Product::find($itemsId);
        $cartPrice = $products->reduce(function ($carry, $product) {
            return $carry + $product->price;
        });
        $quantities = array_count_values($itemsId);
        $order = new Order([
            "destination" => $validated["destination"],
            "price" => $cartPrice,
            "status" => "pending",
        ]);
        $order->user()->associate(Auth::user());
        $order->save();
        $order->products()->sync(
            $products->mapWithKeys(
                function ($product) use ($quantities) {
                    return [$product->id => [
                        "quantity" => $quantities[$product->id],
                        "delivered" => false,
                    ]];
                }
            )
        );
        Session::put("cart.items", []);

        return redirect("dashboard")->with("cartMessage", "Order created.");
    }

    public function deliverOrder(Request $request)
    {
        $orderId = $request->orderId;
        $productId = $request->productId;
        $order = Order::find($orderId);

        $order->products()->updateExistingPivot($productId,[
            "delivered"=>true
        ]);

        $delivered = !$order->products->contains(function($product){
            return !$product->pivot->delivered;
        });
        if($delivered){
            $order->status = "delivered";
            $order->save();
        }


        return redirect("/orders")->with("message","Product sended");
    }
}
