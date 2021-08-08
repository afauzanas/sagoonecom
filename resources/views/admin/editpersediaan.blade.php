@extends('template.admin')

@section('title')
    Edit Persediaan Masuk
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="{{ route('menupersediaan.update', $masterpersediaans->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Persediaan Masuk</h1>
    <div class="form-group">
        <label for="no_mutasi">Nomor Mutasi</label>
        <input value="{{$masterpersediaans->no_mutasi}}" type="text" name="no_mutasi" id="no_mutasi" placeholder="Masukkan Nomor Mutasi" class="form-control" disabled>
    </div>
    <div class="form-group">
      <label for="tgl_masuk">Tanggal Masuk</label>
      <input value="{{$masterpersediaans->tgl_masuk}}" name="tgl_masuk" class="form-control" id="tgl_masuk" rows="3">
    </div>
    <h3 class="text-center mb-6">Detail Persediaan Masuk</h3>
    <!-- <input type="hidden" name="master_persediaan_id" value="{{$masterpersediaans->id}}" class="form-control"
      id="master_persediaan_id" readonly> -->
    <center>
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
        @foreach($detailpersediaans as $detailpersediaan)
          <tr>
            <td></td>
            <td><input type="text" name="no_mutasi[]" value="{{$detailpersediaan->master_persediaan->no_mutasi}}" 
              class="form-control" id="no_mutasi" disabled></td>
            <td><select name="data_detail[{{$detailpersediaan->id}}][product_id]" id="product_id" class="form-control">
                @foreach ($products as $product)
                  <option value="{{$product->id}}" {{$product->id == $detailpersediaan->product->id ? 'selected': ''}}>{{$product->name}}</option>
                @endforeach
                </select>
            <td><input type="number" name="data_detail[{{$detailpersediaan->id}}][unit_masuk]" value="{{$detailpersediaan->unit_masuk}}"
              class="form-control" id="unit_masuk">
              <input type="hidden" name="data_detail[{{$detailpersediaan->id}}][id]" value="{{$detailpersediaan->id}}">
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
    </center>
    <br><br>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/menupersediaan">Batalkan</a>
</div>
@endsection

@section('script')

@endsection