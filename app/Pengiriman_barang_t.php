<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pengiriman_barang_t extends Model
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
            'no_enota' => [
                'format' => function () {
                    return 'NSO/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_enota', 'master_order_t_id', 'tgl_kirim', 'ongkir', 'estimasi_sampai', 'ekspedisi_id', 'resi_pengiriman', 'user_id'
    ];

    public function Master_order_t()
    {
        return $this->belongsTo('App\Master_order_t');
    }

    public function Ekspedisi()
    {
        return $this->belongsTo('App\Ekspedisi');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Konfir_terima_barang_t()
    {
        return $this->hasOne('App\Konfir_terima_barang_t')->withDefault(['id' => 0]);
    }
}
