@include('admin.headeradmin')

<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Quản Lý Tài Khoản</h2>
            <div class="link_admin-footer">
                <a class="link_admin-btn" href="{{url('/admin/account/add')}}" >Thêm Tài Khoản</a>
            </div>
            <table class=" table table-bordered">
                <thead>
                    <tr>
                        <th>Tên Đăng Nhập</th>
                        <th>Họ Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $account)
                        <tr>
                            <td>{{ $account->username }}</td>
                            <td>{{ $account->fullname }}</td>
                            <td>{{ $account->phone }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->address }}</td>
                            <td>{{ $account->role_id }}</td>
                            <td>{{ $account->enable == 1 ? 'Đang sử dụng' : 'Đã xóa' }}</td>
                            <td>
                                <a class="link_admin link_admin-fix" href="{{ url('/admin/account/edit', $account->id) }}" style="text-decoration: none">Sửa</a>
                                @if ($account->enable)
                                    <a class="link_admin link_admin-delete" href="{{ url('/admin/account/remove', $account->id) }}" style="text-decoration: none">Xóa</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="link_admin-footer d-flex justify-content-center">
                {{ $accounts->links('pagination::bootstrap-4') }}
            </div>

            
        </div>
    </div>

</div>