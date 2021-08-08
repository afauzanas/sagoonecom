<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Support\Facades\DB;

class Pengiriman_barang_k extends Model
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
            'no_faktur' => [
                'format' => function () {
                    return 'FSO/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_faktur', 'order_kredit_disetujui_id', 'tgl_kirim', 'ongkir', 'estimasi_sampai', 'ekspedisi_id', 'resi_pengiriman', 'user_id'
    ];

    public function Ekspedisi()
    {
        return $this->belongsTo('App\Ekspedisi');
    }

    public function Order_kredit_disetujui()
    {
        return $this->belongsTo('App\Order_kredit_disetujui');
    }

    public function faktur_lunas()
    {
        return $this->hasOne('App\Faktur_lunas')->withDefault(['id' => 0]);
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Konfir_terima_barang_k()
    {
        return $this->hasOne('App\Konfir_terima_barang_k')->withDefault(['id' => 0]);
    }

    public function scopeTpp()
    {
        // $tpps = DB::select("SELECT year(Tabel_bantuans.tgl_kirim) AS tahun, SUM(Tabel_bantuans.nilai) AS pk FROM (
        //                 SELECT Pengiriman_barang_ks.*, pbks.nilai From Pengiriman_barang_ks
        //                     INNER JOIN (SELECT Order_kredit_disetujuis.*, orders.nilai FROM Order_kredit_disetujuis
        //                         INNER JOIN (SELECT master_order_k_id, SUM(qty * harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) orders
        //                         ON Order_kredit_disetujuis.master_order_k_id = orders.master_order_k_id) pbks
        //                     ON Pengiriman_barang_ks.order_kredit_disetujui_id = pbks.id
        //             ) AS Tabel_bantuans GROUP BY year(tgl_kirim)");
                    

        // $tpps = DB::select("SELECT Tabel_bantuans.*, IFNULL(Faktur_lunas.id, 0) as id_pelunasan FROM (
        //                 SELECT Pengiriman_barang_ks.*, pbks.nilai From Pengiriman_barang_ks
        //                     INNER JOIN (SELECT Order_kredit_disetujuis.*, orders.nilai FROM Order_kredit_disetujuis
        //                         INNER JOIN (SELECT master_order_k_id, SUM(qty * harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) orders
        //                         ON Order_kredit_disetujuis.master_order_k_id = orders.master_order_k_id) pbks
        //                     ON Pengiriman_barang_ks.order_kredit_disetujui_id = pbks.id
        //             ) AS Tabel_bantuans
        //                 LEFT JOIN Faktur_lunas ON Tabel_bantuans.id = Faktur_lunas.pengiriman_barang_k_id 
        //                 WHERE ISNULL(Faktur_lunas.id) GROUP BY year(tgl_kirim)
        //             ");

        // $tpps = DB::select("SELECT SUM(order_details.nilai) AS nilai, year(tgl_kirim)
        //                     FROM Pengiriman_barang_ks
        //                         INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
        //                         INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
        //                         LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
        //                         INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) order_details
        //                         ON Master_order_ks.id = order_details.master_order_k_id
        //                         WHERE ISNULL(Faktur_lunas.id)
        //                         GROUP BY year(Pengiriman_barang_ks.tgl_kirim)
        //                         ");
            /////////////////////////////////////////////////////////////////////////////////////////
            $tpps = DB::select("SELECT Tabel_induks.tahun AS tahun, Tabel_induks.pk, IFNULL(Tabel_anaks.saldo_pelunasan, 0) AS saldo_pelunasan
            FROM (SELECT SUM(order_details.nilai) AS pk, year(Order_kredit_disetujuis.created_at) AS tahun
            FROM Pengiriman_barang_ks
                INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                ON Master_order_ks.id = order_details.master_order_k_id
                GROUP BY year(Order_kredit_disetujuis.created_at)
                ) AS Tabel_induks
                    LEFT JOIN (
                        SELECT SUM(order_details.sp) AS saldo_pelunasan, year(Faktur_lunas.tgl_lunas) AS tahun
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS sp FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE Faktur_lunas.id != 0
                                    GROUP BY year(Faktur_lunas.tgl_lunas)
                    ) AS Tabel_anaks ON Tabel_induks.tahun = Tabel_anaks.tahun   ");                 


        // $tpps = DB::select("SELECT Tabel_induks.tahun AS tahun, Tabel_induks.pk, Tabel_anaks.saldo_akhir
        // FROM (SELECT SUM(order_details.nilai) AS pk, year(Pengiriman_barang_ks.tgl_kirim) AS tahun
        // FROM Pengiriman_barang_ks
        //     INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
        //     INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
        //     LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
        //     INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) order_details
        //     ON Master_order_ks.id = order_details.master_order_k_id
        //     GROUP BY year(Pengiriman_barang_ks.tgl_kirim)
        //     ) AS Tabel_induks
        //         LEFT JOIN (
        //             SELECT SUM(order_details.sa) AS saldo_akhir, year(Pengiriman_barang_ks.tgl_kirim) AS tahun
        //                     FROM Pengiriman_barang_ks
        //                         INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
        //                         INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
        //                         LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
        //                         INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS sa FROM Detail_order_ks GROUP BY master_order_k_id) order_details
        //                         ON Master_order_ks.id = order_details.master_order_k_id
        //                         WHERE ISNULL(Faktur_lunas.id)
        //                         GROUP BY year(Pengiriman_barang_ks.tgl_kirim)
        //         ) AS Tabel_anaks ON Tabel_induks.tahun = Tabel_anaks.tahun
        //     ");
            // dd($tpps);
        return $tpps;
    }
}
