<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category', compact('categories'));
    }

    public function formstore()
    {
        return view('admin.createcategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);

        $duplicate = Category::where('name' , $request->category)->first();

        if($duplicate) {
            return redirect('/category')->with('error', 'Kategori Sudah Ada!');
        }

        Category::create([
            'name' => $request->category
        ]);
        return redirect('/category')->with('success', 'Sukses menambah kategori produk!');
    }

    public function formedit($id)
    {
        $categories = Category::where('id', $id)->first();
        return view('admin.editcategory', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->nama_category
        ]);
        return redirect('/category');
    }

    public function delete($id)
    {
        Category::destroy($id);
        return back();
    }
}
