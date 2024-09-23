<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailRecordTransaksiController extends Controller
{
    public function index(Transaksi $transaksi)
    {
        return view('dashboard.detail.index', [
            'carts' => $transaksi->keranjangs
        ]);
    }
}
