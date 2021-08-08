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
        $saldo = 0;
    @endphp

<h1>Ketersediaan Barang/Produk</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th colspan="5" style="text-align:right">Kode Barang/Produk :</th>
            <th>{{$kepala->name}}</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align:right">Nama barang/Produk :</th>
            <th>{{$kepala->id}}</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Mutasi/Bukti Transaksi</th>
            <th>Tanggal</th>
            <th>Unit Masuk</th>
            <th>Unit Keluar</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($barang as $kp)
            @php
                $saldo = $saldo + $kp['unit_masuk'] - $kp['unit_keluar'];
            @endphp
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$kp['identitas']}}</td>
            <td>{{$kp['tgl']}}</td>
            <td>{{$kp['unit_masuk']}}</td>
            <td>{{$kp['unit_keluar']}}</td>
            <td>{{$saldo}}</td>
          </tr>
        @endforeach
    </tbody>
    </tfoot>
        <tr>
            <th colspan="5" style="text-align:right">Saldo Ketersediaan Barang/Produk - :</th>
            <th>{{$saldo}}</th>
        </tr>
    </tfoot>
</table>
<a class="btn btn-dark" href="/lappersediaan">Kembali</a>
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