@extends('template.admin')

@section('title')
    Menu Kategori
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
<h1>Referensi Kategori</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $no=> $category)
          <tr>
            <td>{{ ++$no + ($categories->currentPage()-1) * $categories->perPage() }}</td>
            <td>{{$category->name}}</td>
            <td>
            <a href="/category/formedit/{{$category->id}}" class="btn btn-success">Edit</a>
              <form action="/category/delete/{{$category->id}}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$categories->links()}}
<a type="button" class="btn btn-primary" href="/category/formstore">Tambah Kategori</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection