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

        Apply::create([
            'user_id' => Auth::id(),
            'name' => $request->input('hoten'),
            'email' => $request->input('email'),
            'phone' => $request->input('sdt'),
            'content' => $request->input('ghichu'),
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Thông tin của bạn đã được gửi thành công!');
    }
}
