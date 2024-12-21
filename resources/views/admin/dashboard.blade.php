@extends('layouts.admin.index')
@section('content')
    <style>
        .trang_chu {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container" style="height: 520px">
        <div class="duyet">
            <h1>Thống Kê</h1>
        </div>
        <div class="stats">
            <div class="stat-card">
                <div class="details">
                    <h3>DOANH THU</h3>
                    <p>{{ number_format($doanhThu, 0, ',', '.') }} VNĐ</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="details">
                    <h3>KHÁCH HÀNG</h3>
                    <p>{{ $khachHang }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="details">
                    <h3>ĐỊA ĐIỂM</h3>
                    <p>{{ $diaDiem }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-search-location"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="details">
                    <h3>TOUR</h3>
                    <p>{{ $tour }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-location-arrow"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="details">
                    <h3>HÓA ĐƠN</h3>
                    <p>{{ $hoaDon }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="details">
                    <h3>SỐ LƯỢNG NỘI DUNG</h3>
                    <p>{{ $baiViet }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>
@endsection






