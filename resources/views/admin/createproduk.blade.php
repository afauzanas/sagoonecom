@extends('template.admin')

@section('title')
    Menu Produk
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="images/{{ Session::get('image') }}">
        @endif
    
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
  <form class="mb-6" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="text-center mb-6">Tambah Jenis Barang</h1>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="inputcategory_id">Kategori</label>
        <select name="category_id" id="inputcategory_id" class="form-control">
          @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="product_name">Nama Barang/Produk</label>
        <input type="text" name="name" class="form-control" id="product_name" placeholder="Masukkan Nama Barang/Produk">
      </div>
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan Nominal Tanpa Memakai Rp">
    </div>
    <div class="form-group">
      <label for="desc">Deskripsi</label>
      <textarea name="desc" class="form-control" id="desc" rows="3" placeholder="Masukkan Keterangan Barang/Produk"></textarea>
    </div>
      <div class="form-group col-md-6">
        <label for="image">Gambar</label>
        <input type="file" name="image" class="form-control-file" id="image">
      </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/products">Batalkan</a>
</div>
@endsection

@section('script')

@endsection