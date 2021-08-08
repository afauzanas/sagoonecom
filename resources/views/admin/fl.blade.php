@extends('template.admin')

@section('title')
    Menu Faktur Lunas
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

<h1>Faktur Lunas</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Faktur</th>
            <th>ID PBK</th>
            <th>Tanggal Lunas</th>
            <th>Keterangan</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($fls as $fl)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$fl->pengiriman_barang_k->no_faktur}}</td>
            <td>{{$fl->pengiriman_barang_k_id}}</td>
            <td>{{$fl->tgl_lunas}}</td>
            <td>{{$fl->ket}}</td>
            <td>{{$fl->user->name}}</td>
            <td>
            <a href="{{ route('fl.show', $fl->id) }}" class="btn btn-success">Lihat Orderan</a>
            <a href="{{ route('fl.edit', $fl->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('fl.destroy', $fl->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
<a type="button" class="btn btn-primary" href="#">Tambah Faktur Lunas</a>
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