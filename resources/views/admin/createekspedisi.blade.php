@extends('template.admin')

@section('title')
    Menu Ekspedisi
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
  <form class="mb-6" action="/ekspedisi/store" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Ekspedisi</h1>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="kode_ekspedisi">Kode Ekspedisi</label>
        <input type="text" name="kode_ekspedisi" id="kode_ekspedisi" class="form-control">
      </div>
      <div class="form-group col-md-1"></div>
      <div class="form-group col-md-6">
        <label for="ekspedisi_name">Nama Ekspedisi</label>
        <input type="text" name="name" class="form-control" id="ekspedisi_name" placeholder="Masukkan Nama Ekspedisi">
      </div>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan Alamat Ekspedisi"></textarea>
    </div>
    <div class="form-group">
      <label for="no_tlp">Nomor Telepon</label>
      <input name="no_tlp" class="form-control" id="no_tlp" placeholder="Masukkan Nomor Telepon">
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/ekspedisi">Batalkan</a>
</div>
@endsection

@section('script')

@endsection