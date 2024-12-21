@extends('layouts.admin.index')
@section('content')
    <style>
        .tour {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="duyet">
            <h1>Quản lý Tour</h1>
        </div>
        <button class="btn-add" onclick="window.location='{{ route('add_tour') }}'">Thêm mới</button>
        <div class="table-container">
            <div class="search">
                <label>Search: <input type="search" /></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên tour</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Điểm khởi hành</th>
                        <th>Giờ khởi hành</th>
                        <th>Số người</th>
                        <th>Trạng thái</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->ma_tour }}</td>
                            <td>{{ $item->ten_tour }}</td>
                            <td><img src="{{ asset('storage/' . $item->hinh_anh) }}" alt="Tour Image" style="width:40px"></td>
                            <td>{{ number_format($item->gia, 0, '', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->ngay_bat_dau)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->ngay_ket_thuc)->format('d-m-Y') }}</td>
                            <td>{{ $item->diem_khoi_hanh }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->gio_khoi_hanh)->format('H:i') }}</td>

                            <td>{{ $item->so_nguoi }}</td>
                            <td>
                                @if ($item->trang_thai == 'con_cho')
                                    Còn vé
                                @else
                                    Hết vé
                                @endif
                            </td>
                            <td class="action-buttons">
                                <button class="view" data-tour-id="{{ $item->ma_tour }}">Sửa</button>
                                <button class="delete" data-tour-id="{{ $item->ma_tour }}">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $data->links('vendor.pagination.custom') }}
            </div>
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
                fetchAndUpdateTours(query);
            });

            // Xử lý sự kiện sửa và xóa bằng event delegation
            $('tbody').on('click', '.view, .delete', function(e) {
                e.preventDefault();

                if ($(this).hasClass('view')) {
                    // Xử lý sự kiện sửa
                    const tourId = $(this).data('tour-id');
                    window.location.href = `{{ route('edit_tour', '') }}/${tourId}`;

                } else if ($(this).hasClass('delete')) {
                    // Xử lý sự kiện xóa
                    const tourId = $(this).data('tour-id');

                    if (confirm('Bạn có chắc chắn muốn xóa?')) {
                        $.ajax({
                            url: `{{ route('delete_tour', '') }}/${tourId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Xóa tour thành công!');
                                    fetchAndUpdateTours($('input[type="search"]').val());
                                } else {
                                    alert('Có lỗi xảy ra khi xóa tour!');
                                }
                            },
                            error: function() {
                                alert('Có lỗi xảy ra khi xóa tour!');
                            }
                        });
                    }
                }
            });

            // Hàm fetch và cập nhật dữ liệu tours
            function fetchAndUpdateTours(query) {
                $.ajax({
                    url: '{{ route('search_tours') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let rows = '';
                        data.forEach(item => {
                            const trangThai = item.trang_thai === 'con_cho' ? 'Còn vé' :
                                'Hết vé';
                            rows += `
                        <tr>
                            <td>${item.ma_tour}</td>
                            <td>${item.ten_tour}</td>
                            <td><img src="/storage/${item.hinh_anh}" alt="Tour Image" style="width:40px"></td>
                            <td>${new Intl.NumberFormat().format(item.gia)}</td>
                            <td>${new Date(item.ngay_bat_dau).toLocaleDateString('vi-VN')}</td>
                            <td>${new Date(item.ngay_ket_thuc).toLocaleDateString('vi-VN')}</td>
                            <td>${item.diem_khoi_hanh}</td>
                            <td>${item.gio_khoi_hanh.slice(0,5)}</td>
                            <td>${item.so_nguoi}</td>
                            <td>${trangThai}</td>
                            <td class="action-buttons">
                                <button class="view" data-tour-id="${item.ma_tour}">Sửa</button>
                                <button class="delete" data-tour-id="${item.ma_tour}">Xóa</button>
                            </td>
                        </tr>
                    `;
                        });
                        $('tbody').html(rows);
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi tải dữ liệu!');
                    }
                });
            }
        });
    </script>
@endsection
