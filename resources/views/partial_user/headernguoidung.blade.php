
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shamdi Shop</title>
    
    <!-- Đường dẫn chính xác với asset() -->
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/iconweb.jpg') }}" type="image/x-icon">

    {{-- thông báo --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Đường dẫn ngoài giữ nguyên -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
    
<style>
    .header {
        background-color: #f7ebdb;
    }

    

    /* logo */

    .header__left {
        text-decoration: none;
        outline: none;
    }

    .header__left-title {
        margin-top: 0;
        color: var(--white-color);
    }

    .header__left-msg {
        color: var(--white-color);
        font-size: 1.3rem;
        font-weight: 500;
    }

    .header__left-private {
        color: var(--black-color);
    }

    .header__left-privates {
        color: var(--white-color) !important;
    }

    /* Color header */

    .color-white {
        color:var(--white-color) !important;
    }

    .color-black {
        color:var(--black-color) !important;
    }

    /* Image */
    .product__items-img {
        height:210px;
    }

    /* Tin Tức */
    .news-items__img {
        width: 100%;
        height:256px;
        border-radius: 20px;
    }
    .news-items__msg {
        color: #afa5a8;
        font-size: 1.4rem;
        line-height: 1.8rem;
        max-height:3.6rem;
        overflow: hidden;
        display:-webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }   
    .news-items__permission-date::before {
        display: none;
    }
    /*----------*/

    /* Nút Liên Hệ */
    .contact__btn-link {
        padding: 12px 21px;
        border: none;
        cursor: pointer;
    }

    /* News_detail */

    .news-items__img {
        margin-top: 20px;
    }

    .news-items__msg-full {
        display: block;
        max-height:unset;
        line-height:2.4rem;
        color:var(--black-color);
        font-size:1.8rem;
        font-weight:500;
        text-align:left;
    }

    .news-items__title-strong {
        font-size:3.2rem;
        font-weight:600;
        margin-bottom:0;
    }

    .news-items__permission-strong {
        font-size:1.6rem;
        font-weight:500; 
    }

    /* Login */

    .relog-form__btn-link {
        width: 100%;
        border: none;
        cursor: pointer;
    }

    /* In - Out Header */

    .header-top__join-in {
        color:black;
        font-size:1.4rem;
        font-weight:300;
        user-select:none;
        cursor:pointer;
    }

    .header-top__join-out {
        text-decoration:none;
        color:#000;
        font-size:1.4rem;
        font-weight:400;
        border-left:2px solid white;
        header:18px;
    }


    
    /* Search btn */

    .header-top__search-icon {
        border:none;
        cursor:pointer;
    }

    /* Button add-cart */

    .detail-items__btn {
        margin-top:0;
    }
    
    .detail-items__btn-cart {

        width: 100%;
        cursor: pointer;
    }

    .detail-items__quantity-num {
        font-size:1.6rem;
        margin:20px 0;
    }

    /* Cart */

    .cart__info {
        display: flex;
        flex-direction: column;
        border:1px solid #ccc;
        border-radius: 10px;
        width: 80%;
        padding: 21px;
    }

    .cart__info-gr {
        margin: 10px auto;
        display: flex;
        align-items: center;
        width: 80%;
    }

    .cart__info-text {
        min-width: 80px;
        font-size: 1.4rem;
    }

    .cart__info-input {
        flex:1;
        padding:12px 8px;
        border-radius: 2px;
        border:1px solid #ccc;
    }

    .cart__table-num {
        text-align: center;
    }

    /*  */

    .cart__table {
        border: 1px solid #000;
        border-collapse:collapse;
        width: 100%;
        font-size: 1.4rem;
    }

    thead th{
        width: 15%;
        border: 1px solid #000; 
    }

    tbody td {
        text-align: center;
        border: 1px solid #000;
        height: 120px;
    }

    .cart__table-img {
        width: 60%;
        height: 80%;
    }

    .cart__table-money {
        background-color:#99989a;
        height:40px;
    }

    .cart__table-money-text {
        border-right: 2px solid #fff;
    }


    .cart__table-btn {
        margin-top: 10px;
        display: flex;
    }

    .cart__table-btn-agree,
    .cart__table-btn-delete,
    .cart__table-btn-home{
        text-decoration:none;
        min-width: 160px;
        padding: 12px;
        border-radius: 10px;
        outline: none;
        border: none;
        font-size: 1.3rem;
        color: var(--white-color);
        background-color: var(--green-color);
        cursor: pointer;
        transition: background-color ease-in .2s;
    }
    
    .cart__table-btn-delete,
    .cart__table-btn-home {
        min-width: 160px;
        text-align:center;
        margin-left:5px;
    }

    .cart__table-btn-agree:hover,
    .cart__table-btn-delete:hover,
    .cart__table-btn-home:hover {
        background-color: var(--primary-color);
    }

    /* More cart - trang chủ */

    .product__items-more-cart {
        border: none;
        color: var(--white-color);
        background-color: transparent;
        cursor: pointer;
    }

    /* Detail form */

    .detail-items__quantity {
        display: block;
    }

    /* Header-top_join */

    .header-top__join-wrap {
        display: flex;
        align-items:center;
        position: relative;
    }

    .header-top__join-menu {
        z-index: 1;
        position: absolute;
        width: 140px;
        background-color: #fff;
        right: 4px;
        top: 20px;
        list-style: none;
        padding: 0;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        border-radius:2px;
        display:none;
        animation:growth ease-in .3s;
        transform-origin: calc(100% - 5px) top;
    }

    .header-top__join-menu-items {
        font-size: 1.4rem;
        display: block;
        padding: 8px 16px;
        cursor:pointer;
        transition:background-color linear .2s;
    }

    .header-top__join-menu-items:hover {
        background-color:#f5f5f5;
    }

    .header-top__join-menu::before{
        content: "";
        display: block;
        position: absolute;
        border-width: 10px 13px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
        top: -19px;
        right: 7px;
        cursor: pointer;
    }

    .header-top__join-wrap::after{
        content: "";
        display: block;
        position: absolute;
        width: 52px;
        height: 20px;
        cursor: pointer;
        background-color: transparent;
        top: 15px;
        right: -3px;
        cursor: pointer;
    }

    .header-top__join-wrap:hover .header-top__join-menu {
        display: block;
    }

    .header-top__join-login-icon {
        cursor:pointer;
    }

    /* Button cart */

    .cart__table-delete-hi {
        text-decoration:none;
        color:#000;
        transition:color ease-in .2s;
    }

    .cart__table-delete-hi:hover {
        color:orange;
    }

    /* Mua ngay detail1 */

    .detail-items__btn-buy {
        color: var(--white-color);
        background-color: #1c5b41;
        width: 100%;
        border: none;
        cursor: pointer;
    }

    /* Chữ Kho Hàng */

    .detail-items__warehouse-remaining {
        font-size : 1.6rem;
    }

</style>
<body>
    <div class="overlay"></div>
    <div class="wrapper">

        <div class="header">
            <div class="grid wide">
                <div class="header-top">
                    <div class="header-top__gr">
                            <img src="{{ asset('assets/img/logothien.png') }}" alt="" class="header-top__logo">
                            <form action="{{ url('/search') }}" method="POST" class="header-top__search">
                                @csrf
                                <input type="text" name="tukhoa" class="header-top__search-input" placeholder="Tìm sản phẩm bạn mong muốn"
                                value = "{{ old('tukhoa') }}">
                                <button type="submit" name="timkiem" class="header-top__search-icon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                            <div class="header-top__tools">
                                <div class="header-top__join">
                                    @auth
                                        <i class="header-top__join-login-icon fa-solid fa-user"></i>
                                        <div class="header-top__join-wrap">
                                            <span title="Thông tin" class="header-top__join-in">{{ Auth::user()->fullname }}</span>
                                            <ul class="header-top__join-menu">
                                                @if(Auth::user()->role == 'admin')
                                                    <li class="header-top__join-menu-items">
                                                        <a class="header-top__join-out" href="{{ url('/admin') }}">Quản lý trang web</a>
                                                    </li>
                                                @endif
                                                <li class="header-top__join-menu-items">
                                                    <a class="header-top__join-out" href="{{ url('/orders') }}">Đơn hàng</a>
                                                </li>
                                                <li class="header-top__join-menu-items">
                                                    <a class="header-top__join-out" href="{{ url('/logout') }}">Đăng xuất</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="header-top__cart">
                                            <a href="/cart" class="header-top__cart-link">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </a>
                                            <span class="header-top__cart-notify-num">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                                            <div class="header-top__cart-notify">
                                                @if(session('cart') && count(session('cart')) > 0)
                                                    <ul class="header-top__cart-notify-list">
                                                        @foreach(session('cart') as $key => $product)
                                                        @php
                                                            $dataproduct =App\Models\Product::where('id', $key)->first();
                                                            $subtotal = $product['quantity'] * $product['unit_price']; 
                                                        @endphp
                                                            <li class="header-top__cart-notify-items">
                                                                <div class="header-top__has-cart-notify">
                                                                    <img src="{{ asset('upload/' . $dataproduct->image) }}" alt="img__product" class="header-top__has-cart-img">
                                                                    <div class="header-top__has-cart-wrap">
                                                                        <div class="header-top__has-cart-info">
                                                                            <a href="{{ url('/productdetail', ['id' => $key]) }}" class="header-top__has-cart-title">{{ Str::limit($dataproduct->product_name, 40) }}</a>
                                                                            <a href="{{ url('/removecart', ['id' => $key]) }}" class="header-top__has-cart-delete">Xóa</a>
                                                                        </div>
                                                                        <div class="header-top__has-cart-gr">
                                                                            <div class="header-top__has-cart-quantity">
                                                                                <span class="header-top__has-cart-text">Số lượng:</span>
                                                                                <span>{{ $product['quantity'] }}</span>
                                                                            </div>
                                                                            <div class="header-top__has-cart-price">
                                                                                <span class="header-top__price-new">{{ Number::format($subtotal) }} đ</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="header-top__no-notify-text">Không có sản phẩm nào trong giỏ hàng của bạn</span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ url('/login') }}" class="header-top__join-login">
                                            Đăng nhập 
                                            <span>/</span>
                                        </a>
                                        <a href="{{ url('/register') }}" class="header-top__join-register">Đăng ký</a>
                                    @endauth
                                </div>
                                
                            </div>
                        </div>
                </div>
            </div>
                <div class="header-bottom">
                    <div class="grid wide">
                        <div class="header-bottom__gr">
                            <ul class="header-bottom__list">
                                <li class="header-bottom__items"><a href="{{ url('/') }}" class="header-bottom__items-link">Trang chủ</a></li>
                                <li class="header-bottom__items">
                                    <a href="{{ url('/productsgroup/all') }}" class="header-bottom__items-link">
                                        Sản phẩm <i class="fa-solid fa-circle-chevron-down"></i>
                                    </a>
                                    <div class="header-bottom__product-list">
                                        @foreach (App\Helper\AppHelper::product_groups() as $group)
                                            <a class="header-bottom__product-links" href="{{ url('productsgroup', ['id' => $group->id]) }}">
                                                {{ $group->group_name }}
                                            </a>
                                        @endforeach
                                        
                                    </div>
                                </li>
                                {{-- <li class="header-bottom__items"><a href="index_news.php" class="header-bottom__items-link">Tin tức</a></li> --}}
                                <li class="header-bottom__items"><a href="{{ url('/contact') }}" class="header-bottom__items-link">Liên hệ</a></li>
                            </ul>
                            <div class="header-bottom__call">
                                <span class="header-bottom__call-msg">
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <span class="header-bottom__call-msg-text">
                                        Số điện thoại:
                                        <a class="header-bottom__call-msg-num">0692348560</a>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
           
        </div>
        


@include('alert')