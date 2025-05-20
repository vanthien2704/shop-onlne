@include('admin.headeradmin')

<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Quản Lý Đơn Hàng</h2>
            <div class="link_admin">
                <a class="link_admin-btn" href="{{url('/admin/exportorder')}}" >Xuất Excel</a>
            </div>
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
                                        Chưa thanh thoán
                                        @break
                                    @case(1)
                                        Đã thanh toán
                                        @break
                                    @case(2)
                                        Đơn hàng đã giao
                                        @break
                                    @default
                                        Đơn hàng đã bị hủy
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
        </div>
    </div>

</div>