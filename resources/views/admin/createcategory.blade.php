@extends('template.admin')

@section('title')
    Referensi Kategori
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
  <form class="mb-6" action="/category/store" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Kategori Barang/Produk</h1>
      <div class="form-group col-md-6">
        <label for="category">Nama</label>
        <input type="text" name="category" id="category" class="form-control">
      </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN</button>
  </form> <br>
  <a class="btn btn-dark" href="/category">Batalkan</a>
</div>
@endsection

@section('script')

@endsection