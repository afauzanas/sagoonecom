@extends('template.admin')

@section('title')
    Menu PBK
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
  <form class="mb-6" action="{{ route('pbk.store') }}" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Orderan yang Telah Dikirim</h1>
    <br>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="order_kredit_disetujui_id">ID OKD</label>
        <input name="order_kredit_disetujui_id" id="order_kredit_disetujui_id" value="{{$okds->id}}" class="form-control" readonly>
      </div>
      <div class="form-group col-md-1"></div>
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
  <a class="btn btn-dark" href="{{ route('okd.index') }}">Batalkan</a>
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
              <td>{{$detail->master_order_k->no_order}}</td>
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