@include('supplier.headersupplier')

<h2 class="heading_admin">Thông tin hóa đơn {{$bill->id}}</h2>

<div class="container">
    <h3>Thông tin người nhận</h3>
    <p>Họ tên người nhận: {{$bill->name}}</p>
    <p>Địa chỉ: {{$bill->address}}</p>
    <p>Số điện thoại: {{$bill->phone}}</p>
    <p>Email: {{$bill->email}}</p>
    <p>Ngày đặt: {{$bill->created_at}}</p>

    <span class="cart__info-text" style="font-size: 20px;">
        Hình thức thanh toán:
        {{ $bill->payment == 1 ? 'Thanh toán bằng ngân hàng' : 'Thanh toán khi nhận hàng (COD)' }}
    </span>
    
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
                @forelse ($bill->order_details as $cart)
                    @if ($cart->product && $cart->product->user_id == Auth::id())
                    <tr>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->product->product_name }}</td>
                        <td>
                            <img src="{{ asset('upload/' . $cart->product->image) }}"alt="" width="50">
                         </td>
                        <td>{{ $cart->unit_price }}</td>
                        <td>{{ $cart->quantity}}</td>
                        <td>{{ $cart->total_price}}</td>
                    </tr>
                     @endif
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
            <select class="form-control" name="status" @if ($bill->status == 2) disabled @endif>
                <option value="0" {{ $bill->status == '0' ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                <option value="1" {{ $bill->status == '1' ? 'selected' : '' }}>Đang giao</option>
                <option value="2" {{ $bill->status == '2' ? 'selected' : '' }}>Đã nhận hàng</option>
                <option value="3" {{ $bill->status == '3' ? 'selected' : '' }}>Đã bị hủy</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary" name="ok">Cập nhật</button>
        @if ($bill->status != 2)
            <a href="{{ url('/supplier/bills/sendbill', $bill->id) }}" class="btn btn-primary">Giao hàng</a>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    </form>
</div>