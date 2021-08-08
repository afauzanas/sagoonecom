@extends('template.admin')

@section('title')
    Menu Persediaan
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap4.min.css')}}">
<style>
th {
        text-align: center !important;
    }
</style>
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
<h1>Master Persediaan</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Mutasi</th>
            <th>Tanggal Masuk</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($mps as $no=> $mp)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$mp->no_mutasi}}</td>
            <td>{{$mp->tgl_masuk}}</td>
            <td>{{$mp->user->name}}</td>
            <td>
            <a href="{{ route('menupersediaan.edit', $mp->id)}}" class="btn btn-success">Edit</a>
            <a href="{{ route('menupersediaan.show', $mp->id) }}" class="btn btn-warning">Detail</a>
              <form action="{{ route('menupersediaan.destroy', $mp->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
<a type="button" class="btn btn-primary" href="{{ route('menupersediaan.create') }}">Tambah Data</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection