<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        $response["orders"] = $order;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'phone' => 'required|string',
            'total' => 'required|string',
            'delivery_date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $order = Order::create($input);

        return $this->sendResponse($order, 'Tạo đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return $this->sendError('Đơn hàng không tồn tại');
        }
        return $this->sendResponse($order, 'Lấy thông tin đơn hàng thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'phone' => 'required|string',
            'total' => 'required|string',
            'delivery_date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $order->fill([
            'address' => $input["address"],
            'total' => $input["total"],
            'phone' => $input["phone"] ?? '',
            'delivery_date' => $input["delivery_date"] ?? '',
            'order_status_id' => $input["order_status_id"],
        ]);

        $order->save();

        return $this->sendResponse($order, 'Thay đổi thông tin cá nhân thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->sendResponse($order, 'Xóa đơn hàng thành công!');
    }
}
