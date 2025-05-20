@include('admin.headeradmin')
<div class="example">
    <div class="container">
        <div class="row">
            <h2 class="heading_admin">Quản Lý Sản Phẩm </h2>
            <div class="link_admin-footer">
                <a class="link_admin-btn" href="{{url('/admin/products/add')}}" >Thêm Sản Phẩm</a>
            </div>
            <div class="link_admin">
                <a class="link_admin-btn" href="{{url('/admin/exportproducts')}}" >Xuất Excel</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Nhóm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Người Bán</th>
                        <th>Đơn Giá</th>
                        <th>Đơn Giá Cũ</th>
                        <th>Số Lượng</th>
                        <th>Ảnh </th>
                        <th>Enable</th>
                        <th>Ghi Chú</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_group->group_name }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->user_id }}</td>
                            <td>{{  Number::format($product->unit_price) }}</td>
                            <td>{{  Number::format($product->old_unit_price) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                               <img src="{{ asset('upload/' . $product->image) }}"alt="" width="50">
                            </td>
                            <td>{{ $product->enable == 1 ? 'Đang bán' : 'Đã xóa' }}</td>
                            <td>{{ $product->note }}</td>
                            <td>
                                <a class="link_admin link_admin-fix" href="{{ url('/admin/products/edit', $product->id) }}" style="text-decoration: none">Sửa</a>
                                @if ($product->enable)
                                    <a class="link_admin link_admin-delete" href="{{ url('/admin/products/remove', $product->id) }}" style="text-decoration: none">Xóa</a>
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
                {{ $products->links('pagination::bootstrap-4') }}
            </div>

           
        </div>
    </div>

</div>