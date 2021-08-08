@extends('template.admin')

@section('title')
    Menu PBK
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
<h1>Daftar Orderan Kredit yang Telah Dikirim</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Faktur</th>
            <th>Tanggal Faktur</th>
            <th>Nomor OKD</th>
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
        @foreach($pbks as $pbk)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$pbk->no_faktur}}</td>
            <td>{{$pbk->created_at}}</td>
            <td>{{$pbk->order_kredit_disetujui->no_order_disetujui}}</td>
            <td>{{$pbk->tgl_kirim}}</td>
            <td>{{$pbk->ongkir}}</td>
            <td>{{$pbk->estimasi_sampai}}</td>
            <td>{{$pbk->ekspedisi->nama_ekspedisi}}</td>
            <td>{{$pbk->resi_pengiriman}}</td>
            <td>{{$pbk->user->name}}</td>
            <td>
            <a href="{{ route('pbk.lihatorderan', $pbk->id) }}" class="btn btn-success">Lihat</a>
            <a href="{{ route('pbk.edit', $pbk->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('pbk.delete', $pbk->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <form action="{{ route('pbk.sendfaktur', $pbk->id) }}" method="GET" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning">Kirim Faktur</button>
                </form>
            <a href="{{ route('pbk.show', $pbk->id) }}" class="btn btn-primary">Rekam Pelunasan</a>
            </td>
            <td>@if($pbk->faktur_lunas->id != 0) SL @else BL @endif</td>
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