@extends('template.user')

@section('title')
    Menu Konfir
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
  <form class="mb-6" action="{{ route('daftarpesanan.storekredit') }}" method="POST">
    @csrf
    <h1 class="text-center mb-6">Konfirmasi Barang Telah Diterima</h1>
    <input type="hidden" name="pengiriman_barang_k_id" id="pengiriman_barang_k_id" value="{{$pbks->Order_kredit_disetujui->Pengiriman_barang_k->id}}" class="form-control" readonly>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_order">Nomor Order</label>
        <input name="no_order" id="no_order" value="{{$pbks->no_order}}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="tgl_terima">Tanggal Terima</label>
        <input type="date" name="tgl_terima" class="form-control" id="tgl_terima">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="{{ route('daftarpesanan.kredit') }}">Batalkan</a>
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
          @foreach($details as $detail)
            <tr>
              <td></td>
              <td>{{$detail->Master_order_k->no_order}}</td>
              <td>{{$detail->product->name}}</td>
              <td>{{$detail->qty}}</td>
              <td>{{$detail->harga}}</td>
            </tr>
          @endforeach
      </tbody>
  </table>
</div>


@endsection

@section('script')

@endsection