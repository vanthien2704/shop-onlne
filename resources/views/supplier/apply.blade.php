@include('partial_user.headernguoidung')
<div class="contact">
    <div class="grid wide">
        <div class="row">
            <div class="col l-6">
                <h3 class="contact__heading">
                    Đăng ký nhà bán hàng
                </h3>
                @if(session('success'))
                    <h1 class="alert alert-success" style="color: red;">
                        {{ session('success') }}
                    </h1>
                @endif
                <form action="{{ url('/dkapply') }}" method="post">
                    @csrf
                    <div class="contact__info">
                        <div class="contact__gr">
                            <input type="text" class="contact__gr-input" name="name" placeholder="Họ và tên" required>
                        </div>
                        <div class="contact__gr">
                            <input type="email" class="contact__gr-input" name="email" placeholder="Email" required>
                        </div>
                        <div class="contact__gr">
                            <input type="text" class="contact__gr-input" name="phone" placeholder="Điện thoại" required>
                        </div>
                        <div class="contact__gr">
                            <textarea id="ghichu"  cols="30" rows="8" name="content" class="contact__gr-input" placeholder="Nội dung"></textarea>
                        </div>
                    </div>
                    <div class="contact__btn">
                        <button type="submit" class="contact__btn-link" name="tbOk">Gửi thông tin</button>
                    </div>
                </form>
            </div>
            <div class="col l-6">
                <div class="contact__hamster">
                    <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
                        <div class="wheel"></div>
                        <div class="hamster">
                            <div class="hamster__body">
                                <div class="hamster__head">
                                    <div class="hamster__ear"></div>
                                    <div class="hamster__eye"></div>
                                    <div class="hamster__nose"></div>
                                </div>
                                <div class="hamster__limb hamster__limb--fr"></div>
                                <div class="hamster__limb hamster__limb--fl"></div>
                                <div class="hamster__limb hamster__limb--br"></div>
                                <div class="hamster__limb hamster__limb--bl"></div>
                                <div class="hamster__tail"></div>
                            </div>
                        </div>
                        <div class="spoke"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding: 30px;"></div>
@include('partial_user.footernguoidung')