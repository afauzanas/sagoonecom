@extends('template.admin')

@section('title')
    Menu Nota Luring
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container mt-5" style="width: 50%;">
  <form class="mb-6" action="/menunotaluring/store" method="POST">
    @csrf
    <h1 class="text-center mb-6">Tambah Data Nota Luring</h1>
    <div class="form-group">
        <label for="no_nota_luring">Nomor Nota Luring</label>
        <input type="text" name="no_nota_luring" id="no_nota_luring" class="form-control">
    </div>
    <div class="form-group">
      <label for="ket">Keterangan</label>
      <textarea name="ket" class="form-control" id="ket" rows="3" placeholder="Masukkan Keterangan"></textarea>
    </div>
    <h3 class="text-center mb-6">Detail Persediaan</h3>
    <center>
    <table style="text-align: center" border="1" id="notalku">
    <tr>
      <td> Barang/Produk </td>
      <td> Unit </td>
      <td> Harga </td>
    </tr>
    <tr id="akan_dicopy">
      <td><select name="product_id[]" id="product_id" class="form-control" style="display:none" disabled>
          @foreach ($products as $product)
          <option value="{{$product->id}}">{{$product->name}}</option>
          @endforeach
          </select>
        </td>
      <td><input type="number" name="unit[]" style="display:none" disabled></td>
      <td><input type="number" name="harga[]" style="display:none" disabled></td>
    </tr>
    <tr>
      <td><select name="product_id[]" id="product_id" class="form-control">
          @foreach ($products as $product)
          <option value="{{$product->id}}">{{$product->name}}</option>
          @endforeach
        </select></td>
      <td><input type="number" name="unit[]"></td>
      <td><input type="number" name="harga[]"></td>
    </tr>
    </table> <br>
    <input type="submit" name="tombol_tambah" value="Tambah Baris" onclick="return tambah_baris()">
    </center>
    <br><br>
    <button type="submit" id="btn-submit" class="btn btn-primary">TAMBAHKAN DATA</button>
  </form> <br>
  <a class="btn btn-dark" href="/menunotaluring">Batalkan</a>
</div>
@endsection

@section('script')
<script>
	function tambah_baris()
	{
		//clone / mengcopy baris----
		baris_baru = document.getElementById("akan_dicopy").cloneNode(true);
		
		baris_baru.children[0].children[0].style.display="block";
		baris_baru.children[0].children[0].disabled=false;
		
		baris_baru.children[1].children[0].style.display="block";
		baris_baru.children[1].children[0].disabled=false;

    baris_baru.children[2].children[0].style.display="block";
		baris_baru.children[2].children[0].disabled=false;
		
		document.getElementById("notalku").appendChild(baris_baru);
		
		return false;
	}

</script>
@endsection