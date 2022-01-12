<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $response["user"] = $user;
        $response["total"] = $user->count();
        return $this->sendResponse($response, 'Lấy danh sách user thành công.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('Tài khoản không tồn tại.');
        }
        return $this->sendResponse($user, 'Lấy thông tin tài khoản thành công.');
    }

    public function unlike(Product $product)
    {
        $user = Auth::user();

        $liked = $user->liked;

        if ($liked == null || $liked == []) {
            $this->sendError('Bạn chưa thích sản phẩm này.');
        }
        $newLike = [];

        foreach ($liked as $id) {
            if ($id != $product->id) {
                array_push($newLike, $id);
            }
        }
        $user->fill([
            'liked' => $newLike,
        ]);

        $user->save();

        return $this->sendResponse($user, 'Hủy thích sản phẩm thành công.');
    }

    public function like(Product $product)
    {
        $user = Auth::user();

        $liked = $user->liked;



        if ($liked == null) {
            $liked = [];
        }
        foreach ($liked as $id) {
            if ($id == $product->id) {
                $this->sendError('Bạn đã thích sản phẩm này rồi.');
            }
        }
        array_push($liked, $product->id);
        $user->fill([
            'liked' => $liked,
        ]);
        $user->save();

        return $this->sendResponse($user, 'Thích sản phẩm thành công.');
    }

    public function getLiked()
    {
        $liked =  Auth::user()->liked;
        $products = [];
        if ($liked !== null) {

            foreach ($liked as $id) {
                $product  = Product::query()->where('id', '=', $id)->first();
                if ($product) {
                    array_push($products, $product);
                }
            }
        }
        return $this->sendResponse($products, 'Thành công');
    }

    public function refreshtoken()
    {
        Auth::user()->tokens()->delete();
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $this->sendResponse($response, 'Thành công');
    }
    public function changePassword(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }


        $user = Auth::user();


        if (!$user || !Hash::check($input['current_password'], $user->password)) {
            return $this->sendError('Mật khẩu cũ không chính xác', 401);
        }

        $input['password'] = bcrypt($input['password']);

        $user->fill([
            'password' => $input['password'],
        ]);
        $user->save();

        return $this->sendResponse([], 'Thay đổi mật khẩu thành công.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "fullname" => 'required|string|max:35|min:6',
            "email" => 'required|string|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $user->fill([
            'fullname' => $input["fullname"],
            'email' => $input["email"],
            'phone' => $input["phone"] ?? '',
            'gender' => $input["gender"] ?? 'Nam',
            'birthday' => $input["birthday"] ?? null,
            'address' => $input["address"] ?? '',
            'status' => $input["status"] ?? 1,
            'user_type_id' => $input["user_type_id"] ?? 1,

        ]);

        $user->save();

        return $this->sendResponse($user, 'Thay đổi thông tin cá nhân thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse($user, 'Xóa tài khoản thành công!');
    }
}
