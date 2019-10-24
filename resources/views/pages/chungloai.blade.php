@extends('index')

@section('title')
    {{$loai_sp->name}}
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản phẩm</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trangchu')}}">Home</a> / <span>{{$loai_sp->name}}</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                            @foreach($loai as $l)
                                <li><a href="{{route('chungloai', $l->id)}}">{{$l->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Danh sách sản phẩm</h4>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <?php $item = 0 ?>
                                @foreach($sanpham as $sp)
                                    <?php $item++ ?>
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
                                                <a class="add-to-cart pull-left"
                                                   href="{{route('themgiohang',$sp->id)}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="beta-btn primary" href="{{route('chitiet',$sp->id)}}">Details
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item == 3)
                                        <div class="space50">&nbsp;</div>
                                    @endif
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="row">
                            {{$sanpham->links()}}
                        </div>

                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection
