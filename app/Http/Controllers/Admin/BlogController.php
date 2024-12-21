<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NoiDungBaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $noiDungBaiViet = NoiDungBaiViet::all();
        return view('admin.list_noidung', compact('noiDungBaiViet'));
    }


    public function show($dia_diem_id)
    {
        // Lấy nội dung của bài viết
        $noiDungs = NoiDungBaiViet::where('dia_diem_id', $dia_diem_id)->orderBy('thu_tu_noi_dung')->get();

        return view('admin.edit_noidung', compact('noiDungs'));
    }

    public function destroy($bai_viet_id)
    {
        $noiDung = NoiDungBaiViet::findOrFail($bai_viet_id);
        $noiDung->delete();

        return redirect()->route('admin.list_noidung')->with('success', 'Xóa nội dung bài viết thành công.');
    }



    // Lưu nội dung mới
    public function store(Request $request, $dia_diem_id)
    {
        $request->validate([
            'content_type' => 'required|string',
            'content_data' => 'required',
            'content_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content_name' => 'nullable|string',
        ]);

        // Tìm nội dung cần cập nhật
        $noiDung = NoiDungBaiViet::findOrFail($dia_diem_id);

        // Cập nhật thông tin
        $noiDung->loai_noi_dung = $request->content_type;
        $noiDung->du_lieu_noi_dung = $request->content_data;
        if ($request->hasFile('content_file')) {

            if ($noiDung->anh_phu) {
                Storage::disk('public')->delete($noiDung->anh_phu);
            }

            $file = $request->file('hinhanh');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('tour', $fileName, 'public');
            $noiDung->hinh_anh = $path;
        }
        $noiDung->ten_noi_dung = $request->content_name;

        // Lưu cập nhật
        $noiDung->save();

        return redirect()->back()->with('success', 'Cập nhật nội dung thành công!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm theo các trường cần thiết
        $noidung = NoiDungBaiViet::where('bai_viet_id', 'like', '%' . $query . '%')
            ->orWhere('dia_diem_id', 'like', '%' . $query . '%')
            ->orWhere('ten_noi_dung', 'like', '%' . $query . '%')
            ->get();

        // Trả về dữ liệu dưới dạng JSON
        return response()->json($noidung);
    }
}
