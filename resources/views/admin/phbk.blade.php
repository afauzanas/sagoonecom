@extends('template.admin')

@section('title')
    Menu PHBK
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap4.min.css')}}">
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
<h1>Permintaan Hak Beli Kredit</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Minta Kredit</th>
            <th>Tanggal Permintaan</th>
            <th>Pelanggan</th>
            <th>Action</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($phbks as $phbk)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$phbk->no_minta_kredit}}</td>
            <td>{{$phbk->created_at}}</td>
            <td>{{$phbk->user->name}}</td>
            <td>
            <a href="{{ route('phbk.show', $phbk->id) }}" class="btn btn-primary">Setujui</a>
                <form action="{{ route('phbk.destroy', $phbk->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            <td>@if($phbk->Hb_kredit_disetujui->id > 0) {{'SD'}} @else {{'BD'}} @endif</td>
          </tr>
        @endforeach
    </tbody>
</table>
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