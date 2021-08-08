@extends('template.admin')

@section('title')
    Laporan Penjualan
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
       $jumlah = 0;
       $index = 0;    
    @endphp
    @php
       $total = 0;    
    @endphp

<h1>Laporan Penjualan Tunai berdasarkan Produk/Barang</h1>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Produk/Barang</th>
            <th>Nomor Bukti</th>
            <th>Tanggal Bukti</th>
            <th>Jumlah Harga</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($details as $detail)
            @if($detail->Master_order_t->Pengiriman_barang_t->id !=0)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$detail->product->name}}</td>
            <td>{{$detail->Master_order_t->Pengiriman_barang_t->no_enota}}</td>
            <td>{{$detail->Master_order_t->Pengiriman_barang_t->created_at}}</td>
            <td>Rp{{number_format($detail->harga * $detail->qty)}}</td>
          </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4" style="text-align:right">Total :</th>
        <th></th>
    </tr>
    </tfoot>
</table>
<a class="btn btn-dark" href="/lappenjualan/produk">Kembali</a>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'Rp'+pageTotal +' ( Rp'+ total +' total)'
            );
        }
    } );
} );
</script>
@endsection