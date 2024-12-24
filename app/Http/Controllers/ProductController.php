<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productsgroup($id)
    {
        if ($id === 'all') {
            $group = Product::where('enable', 1)->paginate(10); // Lấy tất cả sản phẩm
        } else {
            $group = Product::where('group_id', $id)->where('enable', 1)->paginate(10);
        }
        return view('product.productsgroup', ['group' => $group]);
    }

    public function productdetail($id)
    {
        $product = Product::where('id', $id)->first();
        return view('product.productdetail', ['product' => $product]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $unit_price = $request->input('unit_price');
        $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không truyền vào

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới
            $cart[$id] = [
                'unit_price' => $unit_price,
                'quantity' => $quantity,
                'total_price' => $unit_price * $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function viewCart()
    {
        return view('product.cart');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('success', 'Sản phẩm đã loại bỏ khỏi giỏ hàng!');
        }
        return abort(404);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect('/cart')->with('success', 'Đã dọn xạch giỏ hàng');
    }

    public function vieworder()
    {
        $user_id = Auth::id();
        $orders = Bill::where('user_id', $user_id)->with('carts.product')->paginate(10);
        // dd($orders);
        return view('product.order', compact('orders'));
    }

    public function addbill(Request $request)
    {
        $user_id = Auth::id();
        $cart = session()->get('cart', []);

        // Tạo đơn hàng mới
        $bill = new Bill();
        $bill->user_id = $user_id;
        $bill->name = $request->input('hoten');
        $bill->address = $request->input('diachi');
        $bill->phone = $request->input('dienthoai');
        $bill->email = $request->input('email');
        $bill->order_date = now();
        $bill->total = $request->input('tongtien');
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

        session()->forget('cart');
        
        return redirect('/orders')->with('success', 'Đặt hàng thành công!');
    }

    public function cancelorder(Request $request)
    {
        $orderid = $request->input('order_id');
        Bill::where('id', $orderid)->update(['status' => 0]);
        return redirect()->back()->with('success', 'Đã hủy bỏ đơn hàng!');
    }
}
