<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dia_diem;
use App\Models\NoiDungBaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LocationsController extends Controller
{
    public function index()
    {
        $data = dia_diem::paginate(5)->withQueryString();
        return view('admin.list_diadiem', compact('data'));
    }

    public function show_add_diadiem()
    {
        return view('admin.add_diadiem');
    }

    public function add_diadiem(Request $request)
    {
        $validatedData = $request->validate([
            'TenDD' => 'required|string|max:255',
            'diachi' => 'required|string',
            'hinhanh' => 'required|string|max:255',
            'mota' => 'required|string|max:255',
        ]);



        $model = new dia_diem();
        $model->ten_dia_diem = $validatedData['TenDD'];
        $model->lien_ket_ban_do = $validatedData['diachi'];
        $model->duong_dan_anh = $validatedData['hinhanh'];
        $model->mo_ta = $validatedData['mota'];
        $model->save();
        return redirect()->route('list_diadiem')->with('success', 'Dữ liệu đã được lưu thành công.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'TenDD' => 'max:255',
            'mota' => 'max:255',
            'hinhanh' => 'max:255',
            'diachi' => 'max:500',
        ]);

        // Tìm và cập nhật dữ liệu
        $diadiem = dia_diem::findOrFail($id);
        $diadiem->ten_dia_diem = $request->input('TenDD');
        $diadiem->mo_ta = $request->input('mota');
        if ($request->hasFile('hinhanh')) {

            if ($diadiem->hinh_anh) {
                Storage::disk('public')->delete($diadiem->hinh_anh);
            }

            $file = $request->file('hinhanh');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('diadiem', $fileName, 'public');
            $diadiem->hinh_anh = $path;
        }
        $diadiem->lien_ket_ban_do = $request->input('diachi');
        $diadiem->save();

        return redirect()->route('list_diadiem')->with('success', 'Cập nhật thành công!');
    }



    public function edit($id)
    {
        $diadiem = dia_diem::findOrFail($id);
        return view('admin.edit_diadiem', compact('diadiem'));
    }

    public function delete_locations($id)
    {
        $location = dia_diem::findOrFail($id);

        // Xóa ảnh nếu có
        if ($location->hinh_anh) {
            Storage::disk('public')->delete($location->hinh_anh);
        }

        // Xóa dữ liệu
        $location->delete();

        // Trả về thông báo thành công
        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'TenDD' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'hinhanh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mota' => 'required|string|max:1000',
            'content_type' => 'required|array',
            'content_name' => 'required|array',
            'content_data' => 'required|array',
            'content_file.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Lưu hình ảnh chính
        $coverImagePath = $request->file('hinhanh')->store('uploads', 'public');


        // Tạo địa điểm mới
        $model = new dia_diem();
        $model->ten_dia_diem = $validatedData['TenDD'];
        $model->lien_ket_ban_do = $validatedData['diachi'];
        $model->hinh_anh = $coverImagePath;
        $model->mo_ta = $validatedData['mota'];
        $model->save(); // Lưu địa điểm vào cơ sở dữ liệu


        // Lấy id của địa điểm mới tạo
        $diaDiemId = $model->id; // Đây là cách lấy ID của địa điểm mới


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
                // Lưu file hình ảnh phụ nếu có
                $contentFile = $request->file('content_file')[$index]->store('uploads', 'public');
            }


            // Tạo bản ghi cho từng khối nội dung
            NoiDungBaiViet::create([
                'dia_diem_id' => $diaDiemId, // Gắn kết với địa điểm
                'loai_noi_dung' => $type, // Kiểu nội dung (text hoặc image)
                'du_lieu_noi_dung' => $contentData, // Dữ liệu nội dung (văn bản)
                'ten_noi_dung' => $validatedData['content_name'][$index], // Tên hoặc chú thích
                'anh_phu' => $contentFile, // Hình ảnh phụ (nếu có)
                'thu_tu_noi_dung' => $index, // Thứ tự của khối nội dung
            ]);
        }


        // Trở lại và thông báo thành công
        return redirect()->route('list_diadiem')->with('success', 'Dữ liệu đã được lưu thành công.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $data = dia_diem::where('id', 'LIKE', "%{$query}%")
            ->orWhere('ten_dia_diem', 'LIKE', "%{$query}%")
            ->get();


        return response()->json($data);
    }
}
