<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  const PATH_VIEW = 'products.';
  const PATH_UPLOAD = 'products';

    public function index()
    {
        $data = Product::query()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
        //123
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->except('img');
       if($request->hasFile('img')){
        $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
     }
      Product::query()->create($data);

    //   Product::query()->create($request->all());
      return back()->with('msg','Thêm Thành Công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__,compact('product'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    
    {

        return view(self::PATH_VIEW . __FUNCTION__,compact('product'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return back()->with('msg','Sửa Thành Công');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('msg','Xóa Thành Công');
        //
    }
}
