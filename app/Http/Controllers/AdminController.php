<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;
use App\Exports\OrderMultiSheetExport;

class AdminController extends Controller
{
    //
    public function admin(Request $request)
    {
        $StartDate = $request->input('StartDate') ?? now()->toDateString();
        $EndDate = $request->input('EndDate') ?? now()->toDateString();
        $doanh_thu = Order::where('status', 2)
            ->whereBetween('order_date', [$StartDate, $EndDate])
            ->sum('total');
        $revenue = Order::where('status', 2)
            ->selectRaw("
            SUM(CASE WHEN MONTH(order_date) = 1 THEN total ELSE 0 END) AS doanh_thu_thang_1,
            SUM(CASE WHEN MONTH(order_date) = 2 THEN total ELSE 0 END) AS doanh_thu_thang_2,
            SUM(CASE WHEN MONTH(order_date) = 3 THEN total ELSE 0 END) AS doanh_thu_thang_3,
            SUM(CASE WHEN MONTH(order_date) = 4 THEN total ELSE 0 END) AS doanh_thu_thang_4,
            SUM(CASE WHEN MONTH(order_date) = 5 THEN total ELSE 0 END) AS doanh_thu_thang_5,
            SUM(CASE WHEN MONTH(order_date) = 6 THEN total ELSE 0 END) AS doanh_thu_thang_6,
            SUM(CASE WHEN MONTH(order_date) = 7 THEN total ELSE 0 END) AS doanh_thu_thang_7,
            SUM(CASE WHEN MONTH(order_date) = 8 THEN total ELSE 0 END) AS doanh_thu_thang_8,
            SUM(CASE WHEN MONTH(order_date) = 9 THEN total ELSE 0 END) AS doanh_thu_thang_9,
            SUM(CASE WHEN MONTH(order_date) = 10 THEN total ELSE 0 END) AS doanh_thu_thang_10,
            SUM(CASE WHEN MONTH(order_date) = 11 THEN total ELSE 0 END) AS doanh_thu_thang_11,
            SUM(CASE WHEN MONTH(order_date) = 12 THEN total ELSE 0 END) AS doanh_thu_thang_12
        ")->first();

        $sumbill = Order::where('status', 2)
            ->whereBetween('order_date', [$StartDate, $EndDate])
            ->count();

        $sumproduct = OrderDetail::whereHas('order', function ($query) use ($StartDate, $EndDate) {
            $query->whereBetween('order_date', [$StartDate, $EndDate])->where('status', 2);
        })->sum('quantity');

        return view('admin.admin', compact('revenue','doanh_thu', 'sumbill', 'sumproduct', 'StartDate', 'EndDate'));
    }

    public function account()
    {
        $accounts = User::with('role')->orderBy('id', 'desc')->paginate(10);

        return view('admin.account', compact('accounts'));
    }

    public function removeaccount($id)
    {
        User::where('id', $id)->update(['enable' => 0]);

        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function editaccount($id)
    {
        $editaccount = User::where('id', $id)->first();

        return view('admin.editaccount', compact('editaccount'));
    }

    public function updateaccount(Request $request) {
        $id_user = $request->input('id_user');
        $data = [
            'username' => $request->input('username'),
            'fullname' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'role_id' => $request->input('role'),
            'enable' => $request->input('enable') ?? 0,
        ];

        $user = User::find($id_user);

        if ($request->input('password') != $user->password) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $update = User::where('id', $id_user)->update($data);

        if ($update) {
            return redirect('/admin/account')->with('success', 'Cập nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function addaccount()
    {
        return view('admin.addaccount');
    }

    public function registeraccount(Request $request) {
        // Kiểm tra dữ liệu đầu vào trực tiếp
        $validated = $request->validate([
            'tendangnhap' => 'required|string|max:255|unique:users,username',
            'matkhau' => 'required|string|min:3',
            'hoten' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email',
            'diachi' => 'required|string|max:255',
        ]);

        $addacc = User::create([
            'username' => $validated['tendangnhap'],
            'password' => Hash::make($validated['matkhau']),
            'fullname' => $validated['hoten'],
            'phone' => $validated['sdt'],
            'email' => $validated['email'],
            'address' => $validated['diachi'],
            'role_id' => $request->input('role'),
        ]);

        if ($addacc) {
            return redirect('/admin/account')->with('success', 'Thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Kiểm tra lại dữ liệu!');
        }
        
    }

    public function products()
    {
        $products = Product::with('product_group')->orderBy('id', 'desc')->paginate(10);
        return view('admin.product', compact('products'));
    }

    public function editproduct($id)
    {
        $editproduct = Product::where('id', $id)->with('product_group')->first();
        $groups = ProductGroup::all();
        return view('admin.editproduct', compact('editproduct', 'groups'));
    }

    public function removeproduce($id)
    {
        Product::where('id', $id)->update(['enable' => 0]);

        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function addproduct()
    {
        $groups = ProductGroup::all();
        return view('admin.addproduct', compact('groups'));
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
            return redirect('/admin/products')->with('success', 'Cập nhập thành công!');
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
            return redirect('/admin/products')->with('success', 'Thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại!');
        }
    }

    public function groupproducts()
    {
        $groups = ProductGroup::orderBy('id', 'desc')->paginate(10);
        return view('admin.groupproducts', compact('groups'));
    }

    public function editgroupproducts($id)
    {
        $editgroups = ProductGroup::where('id', $id)->first();
        return view('admin.editgroupproducts', compact('editgroups'));
    }

    public function updategroupproducts(Request $request) {
        $id = $request->input('id');
        $data = [
            'group_name' => $request->input('group_name'),
            'note' => $request->input('note') ?? '',
            'enable' => $request->input('enable') ?? 0,
        ];

        $update = ProductGroup::where('id', $id)->update($data);

        if ($update) {
            return redirect('/admin/groupproducts')->with('success', 'Cập nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function removegroupproducts($id)
    {
        ProductGroup::where('id', $id)->update(['enable' => 0]);

        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function addgroupproductst()
    {
        return view('admin.addgroupproductst');
    }

    public function creagroupproducts(Request $request)
    {
        $data = [
            'group_name' => $request->input('group_name'),
            'note' => $request->input('note') ?? '',
            'enable' => $request->input('enable') ?? 0,
        ];

        $insert = ProductGroup::create($data);

        if ($insert) {
            return redirect('/admin/groupproducts')->with('success', 'Thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại!');
        }
    }

    public function bills()
    {
        $bills = Order::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.bills', compact('bills'));
    }

    public function detailbill($id)
    {
        $bill = Order::where('id', $id)->with('order_details.product')->first();

        return view('admin.detailbill', compact('bill'));
    }
    
    public function updatebill(Request $request) {
        $id = $request->input('id');
        $status = $request->input('status');

        $data = ['status' => $status];

        $update = Order::where('id', $id)->update($data);

        if ($update) {
            return redirect('/admin/bills')->with('success', 'Cập nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function sendbill($id)
    {
        $detailbill = OrderDetail::where('order_id', $id)->get();

        Order::where('id', $id)->update(['status' => 2]);

        foreach ($detailbill as $product) {
            Product::where('id', $product->product_id)->decrement('quantity', $product->quantity);
        }

        return redirect('/admin/bills')->with('success', 'Đơn hàng đã được gửi đi!');
    }
    public function supplier()
    {
        $applys = Apply::orderBy('id', 'desc')->paginate(10);

        return view('admin.supplier', compact('applys'));
    }
    public function editsupplier($id)
    {
        $editsupplier = Apply::where('id', $id)->first();

        return view('admin.editsupplier', compact('editsupplier'));
    }
    public function addsupplier($id)
    {
        $apply = Apply::findOrFail($id);
        $apply->update(['status' => 1]);
        User::where('id', $apply->user_id)->update(['role_id' => 2]);
        return redirect('/admin/supplier')->with('success', 'Bạn đã duyệt đơn ' . $id . '!');
    }
    public function export_products()
    {
        $products = Product::with('product_group')->orderBy('id', 'desc')->get();
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
       $orders = Order::with(['user', 'order_details.product'])
            ->orderBy('id', 'desc')
            ->get();

        $orderdetails = OrderDetail::with('product')->get();

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
    public function export_account()
    {
        $accounts = User::with('role')->orderBy('id', 'desc')->get();
        $headings = ['ID', 'Tên đăng nhập', 'Họ và tên', 'Phone', 'Email', 'Địa chỉ', 'Quyền'];
        $data = $accounts->map(function($account) {
            return [
                $account->id,
                $account->username,
                $account->fullname,
                $account->phone,
                $account->email,
                $account->address,
                $account->role->rolename,
            ];
        })->toArray();
        return Excel::download(new CustomExport($data, $headings), 'account.xlsx');
    }
}
