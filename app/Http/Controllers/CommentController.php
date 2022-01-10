<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    public function index()
    {
        $comments = Comment::all();
        $response['comment'] = $comments;
        $response['total'] = $comments->count();

        return $this->sendResponse($response, 'Lấy danh sách bình luận thành công.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'rating' => 'required|string',
            'product_id' => 'required|string',
            'datecreate' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $comments = Comment::create($input);

        return $this->sendResponse($comments, 'Tạo bình luận thành công.');
    }

  
    public function show($id)
    {
        $order = Comment::find($id);
        if (is_null($order)) {
            return $this->sendError('Bình luận không tồn tại');
        }
        return $this->sendResponse($order, 'Bình luận đơn hàng thành công.');
    }

    public function update(Request $request, Comment $comments)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'rating' => 'required|string',
            'product_id' => 'required|string',
            'date_create' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $comments->fill([
            'content' => $input["content"],
            'rating' => $input["rating"],
            'product_id' => $input["product_id"] ,
            'date_create' => $input["date_create"] ,
        ]);

        $comments->save();

        return $this->sendResponse($comments, 'Thay đổi thông tin thành công.');
    }

    public function destroy(Comment $comments)
    {
        $comments->delete();
        return $this->sendResponse($comments, 'Xóa bình luận thành công!');
    }

}
