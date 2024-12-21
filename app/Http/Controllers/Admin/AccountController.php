<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

session_start();

class AccountController extends Controller
{
    public function index()
    {
        $data = User::select('id', 'name', 'email', 'phone', 'is_admin')->get();
        return view('admin.list_taikhoan', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenTK' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255',
            'Gender' => 'required|in:nam,nu',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'adress' => 'required|string|max:255',
        ]);

        // Tìm và cập nhật dữ liệu
        $taikhoan = User::findOrFail($id);
        $taikhoan->name = $request->input('TenTK');
        $taikhoan->email = $request->input('Email');
        $taikhoan->gender = $request->input('Gender');
        $taikhoan->phone = $request->input('phone');
        $taikhoan->adress = $request->input('adress');
        $taikhoan->save();

        return redirect()->route('list_taikhoan')->with('success', 'Cập nhật thành công!');
    }


    public function edit($id)
    {
        $taikhoan = User::findOrFail($id);
        return view('admin.edit_taikhoan', compact('taikhoan'));
    }

    public function delete_account($id)
    {
        try {
            $taikhoan = User::findOrFail($id);
            $taikhoan->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
        return redirect()->route('list_taikhoan')->with('success', 'Tài Khoản đã được xóa thành công!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');


        // Thực hiện tìm kiếm theo tên tài khoản hoặc email
        $data = User::where('id', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();


        return response()->json($data);
    }
}
