<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use PayOS\PayOS;


class PayController extends Controller
{
    public function createPaymentLink(Request $request)
    {
        $info = [
            'name' => $request->input('hoten'),
            'address' => $request->input('diachi'),
            'phone' => $request->input('dienthoai'),
            'email' => $request->input('email'),
            'total' => $request->input('tongtien'),
        ];

        session()->put('info', $info);

        $payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_SECRET"),
            env("PAYOS_API_KEY")
        );
        $YOUR_DOMAIN = env("APP_URL");

        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => floatval($request->input('tongtien')),
            "description" => "Thanh toán đơn hàng",
            "returnUrl" => $YOUR_DOMAIN . "/requestpayment",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpayment"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
    }

    public function requestpayment(Request $request)
    {
        if ($request->has('status') == 'PAID') {
            
            $info = session()->get('info', []);
            $cart = session()->get('cart', []);

            $bill = new Bill();
            $bill->id_payment = $request->has('orderCode');
            $bill->user_id = Auth::id();
            $bill->name = $info['name'];
            $bill->address = $info['address'];
            $bill->phone = $info['phone'];
            $bill->email = $info['email'];
            $bill->order_date = now();
            $bill->total = $info['total'];
            $bill->status = '1';
            $bill->save();

            // Lưu chi tiết giỏ hàng vào bảng Cart
            foreach ($cart as $key => $product) {
                $cartItem = new Cart();
                $cartItem->bill_id = $bill->id;
                $cartItem->product_id = $key;
                $cartItem->quantity = $product['quantity'];
                $cartItem->unit_price = $product['unit_price'];
                $cartItem->total_price = $product['total_price'];
                $cartItem->save();
            }

            session()->forget('info');
            session()->forget('cart');

            return redirect('/orders')->with('success', 'Đặt hàng thành công!');
        }elseif ($request->has('cancel')) {
            return redirect('/cart')->with('error', 'Đã hủy thanh toán!');
        }else{
            return redirect('/cart')->with('error', 'Đặt hàng không thành công!');
        }
    }
}