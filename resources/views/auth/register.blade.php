<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
  </head>
  <body>
    <div class="container">
      <div class="login-wrapper">
        <h1 class="title">Register</h1>
        <hr>
        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf
          <input type="text" class="input" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>

          @error('name')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <input type="email" class="input" placeholder="E-mail"  name="email" value="{{ old('email') }}" required>

          @error('email')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <input type="password" class="input" placeholder="Password" name="password" required>

          @error('password')
              <span class="invalid-feedback" role="alert">
                 {{ $message }}
              </span>
          @enderror

           <input id="password-confirm" placeholder="Confirm Password" type="password" class="input" name="password_confirmation" required>

           <input type="text" class="input" placeholder="Kota atau Kabupaten"  name="kota_kab" required>

          @error('kota_kab')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
          @enderror

          <textarea name="address" rows="3" placeholder="Address" rows="3" required></textarea>

          @error('address')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror


          <input type="text" class="input" placeholder="Nomor Handphone"  name="phone" required>

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
              <option value="user">Pelanggan</option>
            </select>
          <!-- <input type="text" class="input" placeholder="Role"  name="role" required> -->

          @error('role')
              <span class="invalid-feedback" role="alert">
                  {{ $message }}
              </span>
          @enderror
          </div>  

          <button type="submit">Register</button>
          <p class="message">Already registered? <a href="/login">Sign In</a></p>
        </form>
      </div>
    </div>
  </body>
</html>
