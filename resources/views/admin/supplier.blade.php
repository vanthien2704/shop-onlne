@include('admin.headeradmin')

<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Ứng tuyển nhà cung cấp</h2>
            <table class=" table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applys as $apply)
                        <tr>
                            <td>{{ $apply->id }}</td>
                            <td>{{ $apply->name }}</td>
                            <td>{{ $apply->phone }}</td>
                            <td>{{ $apply->email }}</td>
                            <td>{{ $apply->status == 1 ? 'Đã duyệt' : 'Chờ duyệt' }}</td>
                            <td>
                                <a class="link_admin link_admin-fix" href="{{ url('/admin/supplier/edit', $apply->id) }}" style="text-decoration: none">Xem</a>
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
                {{ $applys->links('pagination::bootstrap-4') }}
            </div>

            
        </div>
    </div>

</div>