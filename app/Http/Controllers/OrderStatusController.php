<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\OrderDetail;

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
        return $this->sendResponse($order, 'Lấy danh sách tình trạng đơn hàng thành công.');
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

        $order = Orderstatus::create($input);

        return $this->sendResponse($order, 'Tạo tình trạng đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function show(Request $orderstatus)
    {
        // $order = Orderstatus::find($id);
        // if (is_null($order)) {
        //     return $this->sendError('Loại đơn hàng không tồn tại');
        // }
        return $this->sendResponse($orderstatus, 'Lấy thông tin loại đơn hàng thành công.');
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
    public function update(Request $request, OrderStatus $orderStatus)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }


        $orderStatus->fill([
            'name' => $input["name"],
        ]);

        $orderStatus->save();

        return $this->sendResponse($orderStatus, 'Thay đổi thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderStatus = OrderStatus::find($id);
        if ($orderStatus) {
            $orderStatus->delete();
            return $this->sendResponse($orderStatus, 'Xóa tình trạng đơn hàng thành công!');
        } else {
            return $this->sendResponse($orderStatus, 'Xóa tình trạng đơn hàng không thành công!');
        }

        /* $orderStatus->delete();
        return $this->sendResponse($orderStatus, 'Xóa tình trạng đơn hàng thành công!'); */
    }
}
