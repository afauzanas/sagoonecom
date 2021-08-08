@extends('template.admin')

@section('title')
    Menu PBT
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
  <form class="mb-6" action="{{ route('pbt.store') }}" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Orderan yang Telah Dikirim</h1>
    <input type="hidden" name="master_order_t_id" id="master_order_t_id" value="{{$pbts->id}}" class="form-control" readonly>
    <br>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_order">Nomor Order</label>
        <input name="no_order" id="no_order" value="{{$pbts->no_order}}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="tgl_kirim">Tanggal Kirim</label>
        <input type="date" name="tgl_kirim" class="form-control" id="tgl_kirim">
      </div>
    </div>
    <div class="form-group">
        <label for="ongkir">Ongkir</label>
        <input type="number" name="ongkir" class="form-control" id="ongkir">
    </div>
    <div class="form-group">
        <label for="estimasi_sampai">Estimasi Sampai</label>
        <input type="date" name="estimasi_sampai" class="form-control" id="estimasi_sampai">
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="ekspedisi_id">Kode Ekspedisi</label>
        <select name="ekspedisi_id" id="ekspedisi_id" class="form-control">
            <option>Pilih Ekspedisi</option>
            @foreach ($ekspedisis as $ekspedisi)
             <option value="{{$ekspedisi->id}}">{{$ekspedisi->nama_ekspedisi}}</option>
             @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="resi_pengiriman">Resi Pengiriman</label>
        <input type="text" name="resi_pengiriman" class="form-control" id="resi_pengiriman" placeholder="Masukkan Resi Pengiriman dari Ekspedisi">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="{{ route('menuordert.index') }}">Batalkan</a>
  <br><br>
  <h3>Detail Order Tunai</h3>
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
              @foreach($detailorderts as $detailordert)
                <tr>
                  <td></td>
                  <td>{{$detailordert->master_order_t->no_order}}</td>
                  <td>{{$detailordert->product->name}}</td>
                  <td>{{$detailordert->qty}}</td>
                  <td>{{$detailordert->harga}}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
</div>
@endsection

@section('script')

@endsection