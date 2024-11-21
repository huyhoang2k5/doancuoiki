@extends('layouts.admin.index')
@section('content')
<style>
    .tai_khoan {
        background-color: #0dc8d5;
        font-weight: bold;
    }
</style>
<div class="form-container">
    <form action="{{ route('edit_taikhoan_post', $taikhoan->id) }}" method="POST">
        @csrf
        @method('PUT')

    <div class="form-group">
        <label for="username">Tên Tài Khoản</label>
        <input type="text" id="username" name="TenTK"  value="{{ old('TenTK', $taikhoan->name) }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="Email"  value="{{ old('Email', $taikhoan->email) }}">
    </div>
    {{-- <div class="form-group">
        <label for="username">Số Điện Thoại</label>
        <input type="text" id="phone" name="SDT"  value="{{ old('phone', $taikhoan->ten_dia_diem) }}">
    </div> --}}
    <div class="form-group">
        <label for="password">Mật Khẩu</label>
        <input type="text" id="password" name="Pass">
    </div>
    {{-- <div class="form-group">
        <label for="role">Mã quyền</label>
        <select id="role">
            <option>Quản trị viên</option>
        </select>
    </div> --}}
    <div class="form-group">
        <button type="submit" class="btn">Update</button>
    </div>
    </form>
</div>
@endsection
