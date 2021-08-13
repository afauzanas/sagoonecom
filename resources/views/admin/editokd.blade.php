@extends('template.admin')

@section('title')
    Menu OKD
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
  <form class="mb-6" action="{{ route('okd.update', $okd->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengedit {{$okd->no_order_disetujui}} ?')">
    @csrf
    @method('PATCH')
    <h1 class="text-center mb-6">Edit OKD</h1>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="no_okd">No OKD</label>
        <input value="{{$okd->no_order_disetujui}}" type="text" name="no_okd" id="no_okd" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="dl_bayar">Deadline Pembayaran</label>
        <input value="{{$okd->dl_bayar}}" type="text" name="dl_bayar" class="form-control" id="dl_bayar">
      </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-primary">EDIT</button>
  </form> <br>
  <a class="btn btn-dark" href="/okd">Batalkan</a>
</div>
@endsection

@section('script')

@endsection