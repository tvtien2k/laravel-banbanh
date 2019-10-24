<div class="header-body">
    <div class="container beta-relative">
        <div class="pull-left">
            <a href="index.html" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
        </div>
        <div class="pull-right beta-components space-left ov">
            <div class="space10">&nbsp;</div>
            <div class="beta-comp">
                <form role="search" method="get" id="searchform" action="{{route('timkiem')}}">
                    <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..."/>
                    <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                </form>
            </div>

            <div class="beta-comp">
                <div class="cart">
                    <div class="beta-select"><i class="fa fa-shopping-cart"></i>
                        Giỏ hàng
                        @if (Session::has('cart'))
                            {{Session('cart')->totalQty}}
                            <i class="fa fa-chevron-down"></i>
                        @else
                            {{"(Trống)"}}
                        @endif
                    </div>
                    @if (Session::has('cart'))
                        <div class="beta-dropdown cart-body">
                            @foreach($product_cart as $product)
                                <div class="cart-item">
                                    <div class="media">
                                        <a class="pull-left">
                                            <img src="image/product/{{$product['item']['image']}}">
                                        </a>
                                        <div class="media-body">
                                            <p class="cart-item-title">{{$product['item']['name']}}</p>
                                            <p class="cart-item-amount">
                                                {{$product['qty']}}*
                                                @if ($product['item']['promotion_price'] == 0)
                                                    <span>{{$product['item']['unit_price']}} VND</span>
                                                @else
                                                    <span>{{$product['item']['promotion_price']}} VND</span>
                                                @endif
                                            </p>
                                        </div>
                                        <a class="cart-item-delete" href="{{route('xoagiohang', $product['item']['id'])}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền: <span
                                        class="cart-total-value">{{Session('cart')->totalPrice}} VND</span></div>
                                <div class="clearfix"></div>

                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="{{route('dathang')}}" class="beta-btn primary text-center">
                                        Đặt hàng
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div> <!-- .cart -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div> <!-- .container -->
</div>
