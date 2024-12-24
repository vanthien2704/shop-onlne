@include('admin.headeradmin')
<div class="container">
    <div class="account__form">
    <h2>Thêm Nhóm Sản Phẩm</h2>
    <form action="{{ url('/admin/groupproducts/add')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pwd">Tên Nhóm:</label>
            <input type="text" class="form-control" name="group_name">
        </div>
    
        <div class="form-group">
            <label for="mota">Ghi chú:</label>
            <textarea  class="form-control"  rows="3" name="note"></textarea>
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="enable" value="1" checked>Hiển Thị
        </div>

        <button type="submit" class="btn btn-primary" name='ok'>Thêm</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>