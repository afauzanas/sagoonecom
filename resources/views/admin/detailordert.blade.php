@extends('template.admin')

@section('title')
    Menu Order Tunai
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container">
<h1>Detail Order Tunai</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Tunai</th>
            <th>Produk/Barang</th>
            <th>Unit</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($detailorderts as $detailordert)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$detailordert->Master_order_t->no_order}}</td>
            <td>{{$detailordert->product->name}}</td>
            <td>{{$detailordert->qty}}</td>
            <td>{{$detailordert->harga}}</td>
          </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-dark" href="{{ route('menuordert.index') }}">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection