@extends('template.admin')

@section('title')
    Laporan Penjualan
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
    @endphp
    @php
       $total = 0;    
    @endphp

<h1>Laporan Penjualan Kredit berdasarkan Pelanggan</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pelanggan</th>
            <th>Nomor Bukti</th>
            <th>Tanggal Bukti</th>
            <th>Jumlah Harga</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($pbks as $pbk)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$pbk->Order_kredit_disetujui->Master_order_k->user->name}}</td>
            <td>{{$pbk->no_faktur}}</td>
            <td>{{$pbk->created_at}}</td>
            <td>
                @foreach($pbk->Order_kredit_disetujui->Master_order_k->detail as $d)
                <li>Rp{{number_format($d->harga * $d->qty)}}</li>
                @php
                    $total += ($d->harga * $d->qty);
                 @endphp
                @endforeach
            </td>
          </tr>
            
        @endforeach
    </tbody>
    <tr>
        <th colspan="4">Total :</th>
        <th>Rp{{number_format($total)}}</th>
    </tr>
</table>
<a class="btn btn-dark" href="/lappenjualan">Kembali</a>
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