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
  <form class="mb-6" action="{{ route('pbk.update', $pbk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$pbk->no_faktur}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Data Pengiriman Barang Kredit</h1><br>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_faktur">Nomor Faktur</label>
        <input value="{{$pbk->no_faktur}}" type="text" name="no_faktur" id="no_faktur" class="form-control" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="tgl_kirim">Tanggal Kirim</label>
        <input value="{{$pbk->tgl_kirim}}" type="date" name="tgl_kirim" class="form-control" id="tgl_kirim">
      </div>
      <div class="form-group col-md-4">
        <label for="ongkir">Ongkir</label>
        <input value="{{$pbk->ongkir}}" type="number" name="ongkir" class="form-control" id="ongkir">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="estimasi_sampai">Estimasi Sampai</label>
        <input value="{{$pbk->estimasi_sampai}}" type="date" name="estimasi_sampai" id="estimasi_sampai" class="form-control">
      </div>
      <div class="form-group col-md-3">
        <label for="ekspedisi_id">Nama Ekspedisi</label>
        <select name="ekspedisi_id" id="ekspedisi_id" class="form-control">
            @foreach ($ekspedisis as $ekspedisi)
             <option value="{{$ekspedisi->id}}" {{$ekspedisi->id == $pbk->ekspedisi->id ? 'selected': ''}}>{{$ekspedisi->nama_ekspedisi}}</option>
             @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="resi_pengiriman">Resi Pengiriman</label>
        <input value="{{$pbk->resi_pengiriman}}" type="text" name="resi_pengiriman" id="resi_pengiriman" class="form-control">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/pbk">Batalkan</a>
</div>
@endsection

@section('script')

@endsection