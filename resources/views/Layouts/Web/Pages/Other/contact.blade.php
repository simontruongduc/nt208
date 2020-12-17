@extends('Layouts.Web.Pages.app')
@section('title','Liên hệ')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Liên hệ với chúng tôi')
        @slot('activeName','Liên hệ')
    @endcomponent
    <!--================Contact Area =================-->
    <section class="contact_area section_gap_bottom">
        <div class="container">
            <div class="row" style="margin-top: 50px;">
                <div class="col-lg-3">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>153 Lý Thường Kiệt, Phường 7, Quận 11</h6>
                            <p>Tp Hồ Chí Minh</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6><a href="tel:+84965416804">+84 965 416 804</a></h6>
                            <p>( 8-21h kể cả T7 và CN)</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="mailto:heijizhang@gmail.com">heijizhang@gmail.com</a></h6>
                            <p>hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form class="row contact_form" action="{{url('/sendMessage')}}" method="post" id="contactForm"
                          novalidate="novalidate">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên">
                                @if ($errors->has('name'))
                                    <p style="color: red">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <p style="color: red">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject"
                                       placeholder="Tiêu đề">
                                @if ($errors->has('subject'))
                                    <p style="color: red">{{ $errors->first('subject') }}</p>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="1"
                                          placeholder="Tin nhắn"></textarea>
                            </div>
                            @if ($errors->has('message'))
                                <p style="color: red">{{ $errors->first('message') }}</p>
                            @endif
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" value="submit" class="primary-btn">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
@stop