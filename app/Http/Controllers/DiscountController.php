<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DiscountController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return $this->sendResponse($discounts, 'Thành công');
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
    public function checkDiscount(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        $discount = Discount::where('code', '=', $input['code'])->first();
        $whereCondition = [

            ['discount_code', '=', $input['code']],
            ['user_id', '=', Auth::user()->id],

        ];

        if ($discount) {

            $order = Order::where($whereCondition)->first();
            if (!$order) {
                $today_time = strtotime(date("Y-m-d h:m"));
                $expire_time = strtotime($discount->drought);
                if ($today_time > $expire_time) {
                    return $this->sendError('Mã giảm giá này đã hết hạn.');
                } else {
                    return $this->sendResponse($discount, 'Thành công');
                }
            } else {
                return $this->sendError('Bạn đã sử dụng mã giảm giá này trước đó.');
            }
        } else {

            return $this->sendError('Mã giảm giá này không tồn tại.');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'price' => 'required|int',
            'drought' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $date = date("Y-m-d h:m", strtotime('+ ' . $request['drought']));
        $request['drought'] = $date;
        $input = $request->all();

        $discount = Discount::create($input);

        return $this->sendResponse($discount, 'Tạo mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'price' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $discount->fill([
            'code' => $input["code"],
            'price' => $input["price"],
        ]);

        $discount->save();

        return $this->sendResponse($discount, 'Thay đổi thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return $this->sendResponse([], 'Xóa thành công!');
    }
}
