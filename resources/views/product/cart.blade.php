@include('partial_user.headernguoidung')
<div class="cart">
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 ">
            <form action="{{ url('/payment') }}" method="post">
                @csrf
                <div class="cart__fill">   
                    <h3 class="product__heading">Thông tin nhận hàng</h3>
                    <div class="cart__info l-o-1">
                        <div class="cart__info-gr">
                            <span class="cart__info-text">Họ tên</span>
                            <input type="text" name="hoten" class="cart__info-input" required>
                        </div>
                        <div class="cart__info-gr">
                            <span class="cart__info-text">Địa chỉ</span>
                            <input type="text" name="diachi" class="cart__info-input" required>
                        </div>
                        <div class="cart__info-gr">
                            <span class="cart__info-text">Điện thoại</span>
                            <input type="text" name="dienthoai" class="cart__info-input" required>
                        </div>
                        <div class="cart__info-gr">
                            <span class="cart__info-text">Email</span>
                            <input type="text" name="email" class="cart__info-input" required>
                        </div>
                    </div>
                </div>               
                <div class="cart__product">
                    <h3 class="product__heading">Giỏ hàng</h3>
                    @if(session('cart') && count(session('cart')) > 0)
                        <table class="cart__table">
                            <thead>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Chức năng</th>
                            </thead>
                            <tbody>
                                @php $tong = 0; @endphp
                                @foreach(session('cart') as $key => $product)
                                @php
                                    $dataproduct =App\Models\Product::where('id', $key)->first();
                                    $tong += $product['total_price'];
                                @endphp
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td><img src="{{ asset('upload/' . $dataproduct->image) }}" class="cart__table-img"></td>
                                    <td>{{$dataproduct->product_name}}</td>
                                    <td>{{Number::format($product['unit_price'])}}</td>
                                    <td>{{$product['quantity']}}</td>
                                    <td>{{Number::format($product['total_price'])}}</td>
                                    <td>
                                        <a class="cart__table-delete-hi" href="{{ url('/removecart', ['id' => $key]) }}" style="color: red">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="cart__table-money">
                                    <th class="cart__table-money-text" colspan="5">
                                        Tổng đơn hàng 
                                    </th>
                                    <th colspan="2" id="tongtien">
                                        {{Number::format($tong)}}
                                    </th>
                                    <input type="hidden" name="tongtien" value="{{ $tong }}">
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart__table-btn">
                            <button class="cart__table-btn-agree" type="submit" name="dongydathang">Đồng ý đặt hàng</button>
                            <a href="{{ url('/removecartall')}}" class="cart__table-btn-delete">Xóa giỏ hàng</a>
                            <a href="{{ url()->previous() }}" class="cart__table-btn-home">Tiếp tục đặt hàng</a>
                        </div>
                    @else
                        <h1>Không có sản phẩm nào trong giỏ hàng của bạn</h1>
                        <div class="cart__table-btn">
                            <a href="{{ url()->previous() }}" class="cart__table-btn-home">Tiếp tục đặt hàng</a>
                        </div>
                    @endif
                </div>
            </form>
             
            </div>
        </div>
    </div>
</div>
@include('partial_user.footernguoidung')