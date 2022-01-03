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


    public function show(UserType $userType)
    {
        //
    }


    public function edit(UserType $userType)
    {
        //
    }


    public function update(UpdateUserTypeRequest $request, UserType $userType)
    {
        //
    }


    public function destroy(UserType $userType)
    {
        //
    }
}
