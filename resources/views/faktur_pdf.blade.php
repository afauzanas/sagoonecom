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
            <th>{{$pbks->created_at}}</th>
        </tr>
        <tr>
            <th>Barombong sjkahcuiab</th>
            <th colspan="3" style="text-align: right;">No. Faktur:</th>
            <th>{{$pbks->no_faktur}}</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right;">No. Order:</th>
            <th>{{$pbks->order_kredit_disetujui->master_order_k->no_order}}</th>
        </tr>
        <tr>
            <th>Tgl. Kirim:</th>
            <th colspan="3" style="text-align: left;">{{$pbks->tgl_kirim}}</th>
            <th style="text-align: right;">Kepada:</th>
            <th>{{$pbks->order_kredit_disetujui->master_order_k->user->name}}</th>
        </tr>
        <tr>
            <th>Ekspedisi:</th>
            <th colspan="3" style="text-align: left;">{{$pbks->ekspedisi->nama_ekspedisi}}</th>
        </tr>
        <tr>
            <th>Resi Pengiriman:</th>
            <th colspan="3" style="text-align: left;">{{$pbks->resi_pengiriman}}</th>
        </tr>
</table>
<br>
<table class="table" border="1" style="width:100%">
    <thead>
        <tr>
            <th>Unit</th>
            <th colspan="3">Nama Barang</th>
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
            <td colspan="3" style="text-align: center;">{{$pbk->product->name}}</td>
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
<table class="table" rules="none" style="width:100%">
    <tfoot>
        <tr>
              <th colspan="4">Perhatiaan !!!</th>
              <th>Subtotal:</th>
              <th>{{$jumlah}}</th>
        </tr>
        <tr>
              <th colspan="4">Khusus Biaya Pengiriman, Dibayar</th>
              <th>Biaya Pengiriman:</th>
            <th>{{$pbks->ongkir}}</th>
        </tr>
        <tr>
            <th colspan="4">Ketika Barang Diterima</th>
            <th>TOTAL:</th>
            <th>{{$jumlah + $pbks->ongkir}}</th>
        </tr>
    </tfoot>
</table>
</center>
</div>
</html>
