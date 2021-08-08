@extends('template.admin')

@section('title')
    Menu Faktur Lunas
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
<style>
th {
        text-align: center !important;
    }
</style>
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
        @php
            $total = 0;    
        @endphp
  <form class="mb-6" action="{{ route('fl.store') }}" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Faktur Lunas</h1>
    <input type="hidden" name="pengiriman_barang_k_id" id="pengiriman_barang_k_id" value="{{$pbk->id}}" class="form-control" readonly>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_faktur">Faktur</label>
        <input name="no_faktur" id="no_faktur" value="{{$pbk->no_faktur}}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="no_order_disetujui">Nomor Order Disetujui</label>
        <input name="no_order_disetujui" id="no_order_disetujui" value="{{$pbk->order_kredit_disetujui->no_order_disetujui}}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="tgl_lunas">Tanggal Lunas</label>
        <input type="date" name="tgl_lunas" class="form-control" id=tgl_lunas">
      </div>
      <div class="form-group col-md-6">
        <label for="ket">Keterangan</label>
        <textarea name="ket" class="form-control" id="ket"></textarea>
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/pbk">Batalkan</a>
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
              <th>Jumlah Harga</th>
          </tr>
      </thead>
      <tbody>
          @foreach($details as $detail)
            <tr>
              <td></td>
              <td>{{$detail->master_order_k->no_order}}</td>
              <td>{{$detail->product->name}}</td>
              <td>{{$detail->qty}}</td>
              <td>{{$detail->harga}}</td>
              <td>Rp{{number_format($detail->harga * $detail->qty)}}<td>
            </tr>
            @php
              $total += ($detail->harga * $detail->qty);
            @endphp
          @endforeach
      </tbody>
      <tr>
        <th colspan="5">Total Pembayaran :</th>
        <th>Rp{{number_format($total)}}</th>
      </tr>
  </table>
</div>

@endsection

@section('script')

@endsection