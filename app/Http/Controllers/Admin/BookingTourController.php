<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dat_tour;
use Illuminate\Http\Request;

class BookingTourController extends Controller
{
    //
    public function index()
    {
        $datTours = dat_tour::with(['user', 'tourDuLich'])->get();
        return view('admin.list_booking', compact('datTours'));
    }

    public function delete_bill($ma_dat_tour)
    {
        try {
            $datTour = dat_tour::findOrFail($ma_dat_tour);
            $datTour->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
        return redirect()->route('list_booking')->with('success', 'Hóa đơn đã được xóa thành công!');
    }
    public function thanh_toan(Request $request)
    {


        $trangThai = $request->input('trang_thai_thanh_toan');


        $query = dat_tour::with(['user', 'tourDuLich']);
        if ($trangThai !== null) {
            $query->where('trang_thai_thanh_toan', $trangThai);
        }


        $datTours = $query->get();


        return view('admin.list_booking', compact('datTours', 'trangThai'));
    }


    public function duyet($ma_dat_tour)
    {
        try {
            $duyet = dat_tour::findOrFail($ma_dat_tour);
            $duyet->trang_thai_thanh_toan = 'da_thanh_toan';
            $duyet->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
        return redirect()->route('list_booking')
            ->with('success', 'Hóa đơn đã được duyệt!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $data = dat_tour::with(['user', 'tourDuLich']) // Eager load quan hệ để trả về đầy đủ dữ liệu
            ->where('ma_dat_tour', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('tourDuLich', function ($queryBuilder) use ($query) {
                $queryBuilder->where('ten_tour', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($data);
    }
}
