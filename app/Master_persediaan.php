<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Master_persediaan extends Model
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
            'no_mutasi' => [
                'format' => function () {
                    return 'M/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_mutasi', 'tgl_masuk', 'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function detail()
    {
        return $this->hasMany('App\Detail_persediaan');
    }
}
