@extends('Layouts.Web.Pages.app')
@section('title','Đăng nhập')
@section('css')
<style>
    
</style>
@stop
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Đăng nhập')
        @slot('activeName','Đăng nhập')
    @endcomponent

    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pl-lg-0">
                    <div class="login_form_inner">
                        <h3 style="margin-top: -100px">Đăng nhập</h3>
                        @if(session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        <form class="row login_form" action="{{url('auth/signin')}}" method="POST">
                            @csrf
                            @if(session('backUrl'))
                                <input type="hidden" name="backUrl" value="{{session('backUrl')}}">
                            @endif
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block" style="margin-left: 14px;color: red;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Đăng nhập</button>
                                <a href="{{url('auth/forgot_password')}}">Quên mật khẩu?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pr-lg-0">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4 class="new">Bạn chưa có tài khoản ?</h4>
                            <p>Chỉ cần vài bước đơn giản để đăng ký tài khoản hoặc kết nối nhanh với chúng tôi qua
                                facebook hoặc google.</p>
                            <a class="primary-btn create" href="{{url('auth/signup')}}">Đăng ký tài khoản</a><br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('/auth/redirect/google') }}"
                                       class="genric-btn danger-border google"><i class="fa fa-google"></i> Đăng nhập
                                        bằng Google</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('/auth/redirect/facebook') }}"
                                       class="genric-btn info-border face"><i class="fa fa-google"></i> Đăng nhập bằng
                                        facebook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop