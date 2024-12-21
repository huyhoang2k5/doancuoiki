@extends('layouts.admin.index')
@section('content')
    <style>
        .noi_dung {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container_list_location">
        <div class="duyet">
            <h1>Quản lý Nội Dung</h1>
        </div>
        <div class="table-container">
            <div class="search">
                <label>Search: <input type="search" /></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Địa điểm</th>
                        <th>Loại Nội Dung</th>
                        <th>Dữ Liệu Nội Dung</th>
                        <th>Tên Nội Dung</th>
                        <th>Ảnh</th>
                        <th>Thứ Tự</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noiDungBaiViet as $item)
                        <tr>
                            <td>{{ $item->bai_viet_id }}</td>
                            <td>{{ $item->dia_diem_id }}</td>
                            <td>
                                @if ($item->loai_noi_dung == 'text')
                                    Văn bản
                                @else
                                    Hình ảnh
                                @endif
                            </td>
                            <td>{{ Str::limit($item->du_lieu_noi_dung, 40) }}</td>
                            <td>{{ Str::limit($item->ten_noi_dung, 30) }}</td>
                            <td>
                                @if (!empty($item->anh_phu))
                                    <img src="{{ asset('storage/' . $item->anh_phu) }}" alt="Blog Image" style="width:40px">
                                @else
                                @endif
                            </td>
                            <td>{{ $item->thu_tu_noi_dung }}</td>
                            <td style="display: flex; gap: 10px;">
                                <button class="btn-action btn-edit"
                                    onclick="window.location='{{ route('edit_noidung', ['id' => $item->dia_diem_id]) }}'">Thêm</button>
                                <form action="{{ route('delete_noidung', $item->bai_viet_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete" type="submit"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('input[type="search"]').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: '{{ route('search_noidung') }}', // Đảm bảo route này trả về dữ liệu dưới dạng JSON
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let rows = '';
                        // Tạo lại hàng của bảng dựa trên dữ liệu nhận được
                        data.forEach(item => {
                            // Kiểm tra các giá trị có phải null hay không trước khi sử dụng .length
                            let du_lieu_noi_dung_limited = item.du_lieu_noi_dung && item
                                .du_lieu_noi_dung.length > 40 ? item.du_lieu_noi_dung
                                .substring(0, 40) + '...' : item.du_lieu_noi_dung || '';
                            let ten_noi_dung_limited = item.ten_noi_dung && item
                                .ten_noi_dung.length > 30 ? item.ten_noi_dung.substring(
                                    0, 30) + '...' : item.ten_noi_dung || '';

                            // Kiểm tra xem ảnh phụ có tồn tại
                            let anh_phu = item.anh_phu ?
                                `<img src="{{ asset('storage') }}/${item.anh_phu}" alt="Blog Image" style="width:40px">` :
                                '';

                            rows += `
                        <tr>
                            <td>${item.bai_viet_id}</td>
                            <td>${item.dia_diem_id}</td>
                            <td>${item.loai_noi_dung == 'text' ? 'Văn bản' : 'Hình ảnh'}</td>
                            <td>${du_lieu_noi_dung_limited}</td>
                            <td>${ten_noi_dung_limited}</td>
                            <td>${anh_phu}</td>
                            <td>${item.thu_tu_noi_dung}</td>
                            <td class="action-buttons" style="display: flex; gap: 10px;">
                                <button class="btn-action btn-edit" onclick="window.location='{{ url('edit_noidung') }}/${item.dia_diem_id}'">Thêm</button>
                                <form action="/delete_noidung/${item.bai_viet_id}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    `;
                        });

                        // Cập nhật lại nội dung bảng với các dòng tìm kiếm mới
                        $('tbody').html(rows);
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra:', error);
                    }
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@endsection
