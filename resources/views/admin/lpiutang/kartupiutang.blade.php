@extends('template.admin')

@section('title')
    Laporan Piutang
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap4.min.css')}}">
<style>
th {
        text-align: center !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
    @endif
    @php
       $jumlah = 0;
       $index = 0; 
       $lunas = 0;
       $nol = 0;
       $saldo = 0;
       $jumlahbantuan = 0;
       $lunasbantuan = 0;
       $jumlahbantuan1 = 0;
       $lunasbantuan1 = 0;
       $tfoottambah = 0;
       $tfootkurang = 0;
       $tfootsaldo = 0;
    @endphp
    @php
       $total = 0;    
    @endphp

<h1>Kartu Piutang</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th colspan="6" style="text-align:right">Kode Pelanggan :</th>
            <th>{{$name->id}}</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:right">Nama Pelanggan :</th>
            <th>{{$name->name}}</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Nomor Faktur</th>
            <th>Jatuh Tempo</th>
            <th>Debit</th>
            <th>Tanggal Lunas</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($mks as $mk) @if($mk->Order_kredit_disetujui->Pengiriman_barang_k->id != 0)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$mk->Order_kredit_disetujui->Pengiriman_barang_k->no_faktur}}</td>
            <td>{{$mk->Order_kredit_disetujui->dl_bayar}}</td>
            @foreach($mk->detail as $d) 
                @php
                    $jumlah += ($d->harga * $d->qty);
                @endphp
            @endforeach
            <td>Rp{{number_format($jumlah)}}</td>
                @php
                    $jumlah = 0;
                @endphp
            <td>{{$mk->Order_kredit_disetujui->Pengiriman_barang_k->faktur_lunas->tgl_lunas}}</td>
            @foreach($mk->detail as $d)
                @php
                    $lunas += ($d->harga * $d->qty);
                @endphp
            @endforeach
            <td>@if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id != 0) Rp{{number_format($lunas)}} @else {{$nol}} @endif</td>
                @php
                    $lunas = 0;
                @endphp
            @foreach($mk->detail as $d) 
                @php
                    $jumlahbantuan += ($d->harga * $d->qty);
                @endphp
            @endforeach
            @foreach($mk->detail as $d)
                @php
                    $lunasbantuan += ($d->harga * $d->qty);
                @endphp
            @endforeach
            <td>@if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id != 0) Rp{{number_format($saldo + $jumlahbantuan - $lunasbantuan)}} @else
                Rp{{number_format($saldo + $jumlahbantuan)}} @endif</td>
                @php
                    $jumlahbantuan = 0;
                    $lunasbantuan =0;
                @endphp
            @foreach($mk->detail as $d) 
                @php
                    $jumlahbantuan1 += ($d->harga * $d->qty);
                    $lunasbantuan1 += ($d->harga * $d->qty);
                @endphp
            @endforeach
          </tr>
            <!-- @php
                $total += ($d->harga * $d->qty);
            @endphp -->
            @if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id !=0) @php $saldo = $saldo + $jumlahbantuan1 - $lunasbantuan1; @endphp @endif
            @if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id == 0) @php $saldo = $saldo + $jumlahbantuan1; @endphp @endif
                @php
                    $jumlahbantuan1 = 0;
                    $lunasbantuan1 =0;
                @endphp
            @foreach($mk->detail as $d) 
                @php
                    $tfoottambah += ($d->harga * $d->qty);
                    $tfootkurang += ($d->harga * $d->qty);
                @endphp
            @endforeach
            @if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id !=0) @php $tfootsaldo = $tfootsaldo + $tfoottambah - $tfootkurang; @endphp @endif
            @if($mk->Order_kredit_disetujui->Pengiriman_barang_k->Faktur_lunas->id == 0) @php $tfootsaldo = $tfootsaldo + $tfoottambah; @endphp @endif
                @php
                    $tfoottambah = 0;
                    $tfootkurang = 0;
                @endphp
        @endif
        @endforeach
    </tbody>
    </tfoot>
        <tr>
            <th colspan="6" style="text-align:right">Saldo Piutang - {{$name->name}} :</th>
            <th>Rp{{number_format($tfootsaldo)}}</th>
        </tr>
    </tfoot>
</table>
<a class="btn btn-dark" href="/lappiutang">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection