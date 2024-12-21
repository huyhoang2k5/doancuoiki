@extends('layouts.admin.index')
@section('content')
    <style>
        .dia_diem {
            background-color: #0dc8d5;
            font-weight: bold;
        }
    </style>
    <div class="container-diadiem">
        <form action="{{ route('edit_diadiem_post', $diadiem->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="TenDD">Tên địa điểm</label>
                <input type="text" id="TenDD" name="TenDD" value="{{ old('TenDD', $diadiem->ten_dia_diem) }}">
            </div>
            <div class="form-group">
                <label for="mota">Mô tả</label>
                <input type="text" id="mota" name="mota" value="{{ old('mota', $diadiem->mo_ta) }}">
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình ảnh</label>
                <input type="file" id="hinhanh" name="hinhanh" class="form-control">
                @error('hinhanh')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($diadiem->hinhanh)
                    <img src="{{ Storage::url($diadiem->hinh_anh) }}" width="100" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="text" id="diachi" name="diachi" value="{{ old('diachi', $diadiem->lien_ket_ban_do) }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
@endsection
