<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function payment()
    {
        return view('dashboard.payment.index');
    }
}
