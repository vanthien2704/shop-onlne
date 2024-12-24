<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

abstract class Controller
{
    //
    public function contact()
    {
        return view('user.contact');
    }

    public function writecontact(Request $request) {

        Contact::create([
            'fullname' => $request->input('hoten'),
            'email' => $request->input('email'),
            'phone' => $request->input('sdt'),
            'note' => $request->input('ghichu'),
        ]);

        return redirect()->back()->with('success', 'Thông tin của bạn đã được gửi thành công!');
    }
}
