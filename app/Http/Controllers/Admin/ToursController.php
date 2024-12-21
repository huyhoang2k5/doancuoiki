<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourDuLich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToursController extends Controller
{
    public function index()
    {
        $data = TourDuLich::paginate(5)->withQueryString();
        return view('admin.list_tour', compact('data'));
    }

    public function show_add_tour()
    {
        return view('admin.add_tour');
    }

    public function add_tour(Request $request)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'TenTour' => 'required|string|max:255',
            'hinhanh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gia' => 'required|numeric|min:0',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'diem_khoi_hanh' => 'required|string|max:255',
            'gio_khoi_hanh' => 'required',
            'so_nguoi' => 'required|integer|min:1',
            'trang_thai' => 'required|in:con_cho,het_cho,da_huy',
        ]);

        // Tạo bản ghi mới
        $model = new TourDuLich();
        $model->ten_tour = $validatedData['TenTour'];

        $file = $request->file('hinhanh');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $path = $file->storeAs('tour', $fileName, 'public');
        $model->hinh_anh = $path;

        $model->gia = $validatedData['gia'];
        $model->ngay_bat_dau = $validatedData['ngay_bat_dau'];
        $model->ngay_ket_thuc = $validatedData['ngay_ket_thuc'];
        $model->diem_khoi_hanh = $validatedData['diem_khoi_hanh'];
        $model->gio_khoi_hanh = $validatedData['gio_khoi_hanh'];
        $model->so_nguoi = $validatedData['so_nguoi'];
        $model->trang_thai = $validatedData['trang_thai'];
        $model->save();

        // Chuyển hướng hoặc hiển thị thông báo
        return redirect()->route('list_tour')->with('success', 'Dữ liệu đã được lưu thành công.');
    }

    public function update(Request $request, $ma_tour)
    {
        $request->validate([
            'TenTour' => 'required|string|max:255',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gia' => 'required|numeric|min:0',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'diem_khoi_hanh' => 'required|string|max:255',
            'gio_khoi_hanh' => 'required',
            'so_nguoi' => 'required|integer|min:1',
            'trang_thai' => 'required|in:con_cho,het_cho,da_huy',
        ]);

        // Tìm và cập nhật dữ liệu
        $tour = TourDuLich::findOrFail($ma_tour);

        $tour->ten_tour = $request->input('TenTour');
        $tour->gia = $request->input('gia');
        $tour->ngay_bat_dau = $request->input('ngay_bat_dau');
        $tour->ngay_ket_thuc = $request->input('ngay_ket_thuc');
        $tour->diem_khoi_hanh = $request->input('diem_khoi_hanh');
        $tour->gio_khoi_hanh = $request->input('gio_khoi_hanh');
        $tour->so_nguoi = $request->input('so_nguoi');
        $tour->trang_thai = $request->input('trang_thai');

        if ($request->hasFile('hinhanh')) {

            if ($tour->hinh_anh) {
                Storage::disk('public')->delete($tour->hinh_anh);
            }

            $file = $request->file('hinhanh');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('tour', $fileName, 'public');
            $tour->hinh_anh = $path;
        }

        $tour->save();

        return redirect()->route('list_tour')->with('success', 'Cập nhật thành công!');
    }


    public function edit($ma_tour)
    {
        $tour = TourDuLich::findOrFail($ma_tour);
        return view('admin.edit_tour', compact('tour'));
    }

    public function delete_tour($ma_tour)
    {
        try {
            $tour = TourDuLich::findOrFail($ma_tour);
            if ($tour->hinh_anh) {
                Storage::disk('public')->delete($tour->hinh_anh);
            }
            $tour->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
        return redirect()->route('list_tour')->with('success', 'Tour đã được xóa thành công!');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');


        $data = TourDuLich::where('ma_tour', 'LIKE', "%{$query}%")
            ->orWhere('ten_tour', 'LIKE', "%{$query}%")
            ->orWhere('gia', 'LIKE', "%{$query}%")
            ->get();


        return response()->json($data);
    }
}
