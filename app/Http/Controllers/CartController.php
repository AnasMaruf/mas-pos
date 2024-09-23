<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function increment_decrement(Request $request)
    {
        $cart = session('cart');
        // dd($request);
        $loc = 0;
        for ($x = 0; $x < count($cart); $x++) {
            if ((int)$cart[$x]['id'] == (int)$request['id']) {
                $loc = $x;
            }
        }
        $barang = $cart[$loc];
        $barang["qty"] = (int)$request["quantity"];
        $cart[$loc] = $barang;
        session(["cart" => $cart]);

        return response()->json([
            'status' => 200,
            'message' => 'Quantity Updated Successfull',
            'data' => $barang
        ]);
    }
}
