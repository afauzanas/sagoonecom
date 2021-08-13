@extends('template.admin')

@section('title')
    Menu Ekspedisi
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="{{ route('ekspedisi.edit', $ekspedisi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$ekspedisi->nama_ekspedisi}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Ekspedisi</h1>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="kode_ekspedisi">Kode Ekspedisi</label>
        <input value="{{$ekspedisi->kode_ekspedisi}}" type="text" name="kode_ekspedisi" id="kode_ekspedisi" class="form-control">
      </div>
      <div class="form-group col-md-1"></div>
      <div class="form-group col-md-6">
        <label for="ekspedisi_name">Nama Ekspedisi</label>
        <input value="{{$ekspedisi->nama_ekspedisi}}" type="text" name="name" class="form-control" id="ekspedisi_name" placeholder="Masukkan Nama Ekspedisi">
      </div>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input value="{{$ekspedisi->alamat}}" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Ekspedisi">
    </div>
    <div class="form-group">
      <label for="no_tlp">Nomor Telepon</label>
      <input value="{{$ekspedisi->no_tlp}}" name="no_tlp" class="form-control" id="no_tlp" placeholder="Masukkan Nomor Telepon">
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/ekspedisi">Batalkan</a>
</div>
@endsection

@section('script')

@endsection