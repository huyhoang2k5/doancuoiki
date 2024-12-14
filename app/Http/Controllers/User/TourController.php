<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\dia_diem;
use App\Models\TourDiaDiem;
use App\Models\TourDuLich;
use Illuminate\Http\Request;
class TourController extends Controller
{
    //
    public function index(Request $request, $view = 'user.home')
    {

        $tours = TourDuLich::all(); // Lấy tất cả các tour từ cơ sở dữ liệu
        $location = dia_diem::all();
        $nameTour = TourDuLich::select('ten_tour', 'hinh_anh')->get();

        $nameTour->map(function ($tour) {
            $tour->hinh_anh = asset('storage/' . $tour->hinh_anh);
            return $tour;
        });
        
        if ($request->expectsJson()) {
            return response()->json($nameTour);
        }

        return view($view, compact('tours', 'location')); // Truyền $tours và $taikhoan vào view
    }
    public function show($id)
    {
        $tour = TourDuLich::findOrFail($id);

        if (!$tour) {
            return redirect('/')->with('error', 'Tour không tồn tại!');
        }

        // Lấy danh sách địa điểm kèm hình ảnh
        $diaDiems = $tour->diaDiems()->with([
            'noiDungBaiViet' => function ($query) {
                $query->select('bai_viet_id', 'mo_ta', 'du_lieu_noi_dung')->where('loai_noi_dung', 'image');
            }
        ])->get();


        return view('user.tourShow', compact('tour', 'diaDiems'));
    }
    public function calculateTotal(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $tour = TourDuLich::find($validated['tour_id']);
        $totalPrice = $tour->price * $validated['quantity'];

        return response()->json(['total_price' => $totalPrice]);
    }

}
