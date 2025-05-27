<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apply;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;
use App\Exports\OrderMultiSheetExport;

class SupplierController extends Controller
{
    public function supplier()
    {
        if (Auth::user()->role_id >= 2) {
            return redirect('/supplier/dashboard');
        }
        return view('supplier.apply');
    }
    public function dashboard(Request $request)
    {
        $StartDate = $request->input('StartDate') ?? now()->toDateString();
        $EndDate = $request->input('EndDate') ?? now()->toDateString();
        $doanh_thu = DB::table('order_detail')
            ->join('products', 'order_detail.product_id', '=', 'products.id')
            ->join('order', 'order_detail.order_id', '=', 'order.id')
            ->where('products.user_id', Auth::id())
            ->where('order.status', 2)
            ->whereBetween('order.order_date', [$StartDate, $EndDate])
            ->sum('total');
        $revenue = DB::table('order_detail')
            ->join('products', 'order_detail.product_id', '=', 'products.id')
            ->join('order', 'order_detail.order_id', '=', 'order.id')
            ->where('products.user_id', Auth::id())
            ->where('order.status', 2)
            ->selectRaw("
                SUM(CASE WHEN MONTH(order.order_date) = 1 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_1,
                SUM(CASE WHEN MONTH(order.order_date) = 2 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_2,
                SUM(CASE WHEN MONTH(order.order_date) = 3 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_3,
                SUM(CASE WHEN MONTH(order.order_date) = 4 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_4,
                SUM(CASE WHEN MONTH(order.order_date) = 5 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_5,
                SUM(CASE WHEN MONTH(order.order_date) = 6 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_6,
                SUM(CASE WHEN MONTH(order.order_date) = 7 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_7,
                SUM(CASE WHEN MONTH(order.order_date) = 8 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_8,
                SUM(CASE WHEN MONTH(order.order_date) = 9 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_9,
                SUM(CASE WHEN MONTH(order.order_date) = 10 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_10,
                SUM(CASE WHEN MONTH(order.order_date) = 11 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_11,
                SUM(CASE WHEN MONTH(order.order_date) = 12 THEN order_detail.total_price ELSE 0 END) AS doanh_thu_thang_12
            ")
            ->first();
        
        $sumbill = Order::whereHas('order_details.product', function ($query) {
            $query->where('user_id', Auth::id());
        })->whereBetween('order_date', [$StartDate, $EndDate])
            ->where('status', 2)
            ->count();
        
        $sumproduct = OrderDetail::whereHas('product', function ($query) {
            $query->where('user_id', Auth::id());
        })->whereHas('order', function ($query) use ($StartDate, $EndDate) {
            $query->whereBetween('order_date', [$StartDate, $EndDate])->where('status', 2);
        })->sum('quantity');

        
        return view('supplier.dashboard', compact('revenue','doanh_thu', 'sumbill', 'sumproduct', 'StartDate', 'EndDate'));
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
    public function products()
    {
        $products = Product::with('product_group')->where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        return view('supplier.product', compact('products'));
    }
    public function editproduct($id)
    {
        $editproduct = Product::where('id', $id)->with('product_group')->first();
        $groups = ProductGroup::all();
        return view('supplier.editproduct', compact('editproduct', 'groups'));
    }

    public function removeproduce($id)
    {
        Product::where('id', $id)->update(['enable' => 0]);

        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function addproduct()
    {
        $groups = ProductGroup::all();
        return view('supplier.addproduct', compact('groups'));
    }

    public function updateproduct(Request $request) {
        $id_product = $request->input('product_id');
        $data = [
            'group_id' => $request->input('group_id'),
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'unit_price' => $request->input('unit_price'),
            'old_unit_price' => $request->input('old_unit_price'),
            'quantity' => $request->input('quantity'),
            'note' => $request->input('note') ?? '',
            'enable' => $request->input('enable') ?? 0,
        ];

        $imageName = $this->uploadhinh($request);
        if ($imageName) {
            $data['image'] = $imageName;
        }

        $update = Product::where('id', $id_product)->update($data);

        if ($update) {
            return redirect('/supplier/products')->with('success', 'Cập nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }

    private function uploadhinh($request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('', 'upload');
            $imageName = basename($imagePath);
            return $imageName;
        }
        return null;
    }

    public function creatproduct(Request $request) {
        $data = [
            'group_id' => $request->input('group_id'),
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'unit_price' => $request->input('unit_price'),
            'old_unit_price' => $request->input('old_unit_price'),
            'quantity' => $request->input('quantity'),
            'image' => $this->uploadhinh($request),
            'note' => $request->input('note') ?? '',
            'enable' => $request->input('enable') ?? 0,
        ];

        $insert = Product::create($data);

        if ($insert) {
            return redirect('/supplier/products')->with('success', 'Thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại!');
        }
    }
    public function bills()
    {
        $bills = Order::whereHas('order_details.product', function ($query) {
            $query->where('user_id', Auth::id());
            })
            ->with(['user', 'order_details.product'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('supplier.bills', compact('bills'));
    }

    public function detailbill($id)
    {
        $bill = Order::where('id', $id)->with('order_details.product')->first();

        return view('supplier.detailbill', compact('bill'));
    }
    
    public function updatebill(Request $request) {
        $id = $request->input('id');
        $status = $request->input('status');

        $data = ['status' => $status];

        $update = Order::where('id', $id)->update($data);

        if ($update) {
            return redirect('/supplier/bills')->with('success', 'Cập nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function sendbill($id)
    {
        // $detailbill = OrderDetail::where('order_id', $id)->get();

        Order::where('id', $id)->update(['status' => 2]);

        // foreach ($detailbill as $product) {
        //     Product::where('id', $product->product_id)->decrement('quantity', $product->quantity);
        // }

        return redirect('/supplier/bills')->with('success', 'Đơn hàng đã được gửi đi!');
    }
    public function export_products()
    {
        $products = Product::with('product_group')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $headings = ['ID', 'Tên sản phẩm', 'Nhóm sản phẩm', 'Giá', 'Giá cũ', 'Số lượng tồn'];
        $data = $products->map(function($product) {
            return [
                $product->id,
                $product->product_name,
                $product->product_group->group_name ?? '',
                $product->unit_price,
                $product->old_unit_price,
                $product->quantity,
            ];
        })->toArray();
        return Excel::download(new CustomExport($data, $headings), 'products.xlsx');
    }
    public function export_oder()
    {
       $orders = Order::whereHas('order_details.product', function ($query) {
            $query->where('user_id', Auth::id());
            })
            ->with(['user', 'order_details.product'])
            ->orderBy('id', 'desc')
            ->get();

        $orderdetails = OrderDetail::with('product')
            ->whereHas('product', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        $headings1 = ['ID', 'Người mua', 'Người đặt', 'Địa chỉ', 'Phone', 'Ngày đặt', 'Trạng thái'];
        $data1 = $orders->map(function($order) {
            $statusText = match($order->status) {
                0 => 'Chưa thanh toán',
                1 => 'Đã thanh toán',
                2 => 'Đơn hàng đã giao',
                default => 'Đơn hàng đã bị hủy',
            };
            return [
                $order->id,
                $order->name,
                $order->user->username,
                $order->address,
                $order->phone,
                $order->order_date,
                $statusText,
            ];
        })->toArray();

        $headings2 = ['Mã đơn hàng', 'Tên sản phẩm', 'Số lượng', 'Đơn Giá', 'Tổng tiền'];
        $data2 = $orderdetails->map(function($orderdetail) {
            return [
                $orderdetail->order_id,
                $orderdetail->product->product_name,
                $orderdetail->unit_price,
                $orderdetail->quantity,
                $orderdetail->total_price,
            ];
        })->toArray();
         return Excel::download(new OrderMultiSheetExport($data1, $headings1, $data2, $headings2), 'orders.xlsx');
    }
}
