<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>E-Nota</title>
</head>
<body>
<div class="container">

<center>
<h3>E-Nota</h3>
<table class="table" rules="none" style="width:100%">
    <thead>
        <tr>
            <th rowspan="3"><img src="{{ public_path('images/Logo-Sagoonecom.png') }}" alt="nopic" height="100" width="100"></th>
            <th>CV Podomoro Makassar</th>
            <th colspan="3" style="text-align: right;">Tgl E-Nota:</th>
            <th>{{$pbts->created_at}}</th>
        </tr>
        <tr>
            <th>Barombong sjkahcuiab</th>
            <th colspan="3" style="text-align: right;">No. E-Nota:</th>
            <th>{{$pbts->no_enota}}</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right;">No. Order:</th>
            <th>{{$pbts->master_order_t->no_order}}</th>
        </tr>
        <tr>
            <th>Tgl. Kirim:</th>
            <th colspan="3" style="text-align: left;">{{$pbts->tgl_kirim}}</th>
            <th style="text-align: right;">Kepada:</th>
            <th>{{$pbts->master_order_t->user->name}}</th>
        </tr>
        <tr>
            <th>Ekspedisi:</th>
            <th colspan="3" style="text-align: left;">{{$pbts->ekspedisi->nama_ekspedisi}}</th>
        </tr>
        <tr>
            <th>Resi Pengiriman:</th>
            <th colspan="3" style="text-align: left;">{{$pbts->resi_pengiriman}}</th>
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
        @foreach($pbts->Master_order_t->detail as $key => $pbt)
          <tr>
            <td style="text-align: center;">{{$pbt->qty}}</td>
            <td colspan="3" style="text-align: center;">{{$pbt->product->name}}</td>
            <td style="text-align: center;">{{$pbt->harga}}</td>
            <td style="text-align: center;">{{$pbt->qty * $pbt->harga}}</td>
          </tr>
          @php
            $jumlah += ($pbt->qty * $pbt->harga);
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
              <th colspan="4">Biaya Pengiriman Dibayar</th>
              <th>Biaya Pengiriman:</th>
            <th>{{$pbts->ongkir}}</th>
        </tr>
        <tr>
            <th colspan="4">secara COD</th>
            <th>TOTAL:</th>
            <th>{{$jumlah + $pbts->ongkir}}</th>
        </tr>
    </tfoot>
</table>
</center>
</div>
</html>
