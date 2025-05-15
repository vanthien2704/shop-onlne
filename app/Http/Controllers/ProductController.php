<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Comment;
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
        $product = Product::find($id);
        $commentall = Comment::with('user')->where('product_id', $id)->orderBy('id', 'desc')->get();
        // dd($comment);
        $iscomment = false;
        if (Auth::check())
        {
            $orders = Order::with(['order_details.product'])
                ->where('user_id', Auth::id())
                ->where('status', 1)
                ->whereHas('order_details', function ($query) use ($id) {
                    $query->where('product_id', $id);
                })
                ->get();
            $feedback = Comment::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            $iscomment = $orders->isNotEmpty() && is_null($feedback);
        }
        
        return view('product.productdetail', compact('product', 'commentall', 'iscomment'));
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
        $orders = Order::where('user_id', $user_id)->with('order_details.product')->orderBy('id', 'desc')->paginate(10);
        return view('product.order', compact('orders'));
    }

    public function updateCart(Request $request)
    {
        $key = $request->input('key');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
        }

        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
    }
    public function addcomment(Request $request)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Bạn đã đánh giá sản phẩm này!');
    }
}
