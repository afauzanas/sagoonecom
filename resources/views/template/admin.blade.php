<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap-4.1.3/dist/css/bootstrap.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/bootstrap.css')}}"> -->
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
                    <a class="nav-link underline" href="/shop" role="button"><i class="fa fa-shopping-cart"></i> Jual Luring</a>
                </li>
                        
                   <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-hospopup="true" aria-expanded="false">
                        Menu Referensi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Menu Akun Admin</a></li>
                        <li><a class="dropdown-item" href="/category">Menu Kategori Barang</a></li>
                        <li><a class="dropdown-item" href="/metode_bayar">Menu Metode Pembayaran</a></li>
                        <li><a class="dropdown-item" href="/ekspedisi">Menu Referensi Ekspedisi</a></li>
                        <li><a class="dropdown-item" href="/products">Menu Produk</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-hospopup="true" aria-expanded="false">
                        Menu Siklus Penjualan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('menupersediaan.index') }}">Menu Persediaan Barang Jadi</a></li>
                        <li><a class="dropdown-item" href="{{ route('menuordert.index') }}">Menu Order Tunai</a></li>
                        <li><a class="dropdown-item" href="/menuorderk">Menu Order Kredit</a></li>
                        <li><a class="dropdown-item" href="/okd">Menu Order Kredit Disetujui</a></li>
                        <li><a class="dropdown-item" href="{{ route('phbk.index') }}">Menu Permintaan Hak Beli Kredit</a></li>
                        <li><a class="dropdown-item" href="{{ route('hbkd.index') }}">Menu Hak Beli Kredit Disetujui</a></li>
                        <li><a class="dropdown-item" href="{{ route('pbt.index') }}">Menu Pengiriman Barang Tunai</a></li>
                        <li><a class="dropdown-item" href="{{ route('pbk.index') }}">Menu Pengiriman Barang Kredit</a></li>
                        <li><a class="dropdown-item" href="{{ route('fl.index') }}">Menu Faktur Lunas</a></li>
                        <li><a class="dropdown-item" href="/menunotaluring">Menu Nota Luring</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-hospopup="true" aria-expanded="false">
                        Laporan Penjualan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('lp.pelanggan') }}">Berdasarkan Pelanggan</a></li>
                        <li><a class="dropdown-item" href="{{ route('lp.produk') }}">Berdasarkan Produk</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-hospopup="true" aria-expanded="false">
                        Laporan Piutang & Kartu Persediaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('lpiutang.pelanggan') }}">Kartu Piutang per Pelanggan</a></li>
                        <li><a class="dropdown-item" href="{{ route('lpiutang.tpp') }}">Tingkat Perputaran & Periode Pengumpulan Piutang</a></li>
                        <li><a class="dropdown-item" href="{{ route('lpiutang.umurpiutang')}}">Daftar Umur Piutang</a></li>
                        <li><a class="dropdown-item" href="{{ route('lpersediaan.index')}}">Kartu Persediaan</a></li>
                    </ul>
                    </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/admin">Profile</a>
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
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
    @yield('script')
</body>
</html>