<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notify;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\OrderDetail;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()->where('order_status_id', '=', $request->id)->get();
        foreach ($orders as $key => $value) {
            $value['order_status'] = $value->OrderStatus;
        }

        return $this->sendResponse($orders, 'Lấy danh sách đơn hàng thành công.');
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request['user_id'] = Auth::user()->id;
        $carts = Auth::user()->carts;

        foreach ($carts as $cart) {
            if ($cart->product->stock < $cart->quantity) {
                return $this->sendError('Sản phẩm ' . $cart->product->name . ' không đủ số lượng tồn kho cung câp, Vui lòng kiểm tra và đặt hàng lại.');
            }
        }

        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'user_id' => 'required|int',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'unit_price' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $date = date("Y-m-d", strtotime('+ 7 day'));
        $request['delivery_date'] = $date;
        $request['code'] = Str::random(4) . strtotime(date('Y-m-d H:i:s'));
        $request['quantity'] = Count($carts);
        $input = $request->all();
        $order = Order::create($input);

        foreach ($carts as $cart) {
            $formData['product_id'] = $cart->product_id;
            $formData['order_id'] = $order->id;
            $formData['description'] = $cart->description;
            $formData['quantity'] = $cart->quantity;
            $formData['unit_price'] = $cart->product->discount * $cart->quantity;
            OrderDetail::create($formData);
            $cart->delete();
        }

        return $this->sendResponse($order, 'Đặt hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_details = $order->OrderDetails;
        foreach ($order_details as $key => $value) {
            $value['product'] = $value->product;
        }
        return $this->sendResponse($order_details, 'Lấy thông tin đơn hàng thành công.');
    }

    public function getOrderByUser(Request $request)
    {
        $orders = Order::where(function ($query) use ($request) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('order_status_id', '=', $request->id);
        })->get();

        foreach ($orders as $key => $value) {
            $value['order_status'] = $value->OrderStatus;
        }

        return $this->sendResponse($orders, 'Lấy danh sách đơn hàng thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'phone' => 'required|string',
            'delivery_date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $oldStatus = $order->order_status_id;

        $order->fill([
            'address' => $input["address"],
            'phone' => $input["phone"],
            'delivery_date' => $input["delivery_date"],
            'order_status_id' => $input["order_status_id"],
        ]);

        $order->save();
        if ($oldStatus != $order->order_status_id && $input['order_status_id'] < 5) {
            $notify = [
                'title' => 'Giao dịch đơn hàng ' . $order->code,
                'description' =>  $order->order_status_id == 4 ? 'Đơn hàng của bạn đã được giao thành công, rất cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.' : 'Đơn hàng của bạn đã chuyển sang trạng thái ' . $order->OrderStatus->name . ', ngày giao hàng dự kiến là ngày ' . $order->delivery_date,
            ];

            $notify['user_id'] = $order->user_id;

            Notify::create($notify);
        }

        return $this->sendResponse($order, 'Thay đổi thông tin đơn hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $orders_detail = $order->OrderDetails;
        foreach ($orders_detail as $key => $value) {
            $value->delete();
        }
        $order->delete();
        return $this->sendResponse($order, 'Hủy đơn hàng thành công!');
    }
}
