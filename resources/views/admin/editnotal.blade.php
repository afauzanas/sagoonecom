@extends('template.admin')

@section('title')
    Edit Nota Luring
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="{{ route('notaluring.edit', $masternotals->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$masternotals->no_nota_luring}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Tambah Data Nota Luring</h1>
    <div class="form-group">
        <label for="no_nota_luring">Nomor Nota Luring</label>
        <input value="{{$masternotals->no_nota_luring}}" type="text" name="no_nota_luring" id="no_nota_luring" placeholder="Masukkan Nomor Nota Luring" class="form-control" readonly>
    </div>
    <div class="form-group">
      <label for="ket">Keterangan</label>
      <input value="{{$masternotals->ket}}" name="ket" class="form-control" id="ket" rows="3" placeholder="Masukkan Keterangan">
    </div>
    <h3 class="text-center mb-6">Detail</h3>
      <!-- <input value="{{$masternotals->id}}" type="hidden" name="master_nota_luring_id" id="master_nota_luring_id" class="form-control" readonly> -->
    <center>
    <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Nota Luring</th>
            <th>Produk/Barang</th>
            <th>Unit</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
        @foreach($detailnotals as $detailnotal)
          <tr>
            <td>{{ $no++ }}</td>
            <td><input type="text" name="no_nota_luring[]" value="{{$detailnotal->Master_nota_luring->no_nota_luring}}" 
              class="form-control" id="no_nota_luring" disabled></td>
            <td><select name="data_detail[{{$detailnotal->id}}][product_id]" id="product_id" class="form-control">
                @foreach ($products as $product)
                  <option value="{{$product->id}}" {{$product->id == $detailnotal->product->id ? 'selected': ''}}>{{$product->name}}</option>
                @endforeach
                </select>
            <td><input type="number" name="data_detail[{{$detailnotal->id}}][unit]" value="{{$detailnotal->unit}}"
              class="form-control" id="unit">
              <input type="hidden" name="data_detail[{{$detailnotal->id}}][id]" value="{{$detailnotal->id}}">
            </td>
            <td><input type="number" name="data_detail[{{$detailnotal->id}}][harga]" value="{{$detailnotal->harga}}"
              class="form-control" id="harga">
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
    </center>
    <br><br>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/menunotaluring">Batalkan</a>
</div>
@endsection

@section('script')

@endsection