<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PayOS\PayOS;


class PayController extends Controller
{
    public function payment(Request $request)
    {
        $bill = new Order();
        $bill->user_id = Auth::id();
        $bill->name = $request->input('hoten');
        $bill->address = $request->input('diachi');
        $bill->phone = $request->input('dienthoai');
        $bill->email = $request->input('email');
        $bill->order_date = now();
        $bill->total = $request->input('tongtien');
        $bill->payment = $request->input('payment');
        $bill->save();

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $product) {
            $cartItem = new OrderDetail();
            $cartItem->order_id = $bill->id;
            $cartItem->product_id = $key;
            $cartItem->quantity = $product['quantity'];
            $cartItem->unit_price = $product['unit_price'];
            $cartItem->total_price = $product['total_price'];
            $cartItem->save();
        }

        session()->forget('cart');

        if ($request->input('payment') == 1)
        {
            return $this->createPaymentLink($bill);
        }

        return redirect('/orders')->with('success', 'Đặt hàng thành công!');
    }
    public function createPaymentLink($request)
    {
        $payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_SECRET"),
            env("PAYOS_API_KEY")
        );
        $YOUR_DOMAIN = env("APP_URL");

        $orderCode = floatval(time().$request->id);

        $data = [
            "orderCode" => $orderCode,
            "amount" => floatval($request->total),
            "description" => "Thanh toan ma don hang $request->id",
            "returnUrl" => $YOUR_DOMAIN . "/requestpayment",
            "cancelUrl" => $YOUR_DOMAIN . "/requestpayment"
        ];

        $response = $payOS->createPaymentLink($data);

        return redirect($response['checkoutUrl']);
    }

    public function requestpayment(Request $request)
    {
        $orderId = $request->input('orderCode');
        $id = substr($orderId, 10);
        if ($request->input('status') == 'PAID') {
            Order::where('id', $id)->update(['status' => 1]);
            return redirect('/orders')->with('success', 'Đặt hàng thành công!');
        }elseif ($request->input('cancel')) {
            Order::where('id', $id)->update(['status' => 3]);
            return redirect('/orders')->with('error', 'Đã hủy thanh toán!');
        }else{
            Order::where('id', $id)->update(['status' => 3]);
            return redirect('/cart')->with('error', 'Đặt hàng không thành công!');
        }
    }

    public function received(Request $request)
    {
        $orderId = $request->input('id');
        Order::where('id', $orderId)->update(['status' => 2]);
        return redirect()->back()->with('success', 'Đã nhận được hàng!');
    }
}