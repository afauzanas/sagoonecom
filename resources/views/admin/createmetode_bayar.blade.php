@extends('template.admin')

@section('title')
    Referensi Metode Pemabayaran
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
  <form class="mb-6" action="/metode_bayar/store" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Metode Pembayaran</h1>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="kode_metode">Kode Metode</label>
        <input type="text" name="kode_metode" id="kode_metode" class="form-control">
      </div>
      <div class="form-group col-md-1"></div>
      <div class="form-group col-md-6">
        <label for="metode_bayar">Metode Pembayaran</label>
        <input type="text" name="metode_bayar" class="form-control" id="metode_bayar" placeholder="Masukkan Metode Pembayaran">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/metode_bayar">Batalkan</a>
</div>
@endsection

@section('script')

@endsection