@extends('layouts.admin.index')
@section('content')
    <style>
        .tai_khoan {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container_list_location">
        <div class="duyet">
            <h1>Quản lý Tài khoản</h1>
        </div>
        <button class="btn-add" onclick="window.location='{{ route('list_taikhoan') }}'">Thêm mới</button>
        <div class="table-container">
            <div class="search">
                <label>Search: <input type="search" /></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Vai trò</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @if ($item->is_admin === true)
                                    Admin
                                @elseif ($item->is_admin === false)
                                    User
                                @else
                                    Dữ liệu lỗi
                                @endif
                            </td>
                            <td style="display: flex; gap: 10px;">
                                <button class="btn-action btn-edit"
                                    onclick="window.location='{{ route('edit_taikhoan', ['id' => $item->id]) }}'">Sửa</button>
                                <form action="{{ route('delete_account', $item->id) }}" method="POST">
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
                fetchAndUpdateAccounts(query);
            });

            // Xử lý sự kiện sửa và xóa bằng event delegation
            $('tbody').on('click', '.view, .delete', function(e) {
                e.preventDefault();

                if ($(this).hasClass('view')) {
                    // Xử lý sự kiện sửa
                    const accountId = $(this).data('account-id');
                    window.location.href = `{{ route('edit_taikhoan', '') }}/${accountId}`;;

                } else if ($(this).hasClass('delete')) {
                    // Xử lý sự kiện xóa
                    const accountId = $(this).data('account-id');

                    if (confirm('Bạn có chắc chắn muốn xóa?')) {
                        $.ajax({
                            url: `{{ route('delete_account', '') }}/${accountId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Xóa tài khoản thành công!');
                                    fetchAndUpdateAccounts($('input[type="search"]').val());
                                } else {
                                    alert('Có lỗi xảy ra khi xóa tài khoản!');
                                }
                            },
                            error: function() {
                                alert('Có lỗi xảy ra khi xóa tài khoản!');
                            }
                        });
                    }
                }
            });

            // Hàm fetch và cập nhật dữ liệu tài khoản
            function fetchAndUpdateAccounts(query) {
                $.ajax({
                    url: '{{ route('search_accounts') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let rows = '';
                        data.forEach(item => {
                            let userRole = item.is_admin == 1 ? 'Admin' :
                                item.is_admin == 0 ? 'User' : 'Dữ liệu lỗi';

                            rows += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.name}</td>
                            <td>${item.email}</td>
                            <td>${item.phone}</td>
                            <td>${userRole}</td>
                            <td class="action-buttons">
                                <button class="view" data-account-id="${item.id}">Sửa</button>
                                <button class="delete" data-account-id="${item.id}">Xóa</button>
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
