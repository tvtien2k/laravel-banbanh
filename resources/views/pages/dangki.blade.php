@extends('index')

@section('title')
    Đăng kí
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng kí</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('trangchu')}}">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}<br>
                    @endforeach
                </div>
            @endif
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <form action="{{route('dangki')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="your_last_name">Họ tên*</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-block">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" name="address" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Số điện thoại*</label>
                            <input type="text" name="phone" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Re password*</label>
                            <input type="password" name="repassword" required>
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Đăng kí</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div>
@endsection
