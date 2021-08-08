<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_nota_luring extends Model
{
    protected $fillable = [
        'master_nota_luring_id', 'product_id', 'unit', 'harga'
    ];

    public function Master_nota_luring()
    {
        return $this->belongsTo('App\Master_nota_luring');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
