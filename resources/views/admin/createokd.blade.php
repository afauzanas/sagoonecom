@extends('template.admin')

@section('title')
    Menu OKD
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  <form class="mb-6" action="/okd/store" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah OKD</h1>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="master_order_k_id">ID MOK</label>
        <input name="master_order_k_id" id="master_order_k_id" value="{{$MOK->id}}" class="form-control" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="no_order">Nomor Order</label>
        <input name="no_order" id="no_order" value="{{$MOK->no_order}}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="dl_bayar">Deadline Pembayaran</label>
        <input type="date" name="dl_bayar" class="form-control" id="dl_bayar">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/menuorderk">Batalkan</a>
  <br><br><br>
  <h3 class="text-center mb-6">Detail Order Kredit</h3>
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
</div>
{{$detailorderks->links()}}

@endsection

@section('script')

@endsection