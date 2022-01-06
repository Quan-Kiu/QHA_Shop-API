<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

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
