@extends('template.admin')

@section('title')
    Menu PHBK
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

<!-- <nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Master Order Kredit</a>
  <form class="form-inline">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav> -->
<h1>Pembelian oleh Pemohon HBK</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order Tunai</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th>Jumlah Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checks as $check)
        
          <tr>
            <td></td>
            <td>{{$check->no_order}}</td>
            <td>{{$check->user->name}}</td>
            <td>{{$check->created_at}}</td>
            <td>
            @foreach($check->detail as $c)
            <li>Rp{{number_format($c->harga * $c->qty)}}</li>
            @endforeach
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
<div class="form-row">
    <div class="form-group col-md-2">
        <form action="{{ route('hbkd.store') }}" method="POST" onsubmit="return confirm('Yakin ingin menyetujui permintaan Hak Beli Kredit dari {{$phbks->user->name}} ?')">
            @csrf
            <input type="hidden" name="permintaan_hb_kredit_id" value="{{$phbks->id}}" id="permintaan_hb_kredit_id" readonly>
            <button type="submit" class="btn btn-primary">Setujui HBK</button>
        </form>
    </div>
    <div class="form-group col-md-1">
        <form action="{{ route('phbk.destroy', $phbks->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menolak permintaan Hak Beli Kredit {{$phbks->user->name}} ?')">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Tolak PHBK</button>
        </form>
    </div>
</div>
<a class="btn btn-dark" href="{{ route('phbk.index') }}">Batalkan</a>
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