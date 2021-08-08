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
        $saldo = 0;
        $bjt = 0;
        $jt1 = 0;
        $jt2 = 0;
        $jt3 = 0;
        $jt4 = 0;
        $jt5 = 0;
        $jt6 = 0;
        $pjt1 = 0.2;
        $pjt2 = 0.3;
        $pjt3 = 0.4;
        $pjt4 = 0.5;
        $pjt5 = 0.6;
        $pjt6 = 0.8;
    @endphp

<h1>Daftar Umur Piutang</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th rowspan="2">Pelanggan</th>
            <th rowspan="2">Saldo</th>
            <th rowspan="2">Belum Jatuh Tempo</th>
            <th colspan="6">Lewat Jatuh Tempo</th>
        </tr>
        <tr>
            <th>1 s.d. 30</th>
            <th>31 s.d. 60</th>
            <th>61 s.d. 90</th>
            <th>91 s.d. 180</th>
            <th>181 s.d. 365</th>
            <th>> 365</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ups as $up)
          <tr>
            <td>{{$up->pelanggan}}</td>
            <td>Rp{{number_format($up->saldo)}}</td>
            <td>Rp{{number_format($up->blm_jt)}}</td>
            <td>Rp{{number_format($up->jt1)}}</td>
            <td>Rp{{number_format($up->jt2)}}</td>
            <td>Rp{{number_format($up->jt3)}}</td>
            <td>Rp{{number_format($up->jt4)}}</td>
            <td>Rp{{number_format($up->jt5)}}</td>
            <td>Rp{{number_format($up->jt6)}}</td>
          </tr>
            @php
                $saldo += ($up->saldo);
                $bjt += ($up->blm_jt);
                $jt1 += ($up->jt1);
                $jt2 += ($up->jt2);
                $jt3 += ($up->jt3);
                $jt4 += ($up->jt4);
                $jt5 += ($up->jt5);
                $jt6 += ($up->jt6);
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <th>Rp{{number_format($saldo)}}</th>
            <th>Rp{{number_format($bjt)}}</th>
            <th>Rp{{number_format($jt1)}}</th>
            <th>Rp{{number_format($jt2)}}</th>
            <th>Rp{{number_format($jt3)}}</th>
            <th>Rp{{number_format($jt4)}}</th>
            <th>Rp{{number_format($jt5)}}</th>
            <th>Rp{{number_format($jt6)}}</th>
        </tr>
        <tr>
            <th colspan="3">Persentasi Tidak Tertagih</th>
            <th>20%</th>
            <th>30%</th>
            <th>40%</th>
            <th>50%</th>
            <th>60%</th>
            <th>80%</th>
        </tr>
        <tr>
            <th colspan="3">Estimasi Piutang Tidak Tertagih</th>
            <th>Rp{{number_format($jt1 * $pjt1)}}</th>
            <th>Rp{{number_format($jt2 * $pjt2)}}</th>
            <th>Rp{{number_format($jt3 * $pjt3)}}</th>
            <th>Rp{{number_format($jt4 * $pjt4)}}</th>
            <th>Rp{{number_format($jt5 * $pjt5)}}</th>
            <th>Rp{{number_format($jt6 * $pjt6)}}</th>
        </tr>
    </tfoot>
</table>
<a class="btn btn-dark" href="/admin">Dashboard</a>
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