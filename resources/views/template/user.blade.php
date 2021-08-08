<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('style')
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">ß
</head>
<body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">SAGOONE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
      
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                          <a class="nav-link underline" href="/cart"><i class="fa fa-shopping-cart"></i> Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link underline" href="/shop" role="button"><i class="fa fa-shopping-cart"></i> Belanja</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-hospopup="true" aria-expanded="false">
                              Daftar Pesanan
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="{{ route('daftarpesanan.tunai') }}">Daftar Pesanan Tunai</a></li>
                              <li><a class="dropdown-item" href="{{ route('daftarpesanan.kredit') }}">Daftar Pesanan Kredit</a></li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <form action="{{ route('phbk.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Minta HAK BELI KREDIT</button>
                          </form>
                        </li>
                <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/home">Profile</a>
                @if(Auth::user()->role == 'admin_owner' or Auth::user()->role == 'admin_penjualan' or 
                Auth::user()->role == 'admin_bendahara' or Auth::user()->role == 'admin_gp')
                <a class="dropdown-item" href="/admin">Tampilan Admin</a> @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Logout</a>
      
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              </div>
            </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script')
</body>
</html>