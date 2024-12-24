@include('partial_user.headernguoidung')

<style>
    /* Định dạng cho khối chứa các liên kết phân trang */
    .link_admin-footer {
        padding: 30px 0; /* Khoảng cách trên và dưới */
    }

    /* Định dạng cho các liên kết phân trang */
    .link_admin-footer .pagination {
        display: flex; /* Chắc chắn rằng các item sẽ hiển thị theo hàng ngang */
        justify-content: center; /* Canh giữa các item */
        list-style: none; /* Xóa bỏ các dấu chấm mặc định của list */
        margin: 0; /* Xóa bỏ khoảng cách mặc định */
        padding: 0; /* Xóa bỏ padding mặc định */
    }

    /* Định dạng các item trong pagination */
    .link_admin-footer .pagination .page-item {
        margin: 0 5px; /* Khoảng cách giữa các item */
    }

    /* Định dạng các liên kết trang */
    .link_admin-footer .pagination .page-link {
        color: #000000; /* Màu chữ */
        background-color: #fff; /* Màu nền trắng */
        border: 1px solid #dee2e6; /* Màu viền */
        border-radius: 4px; /* Bo góc các trang */
        padding: 8px 16px; /* Khoảng cách xung quanh chữ */
        text-decoration: none; /* Xóa gạch chân */
        display: block; /* Đảm bảo page-link chiếm toàn bộ không gian của page-item */
    }

    /* Định dạng khi hover (di chuột) lên trang */
    .link_admin-footer .pagination .page-link:hover {
        color: #000000; /* Màu chữ khi hover */
        background-color: #f7ebdb; /* Màu nền khi hover */
        border-color: #f7ebdb; /* Màu viền khi hover */
    }

    /* Định dạng cho trang hiện tại */
    .link_admin-footer .pagination .active .page-link {
        color: #000000;
        background-color: #f7ebdb; /* Màu nền trang hiện tại */
        border-color: #f7ebdb; /* Màu viền trang hiện tại */
    }

    /* Định dạng cho các trang đã bị vô hiệu hóa */
    .link_admin-footer .pagination .disabled .page-link {
        color: #6c757d; /* Màu chữ cho trang disabled */
        background-color: #e9ecef; /* Màu nền cho trang disabled */
        border-color: #e9ecef; /* Màu viền cho trang disabled */
    }

</style>


<div class="all">
    <div class="all-banner">
        <img src="{{ asset('assets/img/all.jpg') }}" alt="all-banner" class="all-banner__img">
    </div>
    <div class="all-product">
        <div class="grid wide">
            <h3 class="product__heading">Sản Phẩm</h3>
            <div class="row">
                @foreach ($group as $product)
                <div class="col l-2-4">
                    <div class="product__items">
                        <div class="product__items-wrap">
                            <a href="{{ url('/productdetail', ['id' => $product->id]) }}" class="product__items-wrap-link">
                                <img src="{{ asset('upload/' . $product->image) }}" alt="" class="product__items-img">
                            </a>
                            <form action="{{ url('/addtocart') }}" method="post" class="product__items-cart">
                                @csrf
                                <i class="product__items-cart-icon fa-solid fa-cart-plus"></i>
                                <input type="submit" value="Thêm vào giỏ hàng" name="addcart" class="product__items-more-cart">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="unit_price" value="{{ $product->unit_price }}">
                            </form>
                        </div>
                        <div class="product__items-links">
                            <a href="{{ url('/productdetail', ['id' => $product->id]) }}" class="product__items-name">{{ Str::limit($product->product_name, 40) }}</a>
                        </div>
                        <div class="product__items-price">
                            <span class="product__items-price-old">{{ Number::format($product->old_unit_price) }}₫</span>
                            <span class="product__items-price-new">{{ Number::format($product->unit_price)  }}₫</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="link_admin-footer d-flex justify-content-center">
                {{ $group->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@include('partial_user.footernguoidung')
