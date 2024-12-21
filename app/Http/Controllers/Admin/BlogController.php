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
        $noiDungBaiViet = NoiDungBaiViet::paginate(10)->withQueryString();
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

        return redirect()->route('list_noidung')->with('success', 'Xóa nội dung bài viết thành công.');
    }



    // Lưu nội dung mới
    public function store(Request $request, $dia_diem_id)
    {
        $request->validate([
            'content_type' => 'required|array',
            'content_data' => 'required|array',
            'content_file' => 'nullable|array',
            'content_name' => 'required|array',
        ]);

        // Xử lý từng khối nội dung
        foreach ($request->content_type as $key => $type) {
            // Lấy thông tin từ form
            $contentData = $request->content_data[$key] ?? null;
            $contentName = $request->content_name[$key] ?? null;
            $contentFile = $request->file('content_file')[$key] ?? null;

            // Tìm hoặc tạo mới nội dung
            $noiDung = NoiDungBaiViet::updateOrCreate(
                [
                    'dia_diem_id' => $dia_diem_id,
                    'loai_noi_dung' => $type,
                    'thu_tu_noi_dung' => $key // Đảm bảo mỗi khối nội dung có một thứ tự riêng
                ],
                [
                    'du_lieu_noi_dung' => $contentData,
                    'ten_noi_dung' => $contentName,
                    // Chỉ cập nhật ảnh nếu loại nội dung là 'image'
                    'anh_phu' => $type === 'image' ? $this->handleFileUpload($contentFile, NoiDungBaiViet::where('dia_diem_id', $dia_diem_id)->where('loai_noi_dung', $type)->first()) : null
                ]
            );
        }

        return redirect()->route('list_noidung')
            ->with('success', 'Cập nhật nội dung thành công!');
    }

    private function handleFileUpload($contentFile, $noiDung = null)
    {
        if ($contentFile) {
            // Nếu có tệp mới, tạo tên mới và lưu tệp mới
            $fileName = time() . '-' . $contentFile->getClientOriginalName();
            // Lưu tệp vào thư mục 'tour' và trả về đường dẫn lưu tệp
            return $contentFile->storeAs('tour', $fileName, 'public');
        }

        // Nếu không có tệp mới, giữ nguyên tệp cũ (nếu có)
        return $noiDung ? $noiDung->anh_phu : null;
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

    public function show_add_noidung($id)
    {
        return view('admin.add_noidung', ['dia_diem_id' => $id]);
    }

    public function add_noi_dung(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'content_type' => 'required|array',
            'content_name' => 'required|array',
            'content_data' => 'required|array',
            'content_file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $maxThuTu = NoiDungBaiViet::where('dia_diem_id', $id)->max('thu_tu_noi_dung');

        // Lưu các khối nội dung
        foreach ($validatedData['content_type'] as $index => $type) {
            $contentData = null;
            $contentFile = null;

            // Nếu là văn bản
            if ($type === 'text') {
                $contentData = $validatedData['content_data'][$index];
            }
            // Nếu là hình ảnh, kiểm tra và lưu ảnh
            if ($type === 'image' && isset($request->content_file[$index])) {
                $contentFile = $request->file('content_file')[$index]->store('uploads', 'public');
            }

            // Tăng giá trị `thu_tu_noi_dung`
            $maxThuTu++;

            // Tạo bản ghi cho từng khối nội dung
            NoiDungBaiViet::create([
                'dia_diem_id' => $id,
                'loai_noi_dung' => $type,
                'du_lieu_noi_dung' => $contentData,
                'ten_noi_dung' => $validatedData['content_name'][$index],
                'anh_phu' => $contentFile,
                'thu_tu_noi_dung' => $maxThuTu,
            ]);
        }



        // Trở lại và thông báo thành công
        return redirect()->route('list_noidung')->with('success', 'Dữ liệu đã được lưu thành công.');
    }
}
