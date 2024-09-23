<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'product_id',
    //     'qty',
    //     'subtotal'
    // ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    static function tambah_detail_transaksi($product_id, $transaksi_id, $qty, $subtotal)
    {
        Keranjang::create([
            "product_id" => $product_id,
            "transaksi_id" => $transaksi_id,
            "qty"   => $qty,
            "subtotal" => $subtotal
        ]);
    }
}
