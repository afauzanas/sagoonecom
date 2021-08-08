@extends('template.admin')

@section('title')
    Menu Ekspedisi
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="/products/edit/{{$products->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Barang/Produk</h1>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="category_id">Kategori</label>
        <select name="category_id" id="inputcategory_id" class="form-control">
          @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->id}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-1"></div>
      <div class="form-group col-md-6">
        <label for="nama_produk">Nama Barang/Produk</label>
        <input value="{{$products->name}}" type="text" name="name" class="form-control" id="nama_produk" placeholder="Masukkan Nama Barang/Produk">
      </div>
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input value="{{$products->price}}" name="price" class="form-control" id="price" placeholder="Masukkan Nominal Harga">
    </div>
    <div class="form-group">
      <label for="desc">Deskripsi Barang/Produk</label>
      <input value="{{$products->desc}}" name="desc" class="form-control" id="desc" placeholder="Masukkan Deskripsi">
    </div>
    <div class="form-group col-md-6">
        <label for="image">Gambar</label>
        <input type="file" name="image" class="form-control-file" id="image">
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/products">Batalkan</a>
</div>
@endsection

@section('script')

@endsection