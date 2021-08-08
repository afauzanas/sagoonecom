@extends('template.admin')

@section('title')
    Profile
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('css/home.css')}}">
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
  <!-- Success Message -->
  
<div class="row justify-content-center">
  <div class="col-md-4">
      <img class="img-profile" src="{{asset('/images/profile_picture.png')}}" alt="nopic">
  </div>
  <div class="offset-md-2 col-md-6">
      <div class="content">
        <!-- Data Admin -->
      <label for="">Name</label>
      <p>{{Auth::user()->name}}</p>
      <label for="">Email</label>
      <p>{{Auth::user()->email}}</p>
      <label for="">Kota/Kabupaten</label>
      <p>{{Auth::user()->kota_kab}}</p>
      <label for="">Address</label>
      <p>{{Auth::user()->address}}</p>
      <label for="">Phone</label>
      <p>{{Auth::user()->phone}}</p>
      </div>
      <br>
          <a href="/akun/formedit" class="btn btn-success">Edit</a>
          <a href="{{ route('change.password') }}" class="btn btn-success">Ganti Password</a>
      </div>
</div>
</div>
@endsection
