<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'title' => 'Add Product',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:75',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:1024'
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        Product::create($validatedData);
        return redirect('/')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);
        return redirect('/')->with('success', 'Product has been deleted');
    }

    public function do_tambah_cart($id)
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

        session(["cart" => $cart]);
        return redirect("/")->with(['subtotal' => number_format($grandtotal)]);
    }

    public function cart()
    {
        $cart = session('cart');
        return view('dashboard.keranjang.cart')->with("cart", $cart);
    }

    public function do_hapus_cart($id)
    {
        $cart = session("cart");
        unset($cart[$id]);
        session(["cart" => $cart]);
        return redirect("/cart");
    }

    public function do_tambah_transaksi()
    {
        $cart = session('cart');
        $tanggal = date("Y-m-d");
        $grandtotal = 0;
        foreach ($cart as $ct => $val) {
            $product_id = $val['id'];
            $qty = $val['qty'];
            $subtotal = $val['price'] * $val['qty'];
            $grandtotal += $subtotal;
        }

        $transaksi_id = Transaksi::tambah_transaksi($tanggal, $grandtotal);
        $grandtotall = 0;
        foreach ($cart as $ct => $val) {
            $product_id = $val['id'];
            $qty = $val['qty'];
            $subtotal = $val['price'] * $val['qty'];
            $grandtotall += $subtotal;

            Keranjang::tambah_detail_transaksi($product_id, $transaksi_id, $qty, $subtotal);
        }
        session()->forget('cart');
        return redirect("/payment")->with(['subtotal' => number_format($grandtotall)]);
    }

    public function modal($id)
    {
        $modal = Product::find($id);

        return response()->json([
            'status' => 200,
            'data' => $modal
        ]);
    }

    public function grandtotal(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $tanggal = date("Y-m-d");
        if (!$transaksi) {
            return response()->json([
                'status' => 404,
                'message' => 'Grandtotal not found'
            ]);
        }
        $grandtotal = (int)$request['total'];
        $transaksi->update([
            'grandtotal' => $grandtotal,
            'tanggal' => $tanggal
        ]);
        return response()->json([
            'status' => 200,
            'total' => $grandtotal,
            'message' => 'Data Transaksi has been Updated'
        ]);
    }
}
