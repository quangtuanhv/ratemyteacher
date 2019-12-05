<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles' => function ($query) {
            return $query->where('type', 3);
        }])->get();
        return view('admin.user.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function show($id)
    {
        return view('admin.user.edit');
    }

    public function update(Request $request, $id)
    {
        $user = $request->except('_token');
        $update = User::where('id', $id)->update($user);
        return back()->with('success', 'Cập nhật thành công');
    }

    public function create()
    {

    }

    public function store()
    {

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
