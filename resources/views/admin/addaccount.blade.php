@include('admin.headeradmin')

<div class="container" >
    <h2>Thêm Tài Khoản</h2>
    <form action="{{ url('/admin/account/add')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="tendangnhap" name="tendangnhap" required>
        </div>
        <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" class="form-control"  name="matkhau" required>
        </div>
        <div class="form-group">
            <label for="email">Họ tên:</label>
            <input type="text" class="form-control" name="hoten" required>
        </div>
        <div class="form-group">
            <label for="email">Số điện thoại:</label>
            <input type="text" class="form-control" name="sdt" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" required>
        </div>
         <div class="form-group">
            <label for="email">Địa chỉ:</label>
            <input type="text" class="form-control" name="diachi" required>
        </div>
        <div class="form-group">
            <label for="quyen">Quyền:</label>
            <select class="form-control" name="role">
                @forelse (App\Helper\AppHelper::role() as $role)
                <option value="{{ $role->id }}">
                    {{ $role->rolename }}
                </option>
                @empty
                    <option value="">No role</option>
                @endforelse
            </select>
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="enable" value="1" checked>Trạng thái
        </div>
        <button type="submit" class="btn btn-primary" name="tbOk">Thêm</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>