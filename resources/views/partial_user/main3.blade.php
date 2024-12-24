<div class="sale">
    <div class="grid wide">
        <h3 class="product__heading">Sale đồng giá - Đừng lo về giá</h3>
        <div class="sale__bgr">
            <img src="assets/img/img4.png" alt="Banner Sale" class="sale__bgr-img">
        </div>
        <div class="row">
            @foreach (App\Helper\AppHelper::discountedProducts() as $product)
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
                                <input type="hidden" name="quantity" min="1" max="10" value="1">
                                <input type="hidden" name="unit_price" value="{{ $product->unit_price }}">
                            </form>
                        </div>
        
                        <div class="product__items-links">
                            <a href="{{ url('/productdetail', ['id' => $product->id]) }}" class="product__items-name">{{ Str::limit($product->product_name, 40) }}</a>
                        </div>
        
                        <div class="product__items-price">
                            <span class="product__items-price-old">{{ Number::format($product->old_unit_price) }}₫</span>
                            <span class="product__items-price-new">{{ Number::format($product->unit_price) }}₫</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="product__button">
            <a href="{{ url('/productsgroup/all') }}" class="product__button-link">Xem tất cả</a>
        </div>
    </div>
</div>