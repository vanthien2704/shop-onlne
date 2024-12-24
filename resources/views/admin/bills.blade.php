@include('admin.headeradmin')

<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Quản Lý Hóa Đơn</h2>
            <table class=" table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>User</th>
                        <th>Người mua</th>
                        <th>Địa chỉ giao</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
                            <td>{{ $bill->user->username }}</td>
                            <td>{{ $bill->user->fullname }}</td>
                            <td>{{ $bill->user->address }}</td>
                            <td>
                                @switch($bill->status)
                                    @case(0)
                                        Đơn hàng đã bị hủy
                                        @break
                                    @case(1)
                                        Đã thanh toán
                                        @break
                                    @default
                                        Đơn hàng đã giao
                                @endswitch
                            </td>
                            <td>
                                <a class="link_admin link_admin-fix" href="{{ url('/admin/bills/detail', $bill->id) }}" style="text-decoration: none">Xem</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="link_admin-footer">
                    <a class="link_admin-btn" href="{{url('/admin/bill/add')}}" >Thêm Tài Khoản</a>
                </div>
        </div>
    </div>

</div>