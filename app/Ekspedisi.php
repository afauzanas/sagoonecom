<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    protected $fillable = ['kode_ekspedisi', 'nama_ekspedisi', 'alamat', 'no_tlp'];

    public function Pengiriman_barang_k()
    {
        return $this->hasMany('App\Pengiriman_barang_k');
    }

    public function Pengiriman_barang_t()
    {
        return $this->hasMany('App\Pengiriman_barang_t');
    }
}
