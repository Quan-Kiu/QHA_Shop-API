<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as BaseController;

class OrderDetailController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Orderdetail::all();
        $response["order"] = $order;
        $response["total"] = $order->count();
        return $this->sendResponse($response, 'Lấy danh sách đơn hàng thành công.');
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
     * @param  \App\Http\Requests\StoreOrderDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderDetailRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'order_id' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $order = Orderdetail::create($input);

        return $this->sendResponse($order, 'Tạo chi tiết đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DB::table('order_details')
                ->where('order_id', '=', $id)
                ->get();

        if (is_null($order)) {
            return $this->sendError('Chi tiết đơn hàng không tồn tại');
        }
        return $this->sendResponse($order, 'Lấy thông tin chi tiết đơn hàng thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderDetailRequest  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'order_id' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $orderDetail->fill([
            'product_id' => $input["product_id"],
            'order_id' => $input["order_id"],
            'quantity' => $input["quantity"] ?? '',
            'price' => $input["price"] ?? '',
        ]);

        $orderDetail->save();

        return $this->sendResponse($orderDetail, 'Thay đổi chi tiết đơn hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return $this->sendResponse($orderDetail, 'Xóa chi tiết đơn hàng thành công!');
    }
}
