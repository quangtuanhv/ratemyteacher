<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Role;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }
    public function edit($id)
    {
        $centers = Center::all();
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.edit', compact(['teacher','centers']));
    }
    public function create()
    {
        $centers = Center::all();
        return view('admin.teacher.create', compact('centers'));
    }
    public function update(Request $request, $id)
    {
        $inputs = $request->except('_token');
        $teacher = Teacher::where('id', $id)->first();
        $teacher->update($inputs);
        $teacher->centers()->sync($inputs['centers']);

        return back()->with('success','Cập nhật giáo viên thành công');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->withFlashSuccess('Xóa thành công');
        }
        return redirect()->back()->withFlashDanger('Đã có lỗi xảy ra vui lòng thử lại');
    }
}
