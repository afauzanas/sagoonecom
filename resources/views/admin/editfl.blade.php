@extends('template.admin')

@section('title')
    Menu Faktur Lunas
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
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
  <form class="mb-6" action="{{ route('fl.update', $fls->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit Faktur Lunas</h1>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_faktur">Faktur</label>
        <input value="{{$fls->pengiriman_barang_k->no_faktur}}" type="text" name="no_faktur" id="no_faktur" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="tgl_lunas">Tanggal Lunas</label>
        <input value="{{$fls->tgl_lunas}}" type="date" name="tgl_lunas" class="form-control" id="tgl_lunas">
      </div>
      <div class="form-group col-md-12">
        <label for="ket">Keterangan</label>
        <input value="{{$fls->ket}}" type="text" name="ket" class="form-control" id="ket">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="{{ route('fl.index') }}">Batalkan</a>
</div>
@endsection

@section('script')

@endsection