<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }
    static function tambah_transaksi($tanggal, $grandtotal)
    {
        $data = Transaksi::create([
            "tanggal" => $tanggal,
            "grandtotal" => $grandtotal
        ]);
        return $data->id;
    }
    static function update_transaksi($tanggal, $grandtotal)
    {
        $data = Transaksi::update([
            "tanggal" => $tanggal,
            "grandtotal" => $grandtotal
        ]);
    }
}
