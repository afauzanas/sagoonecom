<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $products = Product::paginate(6);
        return view('admin.product', compact('products'));
    }

    public function formstore()
    {
        $categories = Category::all();
        return view('admin.createproduk', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'harga' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        $duplicate = Product::where('name' , $request->name)->where('category_id', $request->category_id)->first();

        if($duplicate) {
            return redirect('/products')->with('error', 'Barang/Produk Sudah ada di Daftar!');
        }

        // IMAGE
        $imgName = '/images/' . time() . '-' . $request->image->getClientOriginalName();

        $request->image->move(public_path('images'), $imgName);


        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->harga,
            'desc' => $request->desc,
            'image' => $imgName
        ]);
        return redirect('/products')->with('success', 'Sukses Menambah Produk/Barang di Daftar Barang/Produk');
    }

    public function formedit($id)
    {
        $categories = Category::all();
        $products = Product::where('id', $id)->first();
        return view('admin.editproduct', compact('products', 'categories'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        // IMAGE
        $imgName = time() . '-' . $request->image->getClientOriginalName();

        $request->image->move(public_path('images'), $imgName);

        Product::where('id', $id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => $imgName
        ]);
        return redirect('/products');
    }

    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }
}
