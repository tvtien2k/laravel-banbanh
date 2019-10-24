<div class="header-top">
    <div class="container">
        <div class="pull-left auto-width-left">
            <ul class="top-menu menu-beta l-inline">
                <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
            </ul>
        </div>
        <div class="pull-right auto-width-right">
            <ul class="top-details menu-beta l-inline">
                @if(Auth::check())
                    <li><a><i class="fa fa-user"></i>{{Auth::user()->full_name}}</a></li>
                    <li><a href="{{route('dangxuat')}}"><i class="fa fa-user"></i>Đăng xuất</a></li>
                @else
                    <li><a href="{{route('dangki')}}">Đăng kí</a></li>
                    <li><a href="{{route('dangnhap')}}">Đăng nhập</a></li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- .container -->
</div>
