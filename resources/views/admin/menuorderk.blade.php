@extends('template.admin')

@section('title')
    Menu Order Kredit
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
<h1>Master Order Kredit</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Kredit</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th width="18%">Action</th>
            <th>Status</th>
            <th>Pembayaran</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($masterorderks as $masterorderk)
        
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$masterorderk->no_order}}</td>
            <td>{{$masterorderk->user_id}}</td>
            <td>{{$masterorderk->created_at}}</td>
            <td>
            <a href="/menuorderk/detail/{{$masterorderk->id}}" class="btn btn-info d-inline">detail</a>
            <a href="/menuorderk/show/{{$masterorderk->id}}" class="btn btn-success d-inline">Setujui</a>
            </td>
            <td>@if($masterorderk->Order_kredit_disetujui->id > 0) {{'SD'}} @else {{'BD'}} @endif</td>
            <td>@if($masterorderk->Order_kredit_disetujui->Pengiriman_barang_k->faktur_lunas->id !=0)
                    {{'Lunas'}} @else {{'Belum Lunas'}} @endif
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
<h6><b>Keterangan:</b></h6>
<h6>SD = Sudah Disetujui</h6>
<h6>BD = Belum Disetujui</h6>
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