<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if (!$user || !Hash::check($input['password'], $user->password)) {
            return $this->sendError('Sai email hoặc mật khẩu', 401);
        }

        $token = $user->createToken('MyAuthApp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->sendResponse($response, 'Đăng nhập thành công.');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|min:6|max:35',
            'email' => 'required|string|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['user'] =  $user;

        return $this->sendResponse($success, 'Tạo tài khoản thành công, Vui lòng đăng nhập.');
    }

    public function update(Request $request)
    {
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->sendResponse([], 'Đăng xuất thành công.');
    }
}
