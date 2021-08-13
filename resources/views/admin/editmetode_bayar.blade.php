@extends('template.admin')

@section('title')
    Menu Metode Bayar
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="/metode_bayar/edit/{{$metode_bayars->id}}" method="POST" onsubmit="return confirm('Yakin ingin mengedit metode {{$metode_bayars->metode_bayar}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Metode Bayar</h1>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="kode_metode">Kode Metode Bayar</label>
        <input value="{{$metode_bayars->kode_metode}}" type="text" name="kode_metode" id="kode_metode" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="metode_bayar">Metode Bayar</label>
        <input value="{{$metode_bayars->metode_bayar}}" type="text" name="name" class="form-control" id="metode_bayar" placeholder="Masukkan Metode Bayar">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/metode_bayar">Batalkan</a>
</div>
@endsection

@section('script')

@endsection