<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfir_terima_barang_t extends Model
{
    protected $fillable = [
        'pengiriman_barang_t_id', 'tgl_terima', 'user_id'
    ];

    public function Pengiriman_barang_t()
    {
        return $this->belongsTo('App\Pengiriman_barang_t');
    }
}
