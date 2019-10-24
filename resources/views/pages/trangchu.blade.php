@extends('index')

@section('title')
    Trang chủ
@endsection

@section('content')
    @include('layout.slide')
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($sp_moi as $spm)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if ($spm->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitiet',$spm->id)}}">
                                                    <img style="width: 270px;height: 310px"
                                                         src="image/product/{{$spm->image}}">
                                                </a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$spm->name}}</p>
                                                <p class="single-item-price">
                                                    @if ($spm->promotion_price == 0)
                                                        <span>{{$spm->unit_price}} VND</span>
                                                    @else
                                                        <span class="flash-del">{{$spm->unit_price}} VND</span>
                                                        <span class="flash-sale">{{$spm->promotion_price}} VND</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                   href="{{route('themgiohang', $spm->id)}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="beta-btn primary" href="{{route('chitiet',$spm->id)}}">Details
                                                    <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                {{$sp_moi->links()}}
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khuyến mãi</h4>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <?php $item = 0 ?>
                                @foreach($sp_khuyenmai as $spkm)
                                    <?php $item++ ?>
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                            <div class="single-item-header">
                                                <a href="{{route('chitiet',$spkm->id)}}">
                                                    <img style="width: 270px;height: 310px"
                                                         src="image/product/{{$spkm->image}}">
                                                </a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$spkm->name}}</p>
                                                <p class="single-item-price">
                                                    <span class="flash-del">{{$spkm->unit_price}} VND</span>
                                                    <span class="flash-sale">{{$spkm->promotion_price}} VND</span>
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                   href="{{route('themgiohang', $spkm->id)}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="beta-btn primary" href="{{route('chitiet',$spkm->id)}}">Details
                                                    <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item == 4)
                                        <div class="space50">&nbsp;</div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row">
                                {{$sp_khuyenmai->links()}}
                            </div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->

            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection
