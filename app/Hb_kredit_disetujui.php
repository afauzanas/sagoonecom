<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Hb_kredit_disetujui extends Model
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
            'no_kredit_disetujui' => [
                'format' => function () {
                    return 'KD/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_kredit_disetujui', 'permintaan_hb_kredit_id', 'user_id'
    ];

    public function Permintaan_hb_kredit()
    {
        return $this->belongsTo('App\Permintaan_hb_kredit');
    }
}
