<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(3)->onEachSide(1);
        return view('product.index', compact('products'))->with(['title' => 'Product']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create')->with(['title' => 'Create Product']);
    }

    /**
     * Store and update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $postData = $request->only('name','price','description');
        $postData['user_id'] = auth()->user()->id;
        if($request->image && $request->image != null){
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path(Product::IMAGEPATH), $imageName);
            $postData['image'] = $imageName;
        }
        Product::updateOrCreate(['id' => $request->id],$postData);
        return redirect()->route('product.index')->with('message','Product '.($request->id>0? 'Updated': 'Created').' Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'))->with(['title' => 'Show Product']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.create', compact('product'))->with(['title' => 'Edit Product']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $productImg = $product->image;
        $product->delete();
        unlink(public_path(Product::IMAGEPATH.'/'.basename($productImg)));
        return redirect()->route('product.index')->with('message', 'Product Deleted Successfully');
    }
}
