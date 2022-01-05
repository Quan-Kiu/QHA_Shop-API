<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateSizeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class SizeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes = Size::all();

        if ($request['product_type_id']) {
            print($request->product_type_id);
            $sizes = Size::where('product_type_id', '=', $request->product_type_id)->get();
        }

        return $this->sendResponse(
            $sizes,
            'Lấy danh sách sản phẩm thành công.'
        );
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
     * @param  \App\Http\Requests\StoreSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'product_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $size = Size::create($input);

        return $this->sendResponse($size, 'Tạo kích thước sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::find($id);

        if (is_null($size)) {
            return $this->sendError('Kích thước không tồn tại.');
        }
        return $this->sendResponse($size, 'Lấy thành công.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSizeRequest  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'product_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }


        $size->fill([
            'name' => $input["name"],
            'product_type_id' => $input["product_type_id"],

        ]);

        $size->save();

        return $this->sendResponse($size, 'Thay đổi thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return $this->sendResponse([], 'Xóa thành công!');
    }
}
