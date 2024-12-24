<div class="container">
    <div class="slideshow-container">
        <div class="mySlides">
            <img src="assets/img/img1.png">
        </div>
        <div class="mySlides">
            <img src="assets/img/img2.png">
        </div>
        <div class="mySlides">
            <img src="assets/img/img4.png">
        </div>
    </div>
      
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");

            // Ẩn tất cả các slides
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            // Hiển thị slide hiện tại
            slides[slideIndex - 1].style.display = "block";

            setTimeout(showSlides, 4000); // Thay đổi thời gian hiển thị ở đây (3000 -> 3 giây)
        }
    </script>
    <div class="support">
        <div class="grid wide">
            <div class="row">
                <div class="col c-3">
                    <div class="support__item">
                        <img src="assets/img/sup1.jpg" alt="img__sup" class="support__img">
                        <h3 class="support__heading">Miễn phí giao hàng</h3>
                        <p class="support__msg">Miễn phí ship với đơn hàng > 498K</p>
                    </div>
                </div>
                <div class="col c-3">
                    <div class="support__item">
                        <img src="assets/img/sup2.jpg" alt="img__sup" class="support__img">
                        <h3 class="support__heading">Thanh toán COD</h3>
                        <p class="support__msg">Thanh toán khi nhận hàng(COD)</p>
                    </div>
                </div>
                <div class="col c-3">
                    <div class="support__item">
                        <img src="assets/img/sup3.jpg" alt="img__sup" class="support__img">
                        <h3 class="support__heading">Khách hàng vip</h3>
                        <p class="support__msg">Ưu đãi dành cho khách hàng vip</p>
                    </div>
                </div>
                <div class="col c-3">
                    <div class="support__item">
                        <img src="assets/img/sup4.jpg" alt="img__sup" class="support__img">
                        <h3 class="support__heading">Hỗ trợ bảo hành</h3>
                        <p class="support__msg">Đổi , sửa đồ lại tất cả store</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product">
        <div class="grid wide">
            <h3 class="product__heading">Sản Phẩm Hot</h3>
            <div class="row">
                @foreach(App\Helper\AppHelper::products10() as $product)
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