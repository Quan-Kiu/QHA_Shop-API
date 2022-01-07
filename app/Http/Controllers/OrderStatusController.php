<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order_status;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order_status::all();
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
     * @param  \Illuminate\Http\Request  $request
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

        $order = Order_status::create($input);

        return $this->sendResponse($order, 'Tạo tình trạng đơn hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order_status::find($id);
        if (is_null($order)) {
            return $this->sendError('Loại đơn hàng không tồn tại');
        }
        return $this->sendResponse($order, 'Lấy thông tin loại đơn hàng thành công.');
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
    public function update(Request $request, Order_status $order)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $order->fill([
            'name' => $input["name"],
        ]);

        $order->save();

        return $this->sendResponse($order, 'Thay đổi tình trạng đơn hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_status $order)
    {
        $order->delete();
        return $this->sendResponse($order, 'Xóa tình trạng đơn hàng thành công!');
    }
}
