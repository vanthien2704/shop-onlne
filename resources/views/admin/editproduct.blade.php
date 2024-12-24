@include('admin.headeradmin')

<div class="container">
    <h2>Sửa Sản Phẩm</h2>
    <form action="{{ url('/admin/products/edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="group_id">Nhóm Sản Phẩm:</label>
        <select class="form-control" id="group_id" name="group_id">
            @forelse ($groups as $group)
                <option value="{{ $group->id }}" 
                    @if($group->id == $editproduct->group_id) selected @endif>
                    {{ $group->group_name }}
                </option>
            @empty
                <option value="">No groups available</option>
            @endforelse
        </select>

        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" id="product_id" name="product_id"
             value="{{$editproduct->id}}" >
        </div>

        <div class="form-group">
            <label for="tensp">Tên sản Phẩm:</label>
            <input type="text" class="form-control" name="product_name" value="{{$editproduct->product_name}}" required>
        </div>
        <div class="form-group">
            <label for="mota">Mô Tả:</label>
            <textarea type="text" class="form-control"  rows="5" name="description" required>{{$editproduct->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="dongia">Đơn giá:</label>
            <input type="number" value="{{$editproduct->unit_price}}"class="form-control" name="unit_price" required>
        </div>
        <div class="form-group">
            <label for="dongia">Đơn giá Cũ:</label>
            <input type="number" value="{{$editproduct->old_unit_price}}"class="form-control" name="old_unit_price" required>
        </div>
        <div class="form-group">
            <label for="soluong">Số Lượng:</label>
            <input type="number" value="{{$editproduct->quantity}}"class="form-control" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="img">Ảnh Đại Diện:</label>
            <input type="file" class="form-control" name="image" value="{{$editproduct->image}}">
            <img src="{{ asset('upload/' . $editproduct->image) }}" width="80px" height="80px">
        </div>
        <div class="form-group">
            <label for="mota">Ghi chú:</label>
            <textarea  class="form-control"  rows="3" name="note" >{{$editproduct->note}} </textarea>
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="enable" value="1" {{ $editproduct->enable == 1 ? 'checked' : '' }}>Hiển Thị
        </div>
        <button type="submit" class="btn btn-primary" name="ok">Cập nhật</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>