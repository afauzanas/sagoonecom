@extends('template.admin')

@section('title')
    Menu Produk
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
    @endif
<h1>Daftar Barang/Produk</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $no=> $product)
          <tr>
            <td>{{ ++$no + ($products->currentPage()-1) * $products->perPage() }}</td>
            <td>{{$product->category_id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->desc}}</td>
            <td>{{$product->image}}</td>
            <td>
            <a href="/products/formedit/{{$product->id}}" class="btn btn-success">Edit</a>
              <form action="/products/delete/{{$product->id}}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{$product->name}} ?')">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$products->links()}}
<a type="button" class="btn btn-primary" href="/products/formstore">Tambah Barang/Produk</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection