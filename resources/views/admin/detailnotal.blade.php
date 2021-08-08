@extends('template.admin')

@section('title')
    Menu Nota Luring
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container">
<h1>Detail Nota Luring</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Nota Luring</th>
            <th>Produk/Barang</th>
            <th>Unit</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailnotals as $no=> $detailnotal)
          <tr>
            <td>{{ ++$no + ($detailnotals->currentPage()-1) * $detailnotals->perPage() }}</td>
            <td>{{$detailnotal->master_nota_luring->no_nota_luring}}</td>
            <td>{{$detailnotal->product->name}}</td>
            <td>{{$detailnotal->unit}}</td>
            <td>{{$detailnotal->harga}}</td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$detailnotals->links()}}
<a class="btn btn-dark" href="/menunotaluring">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection