<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập trước.');
        }

        // Lấy thông tin người dùng
        $user = auth()->user();

        if (!$user->is_admin) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang quản trị.');
        }

        // Lưu thông tin vào session nếu chưa có
        if (!session()->has('user_id')) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'is_admin' => $user->is_admin,
            ]);
        }

        // Kiểm tra quyền truy cập
        if ($request->is('admin/*') && !session('is_admin')) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang quản trị.');
        }

        if ($request->is('user/*') && session('is_admin')) {
            return redirect('/admin')->with('error', 'Bạn không có quyền truy cập trang người dùng.');
        }

        // Cho phép tiếp tục nếu thỏa mãn quyền
        return $next($request);
    }
}
