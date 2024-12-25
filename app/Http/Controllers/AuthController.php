<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        // Kiểm tra dữ liệu đầu vào trực tiếp
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $validated['username'])->first();


        // Đăng nhập với dữ liệu từ request
        if ($user && Hash::check($validated['password'], $user->password)) {
            if ($user->enable != 1) {
                return redirect()->back()->with('error', 'Tài khoản chưa được kích hoạt!');
            }
            Auth::login($user);
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng!');
    }

    public function register(Request $request) {
        // Kiểm tra dữ liệu đầu vào trực tiếp
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:3',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email',
            'address' => 'required|string|max:255',
        ]);

        User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
        ]);

        return redirect('/login')->with('success', 'Đăng ký thành công!');
    }

    public function logout()
    {
        // Đăng xuất người dùng
        Auth::logout();
    
        // Xóa tất cả session
        session()->invalidate();
    
        // Tạo lại session ID mới để bảo mật
        session()->regenerateToken();
    
        // Chuyển hướng về trang đăng nhập
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }
}
