@extends('template.admin')

@section('title')
    Menu HBKD
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
<h1>Hak Beli Kredit Disetujui</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Kredit Disetujui</th>
            <th>Nomor Minta Kredit</th>
            <th>Tanggal Disetujui</th>
            <th>Pelanggan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($hbkds as $hbkd)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$hbkd->no_kredit_disetujui}}</td>
            <td>{{$hbkd->Permintaan_hb_kredit->no_minta_kredit}}</td>
            <td>{{$hbkd->created_at}}</td>
            <td>{{$hbkd->Permintaan_hb_kredit->user->name}}</td>
            <td>
                <form action="{{ route('hbkd.destroy', $hbkd->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
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