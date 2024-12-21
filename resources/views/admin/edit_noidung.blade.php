@extends('layouts.admin.index')
@section('content')
    <style>
        .dia_diem {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <!-- Form thêm nội dung mới -->
    <div class="container-diadiem">
        <form action="{{ route('add_diadiem_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Khối nội dung</h1>
            <div id="content-blocks">
                @foreach ($noiDungs as $noiDung)
                    <div class="content-block">
                        <select name="content_type[]" onchange="toggleContentType(this)"
                            style="margin-bottom: 10px; padding: 5px; border-radius: 5px;">
                            @if ($noiDung->loai_noi_dung == 'text')
                                <option value="{{ old('content_type[]', $noiDung->loai_noi_dung) }}">Văn bản</option>
                            @endif
                            <option value="{{ old('content_type[]', $noiDung->loai_noi_dung) }}">Hình ảnh</option>
                        </select>
                        <textarea id="description" name="content_data[]" cols="75" rows="10"
                            style="margin-bottom: 10px; border-radius: 5px;" required>{{ old('content_data[]', $noiDung->du_lieu_noi_dung) }}</textarea>
                        <input type="file" name="content_file[]"
                            style="display: none; margin-bottom: 10px; padding: 5px; border-radius: 5px;">
                        <input type="text" name="content_name[]"
                            style="margin-bottom: 10px; padding: 5px; border-radius: 5px;"
                            value="{{ old('content_name[]', $noiDung->ten_noi_dung) }}" required>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn" onclick="addContentBlock()" style="background-color: #47d6f6">Thêm
                khối
                nội dung</button>
            <div class="form-group">
                <button type="submit" class="btn">Create</button>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
    <script>
        // Hàm ẩn/hiển thị các trường và quản lý thuộc tính required
        function toggleContentType(selectElement) {
            const contentBlock = selectElement.closest('.content-block');
            const contentType = selectElement.value;

            const textarea = contentBlock.querySelector('textarea');
            const fileInput = contentBlock.querySelector('input[type="file"]');

            if (contentType === 'text') {
                // Hiển thị textarea, ẩn input file
                textarea.style.display = 'block';
                textarea.setAttribute('required', 'true'); // Đặt required cho textarea
                fileInput.style.display = 'none';
                fileInput.removeAttribute('required'); // Xóa required khỏi file input
            } else if (contentType === 'image') {
                // Hiển thị input file, ẩn textarea
                textarea.style.display = 'none';
                textarea.removeAttribute('required'); // Xóa required khỏi textarea
                fileInput.style.display = 'block';

            }
        }

        // Hàm thêm khối nội dung mới
        function addContentBlock() {
            const container = document.getElementById('content-blocks');

            const uniqueId = `content-${Date.now()}`; // Tạo ID duy nhất cho textarea
            const block = `
        <div class="content-block" style="margin-bottom: 15px;">
            <select name="content_type[]" onchange="toggleContentType(this)"
                style="margin-bottom: 10px; padding: 5px; border-radius: 5px;">
                <option value="text">Văn bản</option>
                <option value="image">Hình ảnh</option>
            </select>
            <textarea name="content_data[]" cols="75" rows="10" placeholder="Nhập nội dung"
                style="margin-bottom: 10px; border-radius: 5px;"></textarea>
            <input type="file" name="content_file[]" style="display: none; margin-bottom: 10px; padding: 5px; border-radius: 5px;">
            <input type="text" name="content_name[]"
                placeholder="Tên khối nội dung (hoặc chú thích)" style="margin-bottom: 10px; padding: 5px; border-radius: 5px;" required>
        </div>
    `;
            container.insertAdjacentHTML('beforeend', block);

            // Thiết lập trạng thái ban đầu cho khối vừa thêm
            const newBlock = container.lastElementChild;
            const select = newBlock.querySelector('select[name="content_type[]"]');
            toggleContentType(select);
        }

        // Chạy hàm toggle khi trang được tải lần đầu để thiết lập trạng thái ban đầu
        document.addEventListener("DOMContentLoaded", function() {
            const selects = document.querySelectorAll("select[name='content_type[]']");
            selects.forEach(select => toggleContentType(select));
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@endsection
