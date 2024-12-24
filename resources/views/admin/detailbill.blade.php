@include('admin.headeradmin')

<h2 class="heading_admin">Thông tin hóa đơn {{$bill->id}}</h2>

<div class="container">
    <h3>Thông tin người nhận</h3>
    <p>Họ tên người nhận: {{$bill->name}}</p>
    <p>Địa chỉ: {{$bill->address}}</p>
    <p>Số điện thoại: {{$bill->phone}}</p>
    <p>Email: {{$bill->email}}</p>
    <p>Ngày đặt: {{$bill->created_at}}</p>

    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh</th>
                    <th>Đơn Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bill->carts as $cart)
                    <tr>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->product->id }}</td>
                        <td>
                            <img src="{{ asset('upload/' . $cart->product->image) }}"alt="" width="50">
                         </td>
                        <td>{{ $cart->product->id }}</td>
                        <td>{{ $cart->product->id }}</td>
                        <td>{{ $cart->product->id }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <form action="{{ url('/admin/bills/edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id"
                value="{{ $bill->id }}" required >
        <div class="form-group">
            <label for="quyen">Trạng thái đơn hàng:</label>
            <select class="form-control" name="status">
                <option value="0" {{ $bill->status == '0' ? 'selected' : '' }}>Đơn hàng đã bị hủy</option>
                <option value="1" {{ $bill->status == '1' ? 'selected' : '' }}>Đã thanh toán</option>
                <option value="2" {{ $bill->status == '2' ? 'selected' : '' }}> Đơn hàng đã giao</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary" name="ok">Cập nhật</button>
    </form>
</div>