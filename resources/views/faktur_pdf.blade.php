<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Faktur</title>
</head>
<body>
<div class="container">

<center>
<h3>Faktur Penjualan</h3>
<table class="table" rules="none" style="width:100%">
    <thead>
        <tr>
            <th rowspan="3"><img src="{{ public_path('images/Logo-Sagoonecom.png') }}" alt="nopic" height="100" width="100"></th>
            <th>CV Podomoro Makassar</th>
            <th colspan="3" style="text-align: right;">Tgl Faktur:</th>
            <td style="text-align: center;">{{$pbks->created_at}}</td>
        </tr>
        <tr>
            <td style="text-align: center;">Jalan Pemandian Alam Perumahan Bumi Asri Barombong Blok C Nomor 2, Kec. Tamalate, Makassar</td>
            <th colspan="3" style="text-align: right;">No. Faktur:</th>
            <td style="text-align: center;">{{$pbks->no_faktur}}</td>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right;">Jatuh Tempo:</th>
            <td style="text-align: center;">{{$pbks->order_kredit_disetujui->dl_bayar}}</td>
        </tr>
        <tr>
            <th>Tgl. Kirim:</th>
            <td colspan="2" style="text-align: left;">{{$pbks->tgl_kirim}}</td>
            <th colspan="2" style="text-align: right;">Token:</th>
            <td style="text-align: center;">{{$pbks->order_kredit_disetujui->token}}</td>
        </tr>
        <tr>
            <th>Ekspedisi:</th>
            <td colspan="3" style="text-align: left;">{{$pbks->ekspedisi->nama_ekspedisi}}</td>
            <th style="text-align: right;">No. Order:</th>
            <td style="text-align: center;">{{$pbks->order_kredit_disetujui->master_order_k->no_order}}</td>
        </tr>
        <tr>
            <th>Resi Pengiriman:</th>
            <td colspan="3" style="text-align: left;">{{$pbks->resi_pengiriman}}</td>
            <th style="text-align: right;">Kepada:</th>
            <td style="text-align: center;">{{$pbks->order_kredit_disetujui->master_order_k->user->name}}</td>
        </tr>
</table>
<br>
<table class="table" border="1" style="width:100%">
    <thead>
        <tr>
            <th>Unit</th>
            <th>Nama Barang</th>
            <th>Harga/Unit</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
            $jumlah = 0;
        @endphp
        @foreach($pbks->order_kredit_disetujui->Master_order_k->detail as $key => $pbk)
          <tr>
            <td style="text-align: center;">{{$pbk->qty}}</td>
            <td style="text-align: center;">{{$pbk->product->name}}</td>
            <td style="text-align: center;">{{$pbk->harga}}</td>
            <td style="text-align: center;">{{$pbk->qty * $pbk->harga}}</td>
          </tr>
          @php
            $jumlah += ($pbk->qty * $pbk->harga);
          @endphp
        @endforeach
    </tbody>
</table>
<br>
<table class="table" rules="none" style="width:45%">
    <tr>
        <td>Alamat Penerimaan Barang:</td>
    </tr>
    <tr>
        <td>{{$pbks->order_kredit_disetujui->master_order_k->alamat_terima}}</td>
    </tr>
</table>
<br>
<table class="table" rules="none" style="width:100%">
    <tfoot>
        <tr>
              <td style="text-align: center;">Catatan !!!</td>
              <th>Subtotal:</th>
              <td style="text-align: center;">{{$jumlah}}</td>
        </tr>
        <tr>
              <td style="text-align: center;">Khusus Biaya Pengiriman, Dibayar</td>
              <th>Biaya Pengiriman:</th>
            <td style="text-align: center;">{{$pbks->ongkir}}</td>
        </tr>
        <tr>
            <td style="text-align: center;">Ketika Barang Diterima</td>
            <th>TOTAL:</th>
            <th>{{$jumlah + $pbks->ongkir}}</th>
        </tr>
    </tfoot>
</table>
</center>
</div>
</html>
