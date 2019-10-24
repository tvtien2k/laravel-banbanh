@extends('index')

@section('title')
    {{$sanpham->name}}
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Chi tiết sản phẩm</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trangchu')}}">Home</a> / <span>{{$sanpham->name}}</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            @if ($sanpham->promotion_price != 0)
                                <div class="ribbon-wrapper">
                                    <div class="ribbon sale">Sale</div>
                                </div>
                            @endif
                            <div class="single-item-header">
                                <img style="width: 270px;height: 300px" src="image/product/{{$sanpham->image}}">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title">{{$sanpham->name}}</p>
                                <p class="single-item-price">
                                    @if ($sanpham->promotion_price == 0)
                                        <span>{{$sanpham->unit_price}} VND</span>
                                    @else
                                        <span class="flash-del">{{$sanpham->unit_price}} VND</span>
                                        <span class="flash-sale">{{$sanpham->promotion_price}} VND</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$sanpham->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>
                            <form action="{{route('postthemgiohang')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="id" value="{{$sanpham->id}}"/>
                                <p>Chọn số lượng:</p>
                                <div class="space10">&nbsp;</div>
                                <div class="single-item-options">
                                    <select class="wc-select" name="qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <button type="submit" class="add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Mô tả</a></li>
                        </ul>
                        <div class="panel" id="tab-description">
                            <p>{{$sanpham->description}}</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản phẩm liên quan</h4>

                        <div class="row">
                            @foreach($sp_lienquan as $sp)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        @if ($sp->promotion_price != 0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('chitiet',$sp->id)}}">
                                                <img style="width: 270px;height: 310px"
                                                     src="image/product/{{$sp->image}}">
                                            </a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$sp->name}}</p>
                                            <p class="single-item-price">
                                                @if ($sp->promotion_price == 0)
                                                    <span>{{$sp->unit_price}} VND</span>
                                                @else
                                                    <span class="flash-del">{{$sp->unit_price}} VND</span>
                                                    <span class="flash-sale">{{$sp->promotion_price}} VND</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{route('themgiohang', $sp->id)}}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('chitiet',$sp->id)}}">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Best Sellers</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/1.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/2.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/3.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/4.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">New Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/1.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/2.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/3.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/4.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div>
@endsection
