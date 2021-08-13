@extends('template.user')

@section('title')
    Cart
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}"> 
@endsection

@section('content')
<div class="container">
    <!-- success message & Error message -->
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
        @php
            $total = 0;    
        @endphp

@if ($carts->count() == 0)
    <p style="text-align:center;">Keranjangmu kosong!</p>
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

<div>
    <h3>Ada {{$carts->count()}} produk di keranjangmu</h3>
</div>

@foreach ($carts as $cart)
<div class="cart">
        <div class="row">
            <div class="col-lg-3">
            <img class="img-cart" src="{{asset($cart->product->image)}}" alt="">
            </div>
            <div class="col-lg-9">
                <div class="top">
                    <p class="item-name">{{$cart->product->name}}</p>
                    <div class="top-right">
                        <p class="">Rp{{number_format($cart->product->price)}}</p>
                        <input type="int" name="qty" class="quantity" data-item="{{$cart->id}}" value="{{$cart->qty}}">
                        <p></p>
                        <!-- Subtotal -->
                        <p class="total-item">Rp{{number_format($cart->product->price * $cart->qty)}}</p>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="bottom">
                   <div class="row">
                        <p class="col-lg-6 item-desc">
                            {{$cart->product->desc}}
                        </p>
                        <div class="offset-lg-4">

                        </div>
                        <div class="col-lg-2">
                        <!-- delete cart -->
                        <form action="/cart/delete/{{$cart->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@php
    $total += ($cart->product->price * $cart->qty);
@endphp
@endforeach
<div class="totalz">
    <h4 class="total-price">Total Price: Rp{{number_format($total)}}</h4>
</div>
</div>
<br>
<button type="button" style="margin-left: 700px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Kredit">Beli Kredit</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tunai" data-whatever="Tunai">Beli Tunai</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#luring" data-whatever="Luring">Jual Luring</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beli Kredit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/checkout/belikredit" method="POST">
            @csrf
          <div class="form-group">
            <label for="metode_bayar_id" class="col-form-label">Pembayaran Via:</label>
            <select name="metode_bayar_id" class="form-control" id="metode_bayar_id">
                @foreach ($metode_bayars as $metode_bayar)
                <option value="{{$metode_bayar->id}}">{{$metode_bayar->kode_metode}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="alamat_terima" class="col-form-label">Alamat Terima:</label>
            <textarea name="alamat_terima" class="form-control" id="alamat_terima"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Beli Kredit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="Tunai" tabindex="-1" aria-labelledby="TunaiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TunaiLabel">Beli Tunai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/checkout/belitunai" method="POST">
            @csrf
          <div class="form-group">
            <label for="metode_bayar_id" class="col-form-label">Pembayaran Via:</label>
            <select name="metode_bayar_id" class="form-control" id="metode_bayar_id">
                @foreach ($metode_bayars as $metode_bayar)
                <option value="{{$metode_bayar->id}}">{{$metode_bayar->kode_metode}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="alamat_terima" class="col-form-label">Alamat Terima:</label>
            <textarea name="alamat_terima" class="form-control" id="alamat_terima"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Beli Tunai</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="luring" tabindex="-1" aria-labelledby="luringLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="luringLabel">Beli Luring</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/checkout/beliluring" method="POST">
            @csrf
          <div class="form-group">
            <label for="ket" class="col-form-label">Keterangan:</label>
            <textarea name="ket" class="form-control" id="ket"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Beli Luring</button>
      </div>
      </form>
    </div>
  </div>
</div>

    {{-- @endif --}}

@endsection

@section('script')
<script type="text/javascript">
    (function(){
    const classname = document.querySelectorAll('.quantity');

    Array.from(classname).forEach(function(element){
     element.addEventListener('change', function(){
        const id = element.getAttribute('data-item');
        axios.patch(`/cart/${id}`, {
            quantity: this.value,
            id: id
          })
          .then(function (response) {
            //console.log(response);
            window.location.href = '/cart'
          })
          .catch(function (error) {
            // console.log(error);
          });
   })
 })
    })();
</script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>

<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var jenis = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Masukkan alamat dan pilihan pembayaran ' + jenis)
  modal.find('.modal-body input')
})

$('#Tunai').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var jenis = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Masukkan alamat dan pilihan pembayaran ' + jenis)
  modal.find('.modal-body input')
})

$('#luring').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var jenis = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Masukkan Keterangan Penjualan ' + jenis)
  modal.find('.modal-body input')
})
</script>
@endsection