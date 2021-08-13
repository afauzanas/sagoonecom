@extends('template.admin')

@section('title')
    Referensi Metode Pembayaran
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
<h1>Referensi Metode Pembayaran</h1>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Metode</th>
            <th>Metode Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($metode_bayars as $no=> $metode_bayar)
          <tr>
            <td>{{ ++$no + ($metode_bayars->currentPage()-1) * $metode_bayars->perPage() }}</td>
            <td>{{$metode_bayar->kode_metode}}</td>
            <td>{{$metode_bayar->metode_bayar}}</td>
            <td>
            <a href="/metode_bayar/formedit/{{$metode_bayar->id}}" class="btn btn-success">Edit</a>
              <form action="/metode_bayar/delete/{{$metode_bayar->id}}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{$metode_bayar->metode_bayar}} ?')">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$metode_bayars->links()}}
<a type="button" class="btn btn-primary" href="/metode_bayar/formstore">Tambah Metode Pembayaran</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection