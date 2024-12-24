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
        $bill = new Bill();
        $bill->user_id = Auth::id();
        $bill->name = $request->input('hoten');
        $bill->address = $request->input('diachi');
        $bill->phone = $request->input('dienthoai');
        $bill->email = $request->input('email');
        $bill->order_date = now();
        $bill->total = $request->input('tongtien');
        $bill->status = '0';
        $bill->save();

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $product) {
            $cartItem = new Cart();
            $cartItem->bill_id = $bill->id;
            $cartItem->product_id = $key;
            $cartItem->quantity = $product['quantity'];
            $cartItem->unit_price = $product['unit_price'];
            $cartItem->total_price = $product['total_price'];
            $cartItem->save();
        }

        session()->forget('cart');

        $payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_SECRET"),
            env("PAYOS_API_KEY")
        );
        $YOUR_DOMAIN = env("APP_URL");

        $data = [
            "orderCode" => $bill->id,
            "amount" => floatval($request->input('tongtien')),
            "description" => "Thanh toán mã đơn hàng $bill->id",
            "returnUrl" => $YOUR_DOMAIN . "/requestpayment",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpayment"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
    }

    public function requestpayment(Request $request)
    {
        if ($request->input('status') == 'PAID') {

            Bill::where('id', $request->input('orderCode'))->update(['status' => 1]);

            return redirect('/orders')->with('success', 'Đặt hàng thành công!');
        }elseif ($request->input('cancel')) {
            return redirect('/orders')->with('error', 'Đã hủy thanh toán!');
        }else{
            return redirect('/cart')->with('error', 'Đặt hàng không thành công!');
        }
    }

    public function paynow(Request $request)
    {
        $orderId = $request->input('id');
        $bill = Bill::where('id', $orderId)->first();

        $payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_SECRET"),
            env("PAYOS_API_KEY")
        );
        $YOUR_DOMAIN = env("APP_URL");

        $data = [
            "orderCode" => floatval(time().$orderId),
            "amount" => $bill->total,
            "description" => "Thanh toán mã đơn hàng $orderId",
            "returnUrl" => $YOUR_DOMAIN . "/requestpaymentnow",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpaymentnow"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
    }

    public function requestpaymentnow(Request $request)
    {
        if ($request->input('status') == 'PAID') {

            $orderId = $request->input('orderCode');
            $id = substr($orderId, -2);

            Bill::where('id', $id)->update(['status' => 1]);

            return redirect('/orders')->with('success', 'Đặt hàng thành công!');
        }elseif ($request->input('cancel')) {
            return redirect('/orders')->with('error', 'Đã hủy thanh toán!');
        }else{
            return redirect('/cart')->with('error', 'Đặt hàng không thành công!');
        }
    }
}