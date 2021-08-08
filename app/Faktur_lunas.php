<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faktur_lunas extends Model
{
    protected $fillable = [
        'pengiriman_barang_k_id', 'tgl_lunas', 'ket', 'user_id'
    ];

    public function Pengiriman_barang_k()
    {
        return $this->belongsTo('App\Pengiriman_barang_k');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
