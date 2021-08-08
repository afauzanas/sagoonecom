<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Master_order_t extends Model
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
                    return 'OT/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }


    protected $fillable = [
        'no_order', 'user_id', 'alamat_terima', 'metode_bayar_id', 'token'
    ];

    public function detail()
    {
        return $this->hasMany(Detail_order_tunai::class, 'master_order_t_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Metode_bayar()
    {
        return $this->belongsTo('App\Metode_bayar');
    }

    public function Pengiriman_barang_t()
    {
        return $this->hasOne('App\Pengiriman_barang_t')->withDefault(['id' => 0]);
    }


}
