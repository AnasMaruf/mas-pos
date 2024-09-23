<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function index($id)
    {
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }

        $cart = session('cart');
        $found = false;
        foreach ($cart as $val) {
            if ($val['id'] == $id) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product = Product::detail_product($id);
            $cart[] = [
                "id"    => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "qty"   => 1
            ];
        }

        $grandtotal = 0;
        foreach ($cart as $val) {
            $subtotal = $val['price'] * $val['qty'];
            $grandtotal += $subtotal;
        }

        json_encode(session(["cart" => $cart]));
        return response()->json([
            'grandtotal' => number_format($grandtotal)
        ]);
    }
}
