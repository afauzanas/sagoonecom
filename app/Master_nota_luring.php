<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Master_nota_luring extends Model
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
            'no_nota_luring' => [
                'format' => function () {
                    return 'OL/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }


    protected $fillable = [
        'no_nota_luring', 'ket', 'user_id'
    ];

    public function detail()
    {
        return $this->hasMany('App\Detail_nota_luring');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
