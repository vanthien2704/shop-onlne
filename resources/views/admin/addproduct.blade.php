@include('admin.headeradmin')

<div class="container">
    <h2>Thêm Sản Phẩm</h2>
    <form action="{{ url('/admin/products/add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="group_id">Nhóm Sản Phẩm:</label>
        <select class="form-control" id="group_id" name="group_id">
            @forelse ($groups as $group)
                <option value="{{ $group->id }}">
                    {{ $group->group_name }}
                </option>
            @empty
                <option value="">No groups available</option>
            @endforelse
        </select>

        </div>

        <div class="form-group">
            <label for="tensp">Tên sản Phẩm:</label>
            <input type="text" class="form-control" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="mota">Mô Tả:</label>
            <textarea type="text" class="form-control"  rows="5" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="dongia">Đơn giá:</label>
            <input type="number" class="form-control" name="unit_price" required>
        </div>
        <div class="form-group">
            <label for="dongia">Đơn giá Cũ:</label>
            <input type="number" class="form-control" name="old_unit_price" required>
        </div>
        <div class="form-group">
            <label for="soluong">Số Lượng:</label>
            <input type="number" class="form-control" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="img">Ảnh Đại Diện:</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="form-group">
            <label for="mota">Ghi chú:</label>
            <textarea  class="form-control"  rows="3" name="note"></textarea>
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="enable" value="1" checked>Hiển Thị
        </div>
        <button type="submit" class="btn btn-primary" name="ok">Thêm</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>