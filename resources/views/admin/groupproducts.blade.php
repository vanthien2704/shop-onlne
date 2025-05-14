@include('admin.headeradmin')
<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Quản Lý Nhóm Sản Phẩm</h2>
            <div class="link_admin-footer">
                <a class="link_admin-btn" href="{{ url('/admin/groupproducts/add') }}" >Thêm Nhóm Sản Phẩm</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Ghi Chú</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                        <tr>
                            <td class = "info__product-gr">{{$group->id}}</td>
                            <td class = "info__product-gr">{{$group->group_name}}</td>
                            <td class = "info__product-gr">{{$group->note}}</td>
                            <td>{{ $group->enable == 1 ? 'Đang bật' : 'Đã xóa' }}</td>
                            <td>
                                <a class="link_admin link_admin-fix" href="{{ url('/admin/groupproducts/edit', $group->id) }}" style="text-decoration: none">Sửa</a>
                                @if ($group->enable)
                                    <a class="link_admin link_admin-delete" href="{{ url('/admin/groupproducts/remove', $group->id) }}" style="text-decoration: none">Xóa</a>
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
                {{ $groups->links('pagination::bootstrap-4') }}
            </div>

            
        </div>
    </div>
</div>
