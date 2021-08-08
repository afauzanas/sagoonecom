@extends('template.admin')

@section('title')
    Menu Referensi Ekspedisi
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
<h1>Daftar Ekspedisi</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Ekspedisi</th>
            <th>Nama Ekspedisi</th>
            <th>Alamat</th>
            <th>no_tlp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ekspedisis as $no=> $ekspedisi)
          <tr>
            <td>{{ ++$no + ($ekspedisis->currentPage()-1) * $ekspedisis->perPage() }}</td>
            <td>{{$ekspedisi->kode_ekspedisi}}</td>
            <td>{{$ekspedisi->nama_ekspedisi}}</td>
            <td>{{$ekspedisi->alamat}}</td>
            <td>{{$ekspedisi->no_tlp}}</td>
            <td>
            <a href="/ekspedisi/formedit/{{$ekspedisi->id}}" class="btn btn-success">Edit</a>
              <form action="/ekspedisi/delete/{{$ekspedisi->id}}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$ekspedisis->links()}}
<a type="button" class="btn btn-primary" href="/ekspedisi/formstore">Tambah Ekspedisi</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection