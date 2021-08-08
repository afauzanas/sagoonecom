<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price', 'desc', 'image'
    ];

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function Detail_order_k()
    {
        return $this->hasMany('App\Detail_order_k');
    }

    public function Detail_order_tunai()
    {
        return $this->hasMany('App\Detail_order_tunai');
    }

    public function Detail_persediaan()
    {
        return $this->hasMany('App\Detail_persediaan');
    }

    public function Detail_nota_luring()
    {
        return $this->hasMany('App\Detail_nota_luring');
    }
}
