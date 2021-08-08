<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metode_bayar extends Model
{
    protected $fillable = [
        'kode_metode', 'metode_bayar'
    ];

    public function Master_order_k()
    {
        return $this->hasMany('App\Master_order_k');
    }

    public function Master_order_ts()
    {
        return $this->hasMany('App\Master_order_ts');
    }
}
