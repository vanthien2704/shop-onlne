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

        $orderCode = floatval(time().$bill->id);

        $data = [
            "orderCode" => $orderCode,
            "amount" => floatval($request->input('tongtien')),
            "description" => "Thanh toan ma don hang $bill->id",
            "returnUrl" => $YOUR_DOMAIN . "/requestpayment",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpayment"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
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

        $orderCode = floatval(time().$orderId);

        $data = [
            "orderCode" => $orderCode,
            "amount" => $bill->total,
            "description" => "Thanh toan ma don hang $orderId",
            "returnUrl" => $YOUR_DOMAIN . "/requestpayment",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpayment"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
    }

    public function requestpayment(Request $request)
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