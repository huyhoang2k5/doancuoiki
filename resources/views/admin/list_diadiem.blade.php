@extends('layouts.admin.index')
@section('content')
    <style>
        .dia_diem {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container_list_location">
        <div class="duyet">
            <h1>Quản lý địa điểm</h1>
        </div>
        <button class="btn-add" onclick="window.location='{{ route('add_diadiem') }}'">Thêm mới</button>
        <div class="table-container">
            <div class="search">
                <label>Search: <input type="search" /></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mã Địa điểm</th>
                        <th>Tên Địa điểm</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Địa chỉ</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->ten_dia_diem }}</td>
                            <td>{{ Str::limit($item->mo_ta, 50) }}</td>
                            <td><img src="{{ asset('storage/' . $item->hinh_anh) }}" alt="Tour Image" style="width:40px"></td>
                            <td>{{ Str::limit($item->lien_ket_ban_do, 30) }}</td>
                            <td style="display: flex; gap: 10px;">
                                <!-- Nút Sửa -->
                                <button class="btn-action btn-edit" data-id="{{ $item->id }}">Sửa</button>
                                <!-- Nút Xóa -->
                                <button class="btn-action btn-delete" data-id="{{ $item->id }}">Xóa</button>

                            </td>
                        </tr>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Xử lý tìm kiếm
            $('input[type="search"]').on('keyup', function() {
                loadLocations(); // Gọi hàm loadLocations khi người dùng nhập vào ô tìm kiếm
            });

            // Xử lý sự kiện "Sửa"
            $(document).on('click', '.btn-edit', function() {
                let locationId = $(this).data('id');
                window.location.href = `/admin/edit_location/${locationId}`; // Đảm bảo đường dẫn chính xác
            });

            // Xử lý sự kiện "Xóa"
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault(); // Ngừng hành động mặc định của button
                let locationId = $(this).data('id'); // Lấy ID của địa điểm

                if (confirm('Bạn có chắc chắn muốn xóa?')) {
                    $.ajax({
                        url: `/admin/delete_locations/${locationId}`, // Đảm bảo đường dẫn chính xác
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Xóa địa điểm thành công!');

                                // Loại bỏ dòng tương ứng khỏi bảng
                                $(`tr[data-id="${locationId}"]`).remove();

                                // Gọi loadLocations để tải lại dữ liệu bảng
                                loadLocations();
                            } else {
                                alert('Có lỗi xảy ra khi xóa địa điểm!');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Có lỗi xảy ra khi xóa!');
                        }
                    });
                }
            });

            function loadLocations() {
                let query = $('input[type="search"]').val(); // Lấy giá trị tìm kiếm từ ô input

                $.ajax({
                    url: '{{ route('search_locations') }}', // URL của route tìm kiếm
                    type: 'GET',
                    data: {
                        query: query // Truyền từ khóa tìm kiếm
                    },
                    success: function(data) {
                        let rows = '';

                        // Kiểm tra nếu có dữ liệu trả về
                        if (data.length === 0) {
                            rows = `<tr><td colspan="6">Không có địa điểm nào được tìm thấy.</td></tr>`;
                        } else {
                            // Tạo lại các hàng trong bảng với dữ liệu trả về
                            data.forEach(item => {
                                let mo_ta_limited = item.mo_ta && item.mo_ta.length > 50 ? item
                                    .mo_ta.substring(0, 50) + '...' : item.mo_ta;
                                let lien_ket_ban_do_limited = item.lien_ket_ban_do && item
                                    .lien_ket_ban_do.length > 50 ? item.lien_ket_ban_do
                                    .substring(0, 50) + '...' : item.lien_ket_ban_do;

                                // Xây dựng từng dòng cho bảng
                                rows += `
                            <tr data-id="${item.id}">
                                <td>${item.id}</td>
                                <td>${item.ten_dia_diem}</td>
                                <td>${mo_ta_limited}</td>
                                <td><img src="{{ asset('storage') }}/${item.hinh_anh}" alt="Tour Image" style="width:40px"></td>
                                <td>${lien_ket_ban_do_limited}</td>
                                <td class="action-buttons">
                                    <button class="btn-edit" data-id="${item.id}">Sửa</button>
                                    <button class="btn-delete" data-id="${item.id}">Xóa</button>
                                </td>
                            </tr>
                        `;
                            });
                        }

                        // Cập nhật lại nội dung bảng với các dòng mới (hoặc thông báo không tìm thấy)
                        $('tbody').html(rows);
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra khi tải lại dữ liệu:', error);
                        alert('Có lỗi xảy ra khi tải lại dữ liệu.');
                    }
                });
            }
        });
    </script>
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
