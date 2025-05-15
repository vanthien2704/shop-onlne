@include('admin.headeradmin')
<div class="container">
    <h2>Sửa Tài Khoản</h2>
    <form action="{{ url('/admin/account/edit')}}" method="POST">
        @csrf
        <input type="hidden" class="form-control" id="id_user" name="id_user"
                value="{{ $editaccount->id }}" required >
        <div class="form-group">
            <label for="email">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="tendn" name="username"
                value="{{ $editaccount->username }}" required >
        </div>
        <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" class="form-control" name="password" value="{{ $editaccount->password }}" required>
        </div>
        <div class="form-group">
            <label for="email">Họ tên:</label>
            <input type="text" class="form-control" name="fullname" value="{{ $editaccount->fullname }}" required>
        </div>
        <div class="form-group">
            <label for="email">Số điện thoại:</label>
            <input type="text" class="form-control" name="phone" value="{{ $editaccount->phone }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ $editaccount->email }}" required>
        </div>
        <div class="form-group">
        <label for="email">Địa chỉ:</label>
            <input type="text" class="form-control" name="address" value="{{ $editaccount->address }}" required>
        </div>
        <div class="form-group">
            <label for="quyen">Quyền:</label>
            <select class="form-control" name="role">
                @forelse (App\Helper\AppHelper::role() as $role)
                <option value="{{ $role->id }}" 
                    @if($role->id == $editaccount->role_id) selected @endif>
                    {{ $role->rolename }}
                </option>
                @empty
                    <option value="">No role</option>
                @endforelse
            </select>
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="enable" value="1" {{ $editaccount->enable == 1 ? 'checked' : '' }}>Trạng thái
        </div>
        @if(session('error'))
            <div class="relog-form__title" style="color: red;">
                {{ session('error') }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary" name='ok'>Cập nhật</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>