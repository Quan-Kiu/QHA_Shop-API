<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;


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
    public function store(StoreProductRequest $request)
    {
        //
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
