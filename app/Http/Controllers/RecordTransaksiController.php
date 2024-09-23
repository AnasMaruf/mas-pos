<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        return view('dashboard.transaksi.index', [
            'transaksis' => Transaksi::paginate($pagination)
        ])->with('i', ($request->input('page', 1) - 1) * $pagination +1);
    }

    public function fetchData($id)
    {
        $keranjangs = Keranjang::with('product')
            ->where('transaksi_id', $id)
            ->get();
        return response()->json([
            'keranjangs' => $keranjangs
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Keranjang $keranjang, Transaksi $transaksi, Request $request)
    {

        $loc = 0;
        for ($x = 1; $x < count($transaksi->keranjangs); $x++) {
            if ((int)$transaksi->keranjangs[$x]['id'] == (int)$keranjang->product_id) {
                $loc = $x;
            }
        }
        $cart = $transaksi->keranjangs[$loc]['id'];

        return view('dashboard.detail.index', [
            'carts' => $transaksi->keranjangs,
            'transaksi' => $transaksi,
            'keranjang' => Keranjang::all(),
            'products' => Product::all(),
            'id' => $cart,
            'grandtotal' => $transaksi->grandtotal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(Keranjang $keranjang)
    {
        return view('dashboard.transaksi.edit', [
            'cart' => $keranjang,
            'products' => Product::all(),
            // 'id' => $keranjang->id,
            'transaksis' => Transaksi::all()
        ]);
    }

    public function edit_transaksi($id)
    {
        $carts = Keranjang::find($id);
        $cartsAll = Keranjang::all();
        $harga = $carts->product->price;

        if ($carts) {
            return response()->json([
                'status' => 200,
                'cart' => $carts,
                'keranjang' => $cartsAll,
                'product' => $harga
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Cart not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        $validatedData = $request->validate([
            'transaksi_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'subtotal' => 'required'
        ]);

        Keranjang::where('id', $keranjang->id)
            ->update($validatedData);
        return redirect('/record/transaksi')->with('success', 'Record transaksi has been updated');
    }

    public function update_transaksi(Request $request, Transaksi $transaksi, Keranjang $keranjang, $id)
    {
        $rules = [
            'product_id' => 'required',
            // 'qty'   => 'required',
            'subtotal' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            $carts = Keranjang::find($id);
            $qty = $carts->qty;
            $harga = $request->input('subtotal');

            if ($carts) {

                $total = $qty * $harga;
                $carts->update([
                    'product_id' => $request->input('product_id'),
                    // 'qty' =>  $request->input('qty'),
                    'subtotal' => $total
                ]);

                return response()->json([
                    'status' => 200,
                    'data' => $carts,
                    'total' => $total,
                    'message' => 'Data Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Not Found'
                ]);
            }
        }
    }

    public function update_quantity(Request $request, $id)
    {
        $cart = keranjang::find($id);
        $harga = $cart->product->price;
        if (!$cart) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ]);
        }
        $qty = (int)$request['quantity'];

        $total = $harga * $qty;
        $cart->update([
            'qty' => (int)$request['quantity'],
            'subtotal' => $total
        ]);
        return response()->json([
            'status' => 200,
            'data' => $cart,
            'total' => $total,
            'message' => 'Quantity updated successful'
        ]);
    }

    public function update_grandtotal_transaksi($id)
    {
        $tanggal = date("Y-m-d");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keranjang $keranjang)
    {
        Keranjang::destroy($keranjang->id);
        return redirect('/record/transaksi')->with('success', 'Record Transaksi has been deleted');
    }
}
