@include('partial_user.headernguoidung')
<div class="detail">
    <div class="grid wide">
        <div class="row">
            <div class="col l-6">
                <div class="detail-items">
                    <img src="{{ asset('upload/' . $product->image) }}" alt="" class="detail-items__img">
                </div>
            </div>
            <div class="col l-6">
                <div class="detail-items">
                    <h3 class="detail-items__heading">{{ $product->product_name }}</h3>
                    <p class="detail-items__code">Mã sp: {{ $product->id }}</p>
                    <div class="detail-items__price">
                        <span class="detail-items__price-new">{{ Number::format($product->unit_price) }}₫</span>
                        <span class="detail-items__price-old">{{ Number::format($product->old_unit_price) }}₫</span>
                        <span class="detail-items__price-sale">Sale</span>
                    </div>
                    <div class="detail-items__support">
                        <div class="detail-items__support-gr">
                            <img src="{{ asset('assets/img/img_sup5.jpg') }}" alt="" class="detail-items__support-gr-img">
                            <div class="detail-items__support-gr-info">
                                <h3 class="detail-items__support-gr-title">Miễn phí vận chuyển</h3>
                                <p class="detail-items__support-gr-msg">Cho đơn hàng từ 499.000₫</p>
                            </div>
                        </div>
                        <div class="detail-items__support-gr">
                            <img src="{{ asset('assets/img/img_sup6.jpg') }}" alt="" class="detail-items__support-gr-img">
                            <div class="detail-items__support-gr-info">
                                <h3 class="detail-items__support-gr-title">Miễn phí đổi, sửa hàng</h3>
                                <p class="detail-items__support-gr-msg">Đổi hàng trong 30 ngày kể từ ngày mua, hỗ trợ sửa đổi miễn phí</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-items__warehouse">
                        <p class="detail-items__warehouse-remaining"><strong>{{ $product->description }}</strong></p>
                    </div>
                    <div class="detail-items__warehouse">
                        <p class="detail-items__warehouse-remaining"><strong>Kho hàng còn</strong>: {{ $product->quantity }} cái</p>
                    </div>
                    <form action="{{ url('/addtocart') }}" method="post" class="detail-items__quantity">
                        @csrf
                        <p class="detail-items__quantity-text">Số lượng:</p>
                        <input class="detail-items__quantity-num" type="number" name="quantity" min="1" max="10" value="1">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="unit_price" value="{{ $product->unit_price }}">
                        <input type="submit" value="Thêm vào giỏ hàng" name="addcart" class="detail-items__btn-cart">
                    </form>
                    <form action="{{ url('/addtocart') }}" method="post" class="detail-items__btn">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="unit_price" value="{{ $product->unit_price }}">
                        <input type="submit" value="Mua Ngay" name="addcart" class="detail-items__btn-buy">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-same">
    <div class="grid wide">
        <h3 class="product-same__heading">Đánh giá sản phẩm:</h3>
        @if ($iscomment)
            <form action="{{ url('/addcomment')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}" />
                <textarea name="content" placeholder="Nhập nhận xét của bạn..." required style="width: 100%; height: 100px; font-size: 18px;"></textarea>
                <br />
                <button type="submit" class="detail-items__btn-cart">Gửi đánh giá</button>
            </form>
        @endif

        @foreach ($commentall as $comment)
            <div class="detail-items__support-gr">
                <i class="fa-solid fa-user fa-5x"></i>
                <div class="detail-items__support-gr-info">
                    <h3 class="detail-items__support-gr-title">{{$comment->user->fullname}}</h3>
                    <p class="detail-items__support-gr-msg">{{$comment->content}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="product-same">
    <div class="grid wide">
        <h3 class="product-same__heading">Sản phẩm khác</h3>
        <div class="row">
            @foreach(App\Helper\AppHelper::discountedProducts() as $product)
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
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="id" value="{{ $product->id }}">
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
    </div>
</div>

<div style="padding: 30px;"></div>

@include('partial_user.footernguoidung')