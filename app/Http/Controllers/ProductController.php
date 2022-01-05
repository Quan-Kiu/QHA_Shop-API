<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $response['products'] = $products;
        $response['total'] = $products->count();

        return $this->sendResponse($response, 'Lấy danh sách sản phẩm thành công.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $product = new Product;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->product_type_id = $request->input('product_type_id');
            $product->price = $request->input('price');
            $product->sale = $request->input('sale');
            $product->stock = $request->input('stock');
            $product->sizes= $request->input('sizes');
            $product->colors = $request->input('colors');
            $product->images = $request->input('images');
            $product->save();

         $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'product_type_id' => 'required|int',
            'sizes' => 'required|int',
            'colors' => 'required|int',
            'images' => 'required|int',
            'price' => 'required|int',
            'sale' => 'required|int',
            'stock' => 'required|int',
        ]); 

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        } 


        return $this->sendResponse($product, 'Tạo sản phẩm thành công.');
    }

    public function search(Request $request)
    {

        $products = Product::where(function ($query) use ($request) {
            if ($request['product_type_id']) {
                $query->where('product_type_id', '=', $request->product_type_id);
            }
            if ($request['name']) {
                $query->where('name', 'LIKE', "%" . $request->name . "%");
            }
        })->get();


        $response['products'] = $products;
        $response['total'] = $products->count();
        if ($response['total'] > 0) {
            return $this->sendResponse(
                $response,
                'Lấy danh sách sản phẩm thành công.'
            );
        }
        return $this->sendError('Sản phẩm không tồn tại.', 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
