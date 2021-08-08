<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_order_tunai extends Model
{
    protected $fillable = [
        'master_order_t_id', 'product_id', 'qty', 'harga'
    ];

    public function Master_order_t()
    {
        return $this->belongsTo(Master_order_t::class, 'master_order_t_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}
