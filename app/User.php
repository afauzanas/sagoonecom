<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'kota_kab', 'address', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Permintaan_hb_kredit()
    {
        return $this->hasMany('App\Permintaan_hb_kredit');
    }

    public function Hb_kredit_disetujui()
    {
        return $this->hasMany('App\Hb_kredit_disetujui');
    }

    public function Master_order_k()
    {
        return $this->hasMany('App\Master_order_k');
    }

    public function Pengiriman_barang_k()
    {
        return $this->hasMany('App\Pengiriman_barang_k');
    }

    public function Konfir_terima_barang_k()
    {
        return $this->hasMany('App\Konfir_terima_barang_k');
    }

    Public function Faktur_lunas()
    {
        return $this->hasMany('App\Faktur_lunas');
    }

    public function Master_order_t()
    {
        return $this->hasMany('App\Master_order_t');
    }

    public function Order_kredit_disetujui()
    {
        return $this->hasMany('App\Order_kredit_disetujui');
    }

    public function Pengiriman_barang_t()
    {
        return $this->hasMany('App\Pengiriman_barang_t');
    }

    public function Master_persediaan()
    {
        return $this->hasMany('App\Master_persediaan');
    }

    public function Master_nota_luring()
    {
        return $this->hasMany('App\Master_nota_luring');
    }
}
