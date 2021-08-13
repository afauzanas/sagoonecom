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
<h1>Daftar Pesanan Kredit</h1> 
<h6>{{$name->user->name}} - (Kode Pelanggan: {{$name->user_id}})</h6>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Kredit</th>
            <th>Tanggal Order</th>
            <th>Alamat Penerimaan</th>
            <th>Metode Bayar</th>
            <th>Status Order</th>
            <th>Status Pengiriman</th>
            <th>Action</th>
            <th>Status Konfirmasi</th>
            <th>Faktur</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($dpks as $dpk)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$dpk->no_order}}</td>
            <td>{{$dpk->created_at}}</td>
            <td>{{$dpk->alamat_terima}}</td>
            <td>{{$dpk->metode_bayar->kode_metode}}</td>
            <td>@if($dpk->Order_kredit_disetujui->id != 0) {{'Disetujui'}} @else {{'Blm Disetujui'}} @endif</td>
            <td>@if($dpk->Order_kredit_disetujui->Pengiriman_barang_k->id > 0) {{'Sudah Dikirim'}} @else {{'Blm Dikirim'}} @endif</td>
            <td>@if($dpk->Order_kredit_disetujui->Pengiriman_barang_k->id != 0 && $dpk->Order_kredit_disetujui->Pengiriman_barang_k->Konfir_terima_barang_k->id == 0)
                <a href="{{ route('daftarpesanan.createkredit', $dpk->id) }}" class="btn btn-success">Konfir Terima</a>
                @elseif($dpk->Order_kredit_disetujui->id == 0)
                    <form action="{{ route('dp.destroykredit', $dpk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan {{$dpk->no_order}} ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Batalkan</button>
                    </form> @endif
            </td>
            <td>@if($dpk->Order_kredit_disetujui->Pengiriman_barang_k->Konfir_terima_barang_k->id > 0) {{'Sudah Diterima'}} @else {{'Blm Diterima'}} @endif</td>
            <td>@if($dpk->Order_kredit_disetujui->Pengiriman_barang_k->id != 0)
                <a href="{{ route('daftarpesanan.showkredit', $dpk->id) }}" class="btn btn-success">Lihat</a>@endif
            </td>
            <td>@if($dpk->Order_kredit_disetujui->Pengiriman_barang_k->faktur_lunas->id != 0) {{'LUNAS'}} @else {{'BLM LUNAS'}} @endif</td>
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