<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Center;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::all();
        return view('admin.center.index', compact('centers'));
    }

    public function edit($id)
    {
        $center = Center::findOrFail($id);
        return view('admin.center.edit', compact('center'));
    }
    public function update(Request $request, $id)
    {
        $center = $request->except('_token');
        $update = Center::where('id', $id)->update($center);
        return back()->with('success','Cập nhật thành công');
    }
    public function create()
    {
        return view('admin.center.create');
    }

    public function destroy($id)
    {
        $center = Center::where('id', $id)->delete();
        if ($center) {
            return redirect()->back()->withFlashSuccess('Xóa thành công');
        }
        return redirect()->back()->withFlashDanger('Đã có lỗi xảy ra vui lòng thử lại');
    }
}
