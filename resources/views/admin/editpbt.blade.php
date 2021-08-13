@extends('template.admin')

@section('title')
    Menu PBT
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
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
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  <form class="mb-6" action="{{ route('pbt.update', $pbt->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$pbt->no_enota}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Data Pengiriman Barang Tunai</h1><br>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_enota">Nomor E-Nota</label>
        <input value="{{$pbt->no_enota}}" type="text" name="no_enota" id="no_enota" class="form-control" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="tgl_kirim">Tanggal Kirim</label>
        <input value="{{$pbt->tgl_kirim}}" type="date" name="tgl_kirim" class="form-control" id="tgl_kirim">
      </div>
      <div class="form-group col-md-4">
        <label for="ongkir">Ongkir</label>
        <input value="{{$pbt->ongkir}}" type="number" name="ongkir" class="form-control" id="ongkir">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="estimasi_sampai">Estimasi Sampai</label>
        <input value="{{$pbt->estimasi_sampai}}" type="date" name="estimasi_sampai" id="estimasi_sampai" class="form-control">
      </div>
      <div class="form-group col-md-3">
        <label for="ekspedisi_id">Nama Ekspedisi</label>
        <select name="ekspedisi_id" id="ekspedisi_id" class="form-control">
            @foreach ($ekspedisis as $ekspedisi)
             <option value="{{$ekspedisi->id}}" {{$ekspedisi->id == $pbt->ekspedisi->id ? 'selected': ''}}>{{$ekspedisi->nama_ekspedisi}}</option>
             @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="resi_pengiriman">Resi Pengiriman</label>
        <input value="{{$pbt->resi_pengiriman}}" type="text" name="resi_pengiriman" id="resi_pengiriman" class="form-control">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/pbt">Batalkan</a>
<br><br>
<h3>Detail Order Tunai</h3>
      <table class="table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Nomor Order Tunai</th>
                  <th>Produk/Barang</th>
                  <th>Unit</th>
                  <th>Harga</th>
              </tr>
          </thead>
          <tbody>
          @php $no = 1; @endphp
              @foreach($detailorderts as $detailordert)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{$detailordert->master_order_t->no_order}}</td>
                  <td>{{$detailordert->product->name}}</td>
                  <td>{{$detailordert->qty}}</td>
                  <td>{{$detailordert->harga}}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
</div>
@endsection

@section('script')

@endsection