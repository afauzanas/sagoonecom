@extends('template.admin')

@section('title')
    Menu PBT
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
<h1>Daftar Orderan Tunai yang Telah Dikirim</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor E-Nota</th>
            <th>Tanggal E-Nota</th>
            <th>Nomor Order</th>
            <th>Tanggal Kirim</th>
            <th>Ongkir</th>
            <th>Estimasi Sampai</th>
            <th>Ekspedisi</th>
            <th>Nomor Resi</th>
            <th>Admin</th>
            <th>Action</th>
            <th>Ket</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($pbts as $pbt)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$pbt->no_enota}}</td>
            <td>{{$pbt->created_at}}</td>
            <td>{{$pbt->Master_order_t->no_order}}</td>
            <td>{{$pbt->tgl_kirim}}</td>
            <td>{{$pbt->ongkir}}</td>
            <td>{{$pbt->estimasi_sampai}}</td>
            <td>{{$pbt->ekspedisi->nama_ekspedisi}}</td>
            <td>{{$pbt->resi_pengiriman}}</td>
            <td>{{$pbt->user->name}}</td>
            <td>
            <a href="{{ route('pbt.show', $pbt->id) }}" class="btn btn-success">Lihat</a>
            <a href="{{ route('pbt.edit', $pbt->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('pbt.destroy', $pbt->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
            <td>@if($pbt->Konfir_terima_barang_t->id > 0) {{'Diterima'}} @else {{'BD'}} @endif</td>
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