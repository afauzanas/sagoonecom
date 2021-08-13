@extends('template.admin')

@section('title')
    Menu Ekspedisi
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="/category/edit/{{$categories->id}}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$categories->name}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Tambah Kategori</h1>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nama_category">Nama Kategori</label>
        <input value="{{$categories->name}}" type="text" name="nama_category" id="nama_category" class="form-control">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT KATEGORI</button>
  </form> <br>
  <a class="btn btn-dark" href="/category">Batalkan</a>
</div>
@endsection

@section('script')

@endsection