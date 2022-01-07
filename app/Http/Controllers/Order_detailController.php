<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Order_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order_detail::all();
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
            'product_id' => 'required|string',
            'order_id' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string',
           
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $order = Order_detail::create($input);

        return $this->sendResponse($order, 'Tạo chi tiết đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order_detail::find($id);
        if (is_null($order)) {
            return $this->sendError('Chi tiết đơn hàng không tồn tại');
        }
        return $this->sendResponse($order, 'Lấy thông tin chi tiết đơn hàng thành công.');
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
    public function update(Request $request, Order_detail $order)
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

        $order->fill([
            'product_id' => $input["product_id"],
            'order_id' => $input["order_id"],
            'quantity' => $input["quantity"] ?? '',
            'price' => $input["price"] ?? '',
        ]);

        $order->save();

        return $this->sendResponse($order, 'Thay đổi chi tiết đơn hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_detail $order)
    {
        $order->delete();
        return $this->sendResponse($order, 'Xóa chi tiết đơn hàng thành công!');
    }
}
