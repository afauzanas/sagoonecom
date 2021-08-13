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
            <td style="text-align: center;">{{$pbts->created_at}}</td>
        </tr>
        <tr>
            <td style="text-align: center;">Jalan Pemandian Alam Perumahan Bumi Asri Barombong Blok C Nomor 2, Kec. Tamalate, Makassar</td>
            <th colspan="3" style="text-align: right;">No. E-Nota:</th>
            <td style="text-align: center;">{{$pbts->no_enota}}</td>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right;">No. Order:</th>
            <td style="text-align: center;">{{$pbts->master_order_t->no_order}}</td>
        </tr>
        <tr>
            <th>Tgl. Kirim:</th>
            <td colspan="3" style="text-align: left;">{{$pbts->tgl_kirim}}</td>
            <th style="text-align: right;">Kepada:</th>
            <td style="text-align: center;">{{$pbts->master_order_t->user->name}}</td>
        </tr>
        <tr>
            <th>Ekspedisi:</th>
            <td colspan="3" style="text-align: left;">{{$pbts->ekspedisi->nama_ekspedisi}}</td>
        </tr>
        <tr>
            <th>Resi Pengiriman:</th>
            <td colspan="3" style="text-align: left;">{{$pbts->resi_pengiriman}}</td>
        </tr>
    </thead>
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
        @foreach($pbts->Master_order_t->detail as $key => $pbt)
          <tr>
            <td style="text-align: center;">{{$pbt->qty}}</td>
            <td style="text-align: center;">{{$pbt->product->name}}</td>
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
<table class="table" rules="none" style="width:45%">
    <tr>
        <td>Alamat Penerimaan Barang:</td>
    </tr>
    <tr>
        <td>{{$pbts->master_order_t->alamat_terima}}</td>
    </tr>
</table>
<br>
<table class="table" rules="none" style="width:100%">
    <tfoot>
        <tr>
              <td style="text-align: center;">Perhatiaan !!!</td>
              <th>Subtotal:</th>
              <td style="text-align: center;">{{$jumlah}}</td>
        </tr>
        <tr>
              <td style="text-align: center;">Biaya Pengiriman Dibayar</td>
              <th>Biaya Pengiriman:</th>
                <td style="text-align: center;">{{$pbts->ongkir}}</td>
        </tr>
        <tr>
            <td style="text-align: center;">secara COD</td>
            <th>TOTAL:</th>
            <th>{{$jumlah + $pbts->ongkir}}</th>
        </tr>
    </tfoot>
</table>
</center>
</div>
</html>
