<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function admin()
    {
        $revenue = Order::selectRaw("
            SUM(CASE WHEN DATE(order_date) = CURDATE() THEN total ELSE 0 END) AS doanh_thu_ngay_hien_tai,
            SUM(CASE WHEN YEAR(order_date) = YEAR(CURDATE()) AND WEEK(order_date) = WEEK(CURDATE()) THEN total ELSE 0 END) AS doanh_thu_tuan_hien_tai,
            SUM(CASE WHEN YEAR(order_date) = YEAR(CURDATE()) THEN total ELSE 0 END) AS doanh_thu_nam_hien_tai,
            SUM(total) AS tong_doanh_thu,
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

        $sumbill = Order::count();

        $sumproduct = OrderDetail::sum('quantity');

        return view('admin.admin', compact('revenue', 'sumbill', 'sumproduct'));
    }

    public function account()
    {
        $accounts = User::orderBy('id', 'desc')->paginate(10);

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
            'role' => $request->input('role'),
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

        User::create([
            'username' => $validated['tendangnhap'],
            'password' => Hash::make($validated['matkhau']),
            'fullname' => $validated['hoten'],
            'phone' => $validated['sdt'],
            'email' => $validated['email'],
            'address' => $validated['diachi'],
        ]);

        return redirect('/admin/account')->with('success', 'Thêm thành công!');
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
        $bill = Order::where('id', $id)->with('carts.product')->first();

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
        $detailbill = OrderDetail::where('bill_id', $id)->get();

        Order::where('id', $id)->update(['status' => 2]);

        foreach ($detailbill as $product) {
            Product::where('id', $product->product_id)->decrement('quantity', $product->quantity);
        }

        return redirect('/admin/bills')->with('success', 'Đơn hàng đã được gửi đi!');
    }
}
