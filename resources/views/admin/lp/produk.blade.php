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

<h1>Laporan Penjualan berdasarkan Produk/Barang</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Produk/Barang</th>
            <th>Kategori</th>
            <th>Harga/Unit</th>
            <th>Keterangan</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($products as $product)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->Category->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->desc}}</td>
            <td></td>
            <td>
            <a href="{{ route('lp.produkk', $product->id) }}" class="btn btn-secondary">Kredit</a>
            <a href="{{ route('lp.produkt', $product->id) }}" class="btn btn-success">Tunai</a>
            </td>
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