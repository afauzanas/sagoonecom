<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_persediaan extends Model
{
    protected $fillable = [
        'master_persediaan_id', 'product_id', 'unit_masuk'
    ];

    public function Master_persediaan()
    {
        return $this->belongsTo('App\Master_persediaan');
    }

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}
