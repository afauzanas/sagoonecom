@extends('template.user')

@section('title')
    Daftar Pesanan
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

<!-- <nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Master Order Kredit</a>
  <form class="form-inline">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav> -->
<h1>Daftar Pesanan Tunai</h1>
<h6>{{$name->user->name}} - (Kode Pelanggan: {{$name->user_id}})</h6> 
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Tunai</th>
            <th>Tanggal Order</th>
            <th>Alamat Penerimaan</th>
            <th>Metode Bayar</th>
            <th>Status Pengiriman</th>
            <th>Nota</th>
            <th>Action</th>
            <th>Status Konfirmasi</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($dpts as $dpt)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$dpt->no_order}}</td>
            <td>{{$dpt->created_at}}</td>
            <td>{{$dpt->alamat_terima}}</td>
            <td>{{$dpt->metode_bayar->kode_metode}}</td>
            <td>@if($dpt->Pengiriman_barang_t->id > 0) {{'Sudah Dikirim'}} @else {{'Blm Dikirim'}} @endif</td>
            <td>@if($dpt->Pengiriman_barang_t->id != 0)
                <a href="{{ route('daftarpesanan.showtunai', $dpt->id) }}" class="btn btn-success">Lihat</a> @endif
            </td>
            <td>@if($dpt->Pengiriman_barang_t->id != 0 && $dpt->Pengiriman_barang_t->Konfir_terima_barang_t->id == 0)
                <a href="{{ route('daftarpesanan.createtunai', $dpt->id) }}" class="btn btn-success">Konfir Terima</a> @endif
            </td>
            <td>@if($dpt->Pengiriman_barang_t->Konfir_terima_barang_t->id > 0) {{'Sudah Diterima'}} @else {{'Blm Diterima'}} @endif</td>
          </tr>
        @endforeach
    </tbody>
</table>
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