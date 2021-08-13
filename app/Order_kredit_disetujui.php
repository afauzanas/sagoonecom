<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Support\Facades\DB;

class Order_kredit_disetujui extends Model
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
            'no_order_disetujui' => [
                'format' => function () {
                    return 'OKD/' . date('Ymd') . '/?';
                },
                'length' => 3
            ]
        ];
    }

    protected $fillable = [
        'no_order_disetujui', 'master_order_k_id', 'user_id', 'token', 'dl_bayar'
    ];

    public function Master_order_k()
    {
        return $this->belongsTo('App\Master_order_k');
    }

    public function Pengiriman_barang_k()
    {
        return $this->hasOne('App\Pengiriman_barang_k')->withDefault(['id' => 0]);
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeUmurpiutang()
    {
        // $blm_jt = date('Y-m-d');
        // $umurpiutang = DB::select("SELECT Tabel_induks.name AS pelanggan, Tabel_induks.saldo, IFNULL(Tabel_anaks.blm_jt, 0) AS blm_jt
        //     FROM (SELECT SUM(order_details.nilai) AS saldo, Users.name
        //     FROM Pengiriman_barang_ks
        //         INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
        //         INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
        //         LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
        //         INNER JOIN Users ON Users.id = Master_order_ks.user_id
        //         INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) order_details
        //         ON Master_order_ks.id = order_details.master_order_k_id
        //         WHERE ISNULL(Faktur_lunas.id)
        //         GROUP BY Users.name
        //         ) AS Tabel_induks
        //             LEFT JOIN (
        //                 SELECT SUM(order_details.s_bjt) AS blm_jt, Users.name
        //                         FROM Pengiriman_barang_ks
        //                             INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
        //                             INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
        //                             LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
        //                             INNER JOIN Users ON Users.id = Master_order_ks.user_id
        //                             INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
        //                             ON Master_order_ks.id = order_details.master_order_k_id
        //                             WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar >= '$blm_jt'
        //                             GROUP BY Users.name
        //             ) AS Tabel_anaks ON Tabel_induks.name = Tabel_anaks.name");


        $blm_jt = date('Y-m-d');
        $skrg = date('Y-m-d');
        $jt30 = date('Y-m-d', strtotime('-30 days', strtotime($skrg)));
        $jt60 = date('Y-m-d', strtotime('-60 days', strtotime($skrg)));
        $jt90 = date('Y-m-d', strtotime('-90 days', strtotime($skrg)));
        $jt180 = date('Y-m-d', strtotime('-180 days', strtotime($skrg)));
        $jt365 = date('Y-m-d', strtotime('-365 days', strtotime($skrg)));
        $umurpiutang = DB::select("SELECT Tabel_induks.name AS pelanggan, Tabel_induks.saldo, IFNULL(Tabel_anaks.blm_jt, 0) AS blm_jt, IFNULL(Tabel_anak2s.1_30, 0) AS jt1, IFNULL(Tabel_anak3s.31_60, 0) AS jt2, IFNULL(Tabel_anak4s.61_90, 0) AS jt3, IFNULL(Tabel_anak5s.91_180, 0) AS jt4, IFNULL(Tabel_anak6s.181_365, 0) AS jt5, IFNULL(Tabel_anak7s.lebih365, 0) AS jt6
            FROM (SELECT SUM(order_details.nilai) AS saldo, Users.name
            FROM Pengiriman_barang_ks
                INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                INNER JOIN Users ON Users.id = Master_order_ks.user_id
                INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                ON Master_order_ks.id = order_details.master_order_k_id
                WHERE ISNULL(Faktur_lunas.id)
                GROUP BY Users.name
                ) AS Tabel_induks
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS blm_jt, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar >= '$blm_jt'
                                    GROUP BY Users.name
                    ) AS Tabel_anaks ON Tabel_induks.name = Tabel_anaks.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS 1_30, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar > '$jt30' AND Order_kredit_disetujuis.dl_bayar < '$skrg'
                                    GROUP BY Users.name
                    ) AS Tabel_anak2s ON Tabel_induks.name = Tabel_anak2s.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS 31_60, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar > '$jt60' AND Order_kredit_disetujuis.dl_bayar < '$jt30'
                                    GROUP BY Users.name
                    ) AS Tabel_anak3s ON Tabel_induks.name = Tabel_anak3s.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS 61_90, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar > '$jt90' AND Order_kredit_disetujuis.dl_bayar < '$jt60'
                                    GROUP BY Users.name
                    ) AS Tabel_anak4s ON Tabel_induks.name = Tabel_anak4s.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS 91_180, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar > '$jt180' AND Order_kredit_disetujuis.dl_bayar < '$jt90'
                                    GROUP BY Users.name
                    ) AS Tabel_anak5s ON Tabel_induks.name = Tabel_anak5s.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS 181_365, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar > '$jt365' AND Order_kredit_disetujuis.dl_bayar < '$jt180'
                                    GROUP BY Users.name
                    ) AS Tabel_anak6s ON Tabel_induks.name = Tabel_anak6s.name
                    LEFT JOIN (
                        SELECT SUM(order_details.s_bjt) AS lebih365, Users.name
                                FROM Pengiriman_barang_ks
                                    INNER JOIN Order_kredit_disetujuis ON Pengiriman_barang_ks.order_kredit_disetujui_id = Order_kredit_disetujuis.id
                                    INNER JOIN Master_order_ks ON Order_kredit_disetujuis.master_order_k_id = Master_order_ks.id
                                    LEFT JOIN Faktur_lunas ON Pengiriman_barang_ks.id = Faktur_lunas.pengiriman_barang_k_id
                                    INNER JOIN Users ON Users.id = Master_order_ks.user_id
                                    INNER JOIN (SELECT Detail_order_ks.master_order_k_id, SUM(qty*harga) AS s_bjt FROM Detail_order_ks GROUP BY master_order_k_id) order_details
                                    ON Master_order_ks.id = order_details.master_order_k_id
                                    WHERE ISNULL(Faktur_lunas.id) AND Order_kredit_disetujuis.dl_bayar < '$jt365'
                                    GROUP BY Users.name
                    ) AS Tabel_anak7s ON Tabel_induks.name = Tabel_anak7s.name

                    ");
        return $umurpiutang;
    }
}
