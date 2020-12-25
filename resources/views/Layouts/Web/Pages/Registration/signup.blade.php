@extends('Layouts.Web.Pages.app')
@section('title','Đăng ký')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Đăng ký')
        @slot('activeName','Đăng ký tài khoản')
    @endcomponent
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pl-lg-0">
                    <div class="login_form_inner">
                        <h3 style="margin-top: -100px">Đăng ký tài khoản</h3>
                        @if(session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        <form class="row login_form" action="{{Route('auth.signup')}}" method="POST">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block" style="margin-left: 14px;color: red;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control"  name="password" placeholder="Mật khẩu" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block" style="margin-left: 14px;color: red;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control"  name="confirm_password" placeholder="Nhập lại mật khẩu" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập lại mật khẩu'">
                            </div>
                            @if ($errors->has('confirm_password'))
                                <span class="help-block" style="margin-left: 14px;color: red;">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pr-lg-0">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4 class="new">Bạn đã có tài khoản ?</h4>
                            <p>Đăng nhập và để nhận ưu đãi mua sắm phụ kiện cho dế yêu...</p>
                            <a class="primary-btn create" href="{{url('auth/login')}}">Đăng nhập</a><br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('/auth/redirect/google') }}"
                                       class="genric-btn danger-border google settingg"><i class="fa fa-google"></i> Đăng nhập
                                        bằng Google</a>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ url('/auth/redirect/facebook') }}"
                                       class="genric-btn info-border face settingf"><i class="fa fa-google"></i> Đăng nhập bằng
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
