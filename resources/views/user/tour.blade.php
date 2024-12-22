@extends('layouts.user.tour')

@section('part-in-tour')
    @foreach ($tours as $item)
        <div class="tour-item" data-price="{{ $item->gia }}">
            <img src="{{ asset('storage/' . $item->hinh_anh) }}" alt="{{ $item->ten_tour }}">
            <div class="tour-details">
                <div class="top-row">
                    <span class="icon-location">📍 Khởi hành từ: {{ $item->diem_khoi_hanh }}</span>
                </div>
                <div class="mid-row">
                    <h3>{{ $item->ten_tour }}</h3>
                    <p class="tour-price">{{ number_format($item->gia, 0, '', '.') }}đ</p>
                </div>
                <div class="bottom-row">
                    <a
                        href="@auth {{ route('user.tour.show', $item->ma_tour) }} @else {{ route('guest.tour.show', $item->ma_tour) }} @endauth"><button>Xem
                            chi tiết</button></a>
                </div>
                <div>
                    <span class="icon-clock">⏰ Thời gian:
                        {{ \Carbon\Carbon::parse($item->ngay_bat_dau)->diffInDays(\Carbon\Carbon::parse($item->ngay_ket_thuc)) }}
                        ngày</span>
                </div>
            </div>
        </div>
    @endforeach
@endsection
