<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::all();
        $response['comment'] = $cart;
        $response['total'] = $cart->count();

        return $this->sendResponse($response, 'Lấy danh sách giỏ hàng thành công.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'user_id' => 'required|string',
            'quantity' => 'required|string',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $cart = Cart::create($input);

        return $this->sendResponse($cart, 'Tạo giỏ hàng thành công.');
    }

  
    public function show($id)
    {
        $cart = Cart::find($id);
        if (is_null($cart)) {
            return $this->sendError('Giỏ hàng không tồn tại');
        }
        return $this->sendResponse($cart, ' Thành công.');
    }

    public function update(Request $request, Cart $cart)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'user_id' => 'required|string',
            'quantity' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $cart->fill([
            'product_id' => 'required|string',
            'user_id' => 'required|string',
            'quantity' => 'required|string',
        ]);

        $cart->save();

        return $this->sendResponse($cart, 'Thay đổi thông tin thành công.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->sendResponse($cart, 'Xóa giỏ hàng thành công!');
    }
}
