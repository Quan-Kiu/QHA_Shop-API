<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::query()->orderBy('rating', 'desc')->get();
        foreach ($products as $product) {
            $product['comments'] = $product->comments;

            $count = count($product['comments']);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $product['comments'][$i]['user'] = $product['comments'][$i]->user;
                }
            }
        }
        $response['products'] = $products;

        $response['total'] = $products->count();

        return $this->sendResponse($response, 'Lay danh sach san pham thanh cong.');
    }

    public function getDiscountProduct(Request $request)
    {
        $limit = $request['limit'] ?? 10;
        $page = $request['page'] ?? 1;
        $products = Product::all();
        $discountProduct = [];
        foreach ($products as $product) {
            $percent = ((($product->price - $product->discount) / $product->price) * 100);
            if ($percent >= 25) {
                $product['comments'] = $product->comments;
                $count = count($product['comments']);
                if ($count > 0) {
                    for ($i = 0; $i < $count; $i++) {
                        $product['comments'][$i]['user'] = $product['comments'][$i]->user;
                    }
                }
                array_push($discountProduct, $product);
            }
        }
        $current = $page * $limit - 1;
        $total_pages = ceil(Count($discountProduct) / $limit);
        $response['products'] = array_slice($discountProduct, $current - $limit + 1, $current);
        $response['total_pages'] = $total_pages;
        $response['page'] = $page;

        return $this->sendResponse($response, 'Lay danh sach san pham thanh cong.');
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'thumbnail' => 'required|string',
            'images' => 'required|array',
            'description' => 'required|string',
            'colors' => 'required|array',
            'sizes' => 'required|array',
            'product_type_id' => 'required|int',
            'price' => 'required|int',
            'discount' => 'required|int',
            'stock' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $product = $request->all();

        $newProduct = Product::create($product);

        return $this->sendResponse($newProduct, 'Tạo sản phẩm thành công.');
    }

    public function search(Request $request)
    {

        $products = Product::where(function ($query) use ($request) {
            if ($request['product_type_id'] != null) {
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
                'Lay danh sach san pham thanh cong.'
            );
        }
        return $this->sendError('San pham khong ton tai.', 401);
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
        $product->delete();
        return $this->sendResponse($product, 'Xóa sản phẩm thành công!');
    }
}
