<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apply;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function supplier()
    {
        return view('supplier.apply');
    }
    public function dkapply(Request $request) {
        if (Apply::where('user_id', Auth::id())->exists()) {
           return redirect()->back()->with('error', 'Bạn đã nộp đơn trước đó!');
        }
        Apply::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'content' => $request->input('content'),
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Bạn đã đăng ký thành công! Vui lòng đợi phê duyệt.');
    }
}
