@extends('template.admin')

@section('title')
    Menu Nota Luring
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
<h1>Master Nota Luring</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Nota Luring</th>
            <th>Tanggal Nota Luring</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($masternotals as $no=> $masternotal)
          <tr>
            <td>{{ ++$no + ($masternotals->currentPage()-1) * $masternotals->perPage() }}</td>
            <td>{{$masternotal->no_nota_luring}}</td>
            <td>{{$masternotal->created_at}}</td>
            <td>{{$masternotal->ket}}</td>
            <td>
            <a href="/menunotaluring/formedit/{{$masternotal->id}}" class="btn btn-success">Edit</a>
            <a href="{{ route('detailnotal', $masternotal->id) }}" class="btn btn-warning">Detail</a>
              <form action="{{ route('deletenotal', $masternotal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{$masternotal->no_nota_luring}} ?')">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{$masternotals->links()}}
<a type="button" class="btn btn-primary" href="/menunotaluring/formstore">Tambah Data</a>
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