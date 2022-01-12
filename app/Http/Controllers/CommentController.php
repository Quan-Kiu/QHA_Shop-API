<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class CommentController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->rating) {

            $comments = Comment::query()->where('rating', '=', $request->rating)->get();
            foreach ($comments as $key => $value) {
                $value['user'] = $value->User;
            }
        } else {

            $comments = Comment::all();
            foreach ($comments as $key => $value) {

                $value['user'] = $value->User;
            }
        }

        return $this->sendResponse($comments, 'Lấy danh sách bình luận thành công.');
    }


    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int',
            'content' => 'required|string',
            'rating' => 'required|int',
            'product_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $comments = Comment::create($input);


        $product = Product::query()->where('id', '=', $input['product_id'])->first();

        $allcomments = $product->comments;

        $totalRating = 0;

        foreach ($allcomments as $comment) {
            $totalRating += $comment->rating;
        }


        $newRating = $totalRating / count($allcomments);


        $product->fill([
            'rating' => $newRating,
        ]);

        $product->save();

        return $this->sendResponse($comments, 'Đánh giá sản phẩm thành công.');
    }

    public function getCommentByProduct(Request $request, Product $product)
    {
        $result = [];
        if ($request['rating']) {
            $comments = $product->comments;
            foreach ($comments as $key => $value) {
                if ($value['rating'] == $request['rating']) {
                    $value['user'] = $value->User;
                    array_push($result, $value);
                }
            }
        } else {
            $result = $product->comments;
            foreach ($result as $key => $value) {
                $value['user'] = $value->User;
            }
        }
        return $this->sendResponse($result, 'Thành công');
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
        $request['user_id'] = Auth::user()->id;

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int',

            'content' => 'required|string',
            'rating' => 'required|string',
            'product_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $comments->fill([
            'user_id' => $input['user_id'],
            'content' => $input["content"],
            'rating' => $input["rating"],
            'product_id' => $input["product_id"],
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
