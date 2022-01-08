<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ProductTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypes = ProductType::all();
        return $this->sendResponse($productTypes, 'Lấy loại sản phẩm thành công.');
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
     * @param  \App\Http\Requests\StoreProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $productType = ProductType::create($input);

        return $this->sendResponse($productType, 'Tạo kích thước sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        $productTypes = ProductType::find($productType);

        if (is_null($productTypes)) {
            return $this->sendError('Loại sản phẩm không tồn tại.');
        }
        return $this->sendResponse($productTypes, 'Lấy thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTypeRequest  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "name" => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $productType->fill([
            'name' => $input["name"],

        ]);

        $productType->save();

        return $this->sendResponse($productType, 'Thay đổi thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return $this->sendResponse([], 'Xóa tài khoản thành công!');
    }
}
