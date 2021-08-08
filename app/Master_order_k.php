<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Master_order_k extends Model
{
    use AutoNumberTrait;
    
    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'no_order' => [
                'format' => function () {
                    return 'OK/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }


    protected $fillable = [
        'no_order', 'user_id', 'alamat_terima', 'metode_bayar_id'
    ];

    public function detail()
    {
        return $this->hasMany('App\Detail_order_k', 'master_order_k_id', 'id');
    }

    public function Metode_bayar()
    {
        return $this->belongsTo('App\Metode_bayar');
    }

    public function Order_kredit_disetujui()
    {
        return $this->hasOne('App\Order_kredit_disetujui')->withDefault(['id' => 0]);
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }


}
