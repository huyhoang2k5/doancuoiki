<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\NoiDungBaiViet;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\dat_tour;
use App\Models\dia_diem;
use App\Models\TourDuLich;

class HomeController extends Controller
{
    //
    public function index()
    {
        // $khachHang = User::where('ma_quyen', '!=', 1)->count();


        $khachHang = User::count();
        $doanhThu = dat_tour::sum('tong_tien');
        $diaDiem = dia_diem::count();
        $tour = TourDuLich::count();
        $hoaDon = dat_tour::count();
        $baiViet = NoiDungBaiViet::count();


        return view('Admin.dashboard', compact('doanhThu', 'khachHang', 'diaDiem', 'tour', 'hoaDon', 'baiViet'));
    }



}
