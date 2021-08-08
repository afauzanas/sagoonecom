<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Permintaan_hb_kredit extends Model
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
            'no_minta_kredit' => [
                'format' => function () {
                    return 'PK/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_minta_kredit', 'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Hb_kredit_disetujui()
    {
        return $this->hasOne('App\Hb_kredit_disetujui')->withDefault(['id' => 0]);
    }
}
