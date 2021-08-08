<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_order_k extends Model
{
    protected $fillable = [
        'master_order_k_id', 'product_id', 'qty', 'harga'
    ];

    public function Master_order_k()
    {
        return $this->belongsTo('App\Master_order_k', 'master_order_k_id', 'id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
