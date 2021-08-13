@extends('template.admin')

@section('title')
    Menu Order Kredit
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container">
<h1>Detail Order Kredit</h1>
<h5>{{$name->master_order_k->user->name}} - (Kode Pelanggan: {{$name->master_order_k->user->id}})</h5>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Kredit</th>
            <th>Produk/Barang</th>
            <th>Unit</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailorderks as $no=> $detailorderk)
          <tr>
            <td>{{ ++$no + ($detailorderks->currentPage()-1) * $detailorderks->perPage() }}</td>
            <td>{{$detailorderk->master_order_k->no_order}}</td>
            <td>{{$detailorderk->product->name}}</td>
            <td>{{$detailorderk->qty}}</td>
            <td>{{$detailorderk->harga}}</td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$detailorderks->links()}}
<h6><b>Alamat Penerimaan:</b> {{$name->master_order_k->alamat_terima}}</h6>
<h6><b>Metode bayar:</b> {{$name->master_order_k->metode_bayar->metode_bayar}}</h6><br>
<a class="btn btn-dark" href="/menuorderk">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection