@extends('template.admin')

@section('title')
    Laporan Piutang
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
    @php
        $awal = 0;
        $akhir = 0;
        $nol = 0;
        $saldo = 0;
        $awalsekali = 0;
    @endphp
    @php
       $total = 0;    
    @endphp

<h1>Tabel Tingkat Perputaran & Periode Pengumpulan Piutang</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Rata-Rata Piutang</th>
            <th>Penjualan Kredit</th>
            <th>Perputaran Piutang</th>
            <th>Rata-Rata Periode Pengumpulan Piutang (hari)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pbks as $pbk)
          <tr>
            <td>{{$pbk->tahun}}</td>
            <td>Rp{{number_format($awal)}}</td>
                @php
                    $akhir = $pbk->pk - $pbk->saldo_pelunasan + $awal;
                    $rrp = ($awal+$akhir)/2;
                @endphp
            <td>Rp{{number_format($akhir)}}</td>
                @php
                    $pk = 0;
                    $pk = $pbk->pk;
                    $x = 365/($pk/$rrp);
                @endphp
            <td>Rp{{number_format($rrp)}}</td>
            <td>Rp{{number_format($pk)}}</td>
            <td>{{number_format($pk/$rrp,2)}}</td>
            <td>{{number_format($x)}}</td>
                @php
                    $awal = $pbk->pk - $pbk->saldo_pelunasan + $awal;
                    $pk = 0;
                @endphp
          </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-dark" href="#">Daftar Umur Piutang</a>
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