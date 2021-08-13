@extends('template.admin')

@section('title')
    Menu OKD
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
<h1>Order Kredit Disetujui</h1>
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Order K Disetujui</th>
            <th>Nomor Order</th>
            <th>Admin</th>
            <th>Tanggal Persetujuan</th>
            <th>Token</th>
            <th>DL Bayar</th>
            <th>Action</th>
            <th>Ket</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($okds as $okd)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$okd->no_order_disetujui}}</td>
            <td>{{$okd->master_order_k->no_order}}</td>
            <td>{{$okd->user->name}}</td>
            <td>{{$okd->created_at}}</td>
            <td>{{$okd->token}}</td>
            <td>{{$okd->dl_bayar}}</td>
            <td>
            <a href="/okd/lihatorder/{{$okd->id}}" class="btn btn-success">Lihat Orderan</a>
            <a href="{{ route('okd.edit', $okd->id) }}" class="btn btn-secondary">Edit</a>
            <a href="{{ route('okd.show', $okd->id) }}" class="btn btn-primary">Kirim Orderan</a>
                <form action="{{ route('okd.delete', $okd->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{$okd->no_order_disetujui}} ?')">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
            <td>@if($okd->Pengiriman_barang_k->id > 0) {{'SD'}} @else {{'BD'}} @endif</td>
          </tr>
        @endforeach
    </tbody>
</table>
<h6><b>Keterangan:</b></h6>
<h6>SD = Sudah Dikirim</h6>
<h6>BD = Belum Dikirim</h6>
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