@include('partial_user.headernguoidung')
<style>
    :root {
        --green-color:#1c5b41;
        --white-color:#fff;
        --black-color:#000;
        --primary-color:#fe9614;
        --header-height:150px;
        --header-top-height:90px;
        --header-bot-height:calc(var(--header-height) - var(--header-top-height));
    }
    
    * {
        box-sizing: border-box;
    }
    
    html {
        font-size: 62.5%;
        font-family: 'Roboto', sans-serif;
        line-height: 1.6rem;
        margin: 0 auto;
    }
    
    
    .info-product__table {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        padding: 21px;
    }
    .info-product__table-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .info-product__heading-status {
        color: var(--primary-color);
        font-size: 1.6rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    .info-product__table-container {
        display: flex;
        padding: 30px 0;
        border:1px solid #ebebeb;
        border-left: none;
        border-right: none;
    }
    .info-product__container-left {
        width: 10%;
        display: flex;
        align-items: center;
    }
    .info-product__container-left-img {
        width: 80px;
        height: 80px;
        border-radius: 2px;
    }
    .info-product__container-center {
        width: 85%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .info-product__container-title {
        font-size: 1.6rem;
        margin:0;
        max-height: 1.6rem;
        overflow: hidden;
        display:-webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }
    .info-product__container-classify {
        margin-bottom: 0;
        font-size: 1.4rem;
        color: #86827e;
    }
    .info-product__container-num {
        font-size: 1.4rem;
        margin-bottom: 0;
    }
    .info-product__container-bottom {
        width: 15%;
        display: flex;
        justify-content: end;
        align-items: center;
    }
    .info-product__container-new {
        font-size: 1.6rem;
        color:#fe9614;
        padding-left: 12px;
    }
    .info-product__container-old {
        color: #dfdfdf;
        text-decoration: line-through;
        font-size: 1.6rem;
    }
    .info-product__table-footer {
        display: flex;
        flex-direction: column;
    }
    .info-product__footer-top {
        margin-left: auto;
        font-size: 1.6rem;
        padding: 20px 0;
    }
    .info-product__footer-top-money {
        color: #fe9614;
        font-size: 1.8rem;
        font-weight: 500;
    }
    .info-product__footer-bottom {
        display: flex;
        justify-content: space-between;
    }
    .info-product__footer-title {
        font-size: 1.4rem;
    }
    .info-product__footer-right {
        display: flex;
        align-items: center;
    }
    .info-product__footer-cancel {
        text-decoration: none;
        color:#fff;
        font-size: 1.4rem;
        background-color: #1c5b41;
        min-width: 212px;
        text-align: center;
        padding: 16px;
        border-radius: 10px;
        margin: 0 10px;
        cursor: pointer;
        transition: background-color linear .2s;
        border: none;
    }
    
    .info-product__footer-cancel:hover {
        background-color: #fe9614;
    }
</style>
<div class="wrapper">
    <div class="info-product">
        <div class="grid wide">
            <div class="col l-12">
                <h3 class='product__heading'>Đơn hàng của bạn</h3>

                @if ($orders->isEmpty())
                    <h1>Không có đơn hàng nào.</h1>
                @else
                    @foreach ($orders as $order)
                        <div class='info-product__table'>
                            <div class='info-product__table-heading'>
                                <p class='detail-items__code'>Mã đơn hàng: {{ $order->id }}</p>
                                <p class='info-product__heading-status'>
                                    @switch($order->status)
                                        @case(0)
                                            Đang chuẩn bị hàng
                                            @break
                                        @case(1)
                                            Đang giao
                                            @break
                                        @case(2)
                                            Đã nhận hàng
                                            @break
                                        @default
                                            Đã bị hủy
                                    @endswitch
                                </p>
                            </div>
                            <div class='info-product__table-after'>
                                @foreach ($order->order_details as $cart)
                                    <div class='info-product__table-container'>
                                        <div class='info-product__container-left'>
                                            <img src="{{ asset('upload/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class='info-product__container-left-img'>
                                        </div>
                                        <div class='info-product__container-center'>
                                            <h4 class='info-product__container-title'>{{ $cart->product->product_name }}</h4>
                                            <p class='info-product__container-num'>Số lượng: {{ $cart->quantity }}</p>
                                        </div>
                                        <div class='info-product__container-bottom'>
                                            <span class='info-product__container-new'>{{ Number::format($cart->total_price) }} đ</span>
                                        </div>
                                    </div>
                                @endforeach

                                <div class='info-product__table-footer'>
                                    <p class='info-product__footer-top'>Thành Tiền: <span class='info-product__footer-top-money'>{{ Number::format($order->total) }} đ</span></p>
                                    <div class='info-product__footer-bottom'>
                                        <form method="post" action="{{ url('/received') }}" class='info-product__footer-right'>
                                            @csrf
                                            {{-- <a href="{{ url('contact') }}" class='info-product__footer-cancel'>Liên hệ người bán</a> --}}
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            @if ($order->status < 2)
                                                <button type="submit" class="info-product__footer-cancel" name="cancel_order">Đã nhận hàng</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div style="padding: 30px;"></div>

@include('partial_user.footernguoidung')