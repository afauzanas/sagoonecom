@extends('template.admin')

@section('title')
    Menu Persediaan
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container">
<h1>Detail Persediaan Masuk</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Mutasi</th>
            <th>Produk/Barang</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($detailpersediaans as $detailpersediaan)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$detailpersediaan->master_persediaan->no_mutasi}}</td>
            <td>{{$detailpersediaan->product->name}}</td>
            <td>{{$detailpersediaan->unit_masuk}}</td>
          </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-dark" href="/menupersediaan">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection