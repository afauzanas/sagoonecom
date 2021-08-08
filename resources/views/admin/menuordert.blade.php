@extends('template.admin')

@section('title')
    Menu Order Tunai
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
<h1>Master Order Tunai</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Tunai</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th>Alamat Penerimaan</th>
            <th>Metode Bayar</th>
            <th>Token</th>
            <th width="18%">Action</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($masterorderts as $masterordert)
        
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$masterordert->no_order}}</td>
            <td>{{$masterordert->user->name}}</td>
            <td>{{$masterordert->created_at}}</td>
            <td>{{$masterordert->alamat_terima}}</td>
            <td>{{$masterordert->metode_bayar->kode_metode}}</td>
            <td>{{$masterordert->token}}</td>
            <td>
            <a href="{{route('menuordert.edit', $masterordert->id) }}" class="btn btn-info d-inline">detail</a>
            <a href="{{ route('menuordert.show', $masterordert->id) }}" class="btn btn-success d-inline">Kirim</a>
            </td>
            <td>@if($masterordert->Pengiriman_barang_t->id > 0) {{'SD'}} @else {{'BD'}} @endif</td>
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