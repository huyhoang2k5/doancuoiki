@extends('layouts.admin.index')
@section('content')
    <style>
        .hoa_don {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="duyet">
            <h1>Xét duyệt hóa đơn</h1>
            <div class="buttons">
                <button
                    onclick="window.location='{{ route('thanh_toan', ['trang_thai_thanh_toan' => 'da_thanh_toan']) }}'">Đã
                    thanh
                    toán
                </button>
                <button
                    onclick="window.location='{{ route('thanh_toan', ['trang_thai_thanh_toan' => 'chua_thanh_toan']) }}'">Chưa
                    thanh
                    toán
                </button>



            </div>
        </div>
        <div class="table-container">
            <div class="search">
                <label>Search: <input type="search" /></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Tên Tour</th>
                        <th>Ngày đặt</th>
                        <th>Số người</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datTours as $datTour)
                        <tr>
                            <td>{{ $datTour->ma_dat_tour }}</td>
                            <td>{{ $datTour->user->name }}</td>
                            <td>{{ $datTour->tourDuLich->ten_tour }}</td>
                            <td>{{ \Carbon\Carbon::parse($datTour->ngay_dat)->format('d-m-Y') }}</td>
                            <td>{{ $datTour->so_nguoi }}</td>
                            <td>{{ $datTour->tong_tien }}</td>
                            <td>
                                @if ($datTour->trang_thai_thanh_toan == 'chua_thanh_toan')
                                    Chưa xét duyệt
                                @else
                                    Đã xét duyệt
                                @endif
                            </td>
                            <td class="action-buttons">
                                @if ($datTour->trang_thai_thanh_toan == 'chua_thanh_toan')
                                    <button class="view" data-bill-id="{{ $datTour->ma_dat_tour }}">Duyệt</button>
                                @else
                                @endif
                                <button class="delete" data-bill-id="{{ $datTour->ma_dat_tour }}">Xóa</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Xử lý tìm kiếm
            $('input[type="search"]').on('keyup', function() {
                let query = $(this).val();
                fetchAndUpdateBills(query);
            });

            // Xử lý sự kiện duyệt và xóa bằng event delegation
            $('tbody').on('click', '.view, .delete', function(e) {
                e.preventDefault();

                const billId = $(this).data('bill-id');

                if ($(this).hasClass('view')) {
                    // Xử lý sự kiện duyệt
                    $.ajax({
                        url: `bills/duyet/${billId}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Duyệt hóa đơn thành công!');
                                fetchAndUpdateBills($('input[type="search"]').val());
                            } else {
                                alert('Có lỗi xảy ra khi duyệt hóa đơn!');
                            }
                        },
                        error: function() {
                            alert('Có lỗi xảy ra khi duyệt hóa đơn!');
                        }
                    });

                } else if ($(this).hasClass('delete')) {
                    // Xử lý sự kiện xóa
                    if (confirm('Bạn có chắc chắn muốn xóa?')) {
                        $.ajax({
                            url: `{{ route('delete_bill', '') }}/${billId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Xóa hóa đơn thành công!');
                                    fetchAndUpdateBills($('input[type="search"]').val());
                                } else {
                                    alert('Có lỗi xảy ra khi xóa hóa đơn!');
                                }
                            },
                            error: function() {
                                alert('Có lỗi xảy ra khi xóa hóa đơn!');
                            }
                        });
                    }
                }
            });

            // Hàm fetch và cập nhật dữ liệu hóa đơn
            function fetchAndUpdateBills(query) {
                $.ajax({
                    url: '{{ route('bills.search') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let rows = '';
                        data.forEach(item => {
                            const trangThai = item.trang_thai_thanh_toan === 'chua_thanh_toan' ?
                                'Chưa xét duyệt' : 'Đã xét duyệt';
                            const buttonDuyet = item.trang_thai_thanh_toan ===
                                'chua_thanh_toan' ?
                                `<button class="view" data-bill-id="${item.ma_dat_tour}">Duyệt</button>` :
                                '';

                            rows += `
                        <tr>
                            <td>${item.ma_dat_tour}</td>
                            <td>${item.user.name}</td>
                            <td>${item.tour_du_lich.ten_tour}</td>
                            <td>${new Date(item.ngay_dat).toLocaleDateString('vi-VN')}</td>
                            <td>${item.so_nguoi}</td>
                            <td>${new Intl.NumberFormat().format(item.tong_tien)}</td>
                            <td>${trangThai}</td>
                            <td class="action-buttons">
                                ${buttonDuyet}
                                <button class="delete" data-bill-id="${item.ma_dat_tour}">Xóa</button>
                            </td>
                        </tr>
                    `;
                        });
                        $('tbody').html(rows);
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi:', error);
                        alert('Có lỗi xảy ra khi tải dữ liệu!');
                    }
                });
            }
        });
    </script>
@endsection
