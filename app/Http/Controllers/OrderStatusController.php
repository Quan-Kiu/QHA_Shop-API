<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use App\Http\Requests\StoreOrderStatusRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class OrderStatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Orderstatus::all();
        $response["user"] = $order;
        $response["total"] = $order->count();
        return $this->sendResponse($response, 'Lấy danh sách tình trạng đơn hàng thành công.');
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
     * @param  \App\Http\Requests\StoreOrderStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderStatusRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $order = Orderstatus::create($input);

        return $this->sendResponse($order, 'Tạo tình trạng đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Orderstatus::find($id);
        if (is_null($order)) {
            return $this->sendError('Loại đơn hàng không tồn tại');
        }
        return $this->sendResponse($order, 'Lấy thông tin loại đơn hàng thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderStatusRequest  $request
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $orderStatus->fill([
            'name' => $input["name"],
        ]);

        $orderStatus->save();

        return $this->sendResponse($orderStatus, 'Thay đổi tình trạng đơn hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();
        return $this->sendResponse($orderStatus, 'Xóa tình trạng đơn hàng thành công!');
    }
}
