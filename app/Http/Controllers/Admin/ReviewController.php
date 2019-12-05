<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewTeacher;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ReviewTeacher::all();
        return view('admin.review.index', compact('reviews'));
    }

    public function edit($id)
    {
        $review = ReviewTeacher::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }
    public function update(Request $request, $id)
    {
        $review = $request->except('_token');
        $update = ReviewTeacher::where('id', $id)->update($review);
        return back()->with('success','Cập nhật thành công');
    }


    public function destroy($id)
    {
        $review = ReviewTeacher::where('id', $id)->delete();
        if ($review) {
            return redirect()->back()->with('message','Xóa thành công');
        }
        return redirect()->back()->with('message','Đã có lỗi xảy ra vui lòng thử lại');
    }
}
