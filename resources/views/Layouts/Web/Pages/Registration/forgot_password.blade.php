@extends('Layouts.Web.Pages.app')
@section('title','Quên mật khẩu')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Quên mật khẩu')
        @slot('activeName','Quên mật khẩu')
    @endcomponent
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pl-lg-0">
                    <div class="login_form_inner">
                        <h3 style="margin-top: -100px">Khôi phục mật khẩu</h3>
                        @if(session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        <form class="row login_form" action="{{url('auth/signin')}}" method="POST">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Khôi phục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
