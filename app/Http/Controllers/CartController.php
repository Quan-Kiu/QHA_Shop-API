<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;


class CartController extends BaseController
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

    public function getCartByUser()
    {
        $carts = Auth::user()->carts;

        for ($i = 0; $i < Count($carts); $i++) {
            $carts[$i]['product'] = $carts[$i]->product;
        }

        return $this->sendResponse($carts, 'Lấy giỏ hàng thành công.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|int',
            'description' => 'required|string',
            'quantity' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $input['user_id'] = Auth::user()->id;


        $cart = Cart::create($input);
        $cart['product'] = $cart->product;
        return $this->sendResponse($cart, 'Tạo giỏ hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|int'
        ]);

        if ($validator->fails()) {
            $this->sendError($validator->errors()->first());
        }

        $cart->fill([
            'quantity' => $input['quantity']
        ]);

        $cart->save();

        $cart['product'] = $cart->product;

        return $this->sendResponse($cart, 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->sendResponse($cart, 'Xóa giỏ hàng thành công!');
    }
}
