<?php

namespace App\Http\Controllers;

use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use Auth;

class ShippingInfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreShippingInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',

        ]);
        $input = $request->all();

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $shipping_info = ShippingInfo::create($input);
        return $this->sendResponse($shipping_info, 'Tạo địa chỉ giao hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingInfo  $shippingInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingInfo $shippingInfo)
    {
        //
    }

    public function getShippingInfoByUser()
    {
        $shipping_infos = Auth::user()->shippingInfos;

        return $this->sendResponse($shipping_infos, 'Thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingInfo  $shippingInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingInfo $shippingInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShippingInfoRequest  $request
     * @param  \App\Models\ShippingInfo  $shippingInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingInfo $shippingInfo)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',

        ]);

        $input = $request->all();

        $shippingInfo->fill([
            'fullname' => $input["fullname"],
            'phone' => $input["phone"],
            'address' => $input["address"],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $shippingInfo->save();
        return $this->sendResponse($shippingInfo, 'Sửa địa chỉ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingInfo  $shippingInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingInfo $shippingInfo)
    {
        $shippingInfo->delete();
        return $this->sendResponse([], 'Xóa thành công!');
    }
}
