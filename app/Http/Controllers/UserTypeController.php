<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserTypeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;


class UserTypeController extends BaseController
{

    public function index()
    {
        $userTypeLst = UserType::all();
        return $this->sendResponse($userTypeLst, 'Lấy danh sách loại tài khoản thành công.');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }


        $userType = UserType::create($input);

        return $this->sendResponse($userType, 'Tạo loại tài khoản thành công.');
    }


    public function show($id)
    {
        $userType = UserType::find($id);

        if (is_null($userType)) {
            return $this->sendError('Loại người dùng không tồn tại.');
        }
        return $this->sendResponse($userType, 'Lấy thành công.');
    }


    public function edit(UserType $userType)
    {
        //
    }


    public function update(Request $request, UserType $userType)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }


        $userType->fill([
            'name' => $input["name"],
        ]);

        $userType->save();

        return $this->sendResponse($userType, 'Thay đổi thông tin thành công.');
    }


    public function destroy(UserType $userType)
    {
        $userType->delete();
        return $this->sendResponse([], 'Xóa thành công!');
    }
}
