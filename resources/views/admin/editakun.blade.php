<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Data Akun</title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
  </head>
  <body>
    <div class="container">
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
      <div class="login-wrapper">
        <h1 class="title">Edit Data Akun</h1>
        <hr>
        <form method="POST" action="/akun/editakunadmin/{{$akuns->id}}" class="login-form">
            @csrf
            @method('PATCH')
          <input type="text" class="input" value="{{$akuns->name}}" name="name" value="{{ old('name') }}" required autofocus>

          @error('name')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <input type="email" class="input" value="{{$akuns->email}}"  name="email" value="{{ old('email') }}" required>

          @error('email')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror

           <input type="text" class="input" value="{{$akuns->kota_kab}}"  name="kota_kab" required>

          @error('kota_kab')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
          @enderror

          <input type="text" class="input" name="address" value="{{$akuns->address}}" required>

          @error('address')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror


          <input type="text" class="input" value="{{$akuns->phone}}"  name="phone" required>

          @error('phone')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <label for="password" class="cold-md-4 col-form-label text-md-right">{{__('Role') }}</label>
          <div class="col-md-6">
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
            <option value="admin_owner">Owner</option>
              <option value="admin_penjualan">Bagian Penjualan</option>
              <option value="admin_bendahara">Bendahara</option>
              <option value="admin_gp">Gudang & Pengiriman</option>
            </select>
          <!-- <input type="text" class="input" placeholder="Role"  name="role" required> -->

          @error('role')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror
          </div>  

          <button type="submit">EDIT DATA</button>
            @if(Auth::user()->role == 'admin_owner' OR Auth::user()->role == 'admin_penjualan' or 
            Auth::user()->role == 'admin_bendahara' or Auth::user()->role == 'admin_gp')
          <p class="message"> <a href="/admin">Batalkan</a></p> @ELSE <p class="message"> <a href="/home">Batalkan</a></p> @endif
        </form> 
      </div>
    </div>
  </body>
</html>
