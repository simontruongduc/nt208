@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Cảm ơn bạn!')
        @slot('activeName','thanks')
    @endcomponent
    <section class="sample-text-area">
        <div class="container">
            <h3 class="text-heading" style="font-size: 30px">Cảm ơn bạn!</h3>
            <p class="sample-text">
                Cảm ơn quý khách vì những đóng góp cho shop.
                Phản hồi của quý khách đã được hệ thống ghi nhận và sớm được chuyển giao cho bộ phận chăm sóc khách
                hàng.
                Với phương châm "Vì sự hài lòng cao nhất của khách hàng",
                trong thời gian qua, shop đã và đang không ngừng phấn đấu, nâng cao chất lượng
                để mang lại nhiều lợi ích hơn và có thể đáp ứng mọi yêu cầu của khách hàng.
                Một lần nữa, shop xin được gửi lời cảm ơn chân thành đến quý khách.
                Kính chúc quý khách sức khỏe, may mắn, thành công và luôn đồng hành cùng shop.

            </p>
            <div class="checkout_btn_inner d-flex align-items-center">
                <a class="gray_btn" href="{{url('index')}}">Trang chủ</a>
            </div>
        </div>
    </section>
@stop
