@extends('Layouts.Web.Pages.app')
@section('title','Trang chủ')
@section('css')
    <link rel="stylesheet" href="css/topbar.min.css">
@stop
@section('content')
    @component('Layouts.Web.Components.home.features')
    @endcomponent
    @component('Layouts.Web.Components.home.latest_product')
        @slot('products',$products)
    @endcomponent
    @component('Layouts.Web.Components.home.deal_product')
        @slot('deal_products',$deal_products)
    @endcomponent
    <input type="checkbox" id="toggleTop" name="toggleTop" value="toggleTop" checked="checked">
    <!-- The Notification bar container -->
    <div id="topbar">
        <p style="float: left;margin-top: 30px;margin-left: 10px" >Sản phẩm đã được thêm vào gỏ hàng. <a href="{{url('cart')}}" > Đến giỏ hàng.</a></p>
        <!-- Label to Hide Notification bar -->
        <label for="toggleTop" id="hideTop" style="float: right">x</label>
    </div>
@stop
@section('js')
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v7.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="109239384184754"
         theme_color="#ff7e29"
         logged_in_greeting="Xin chào. Chúng tôi có thể giúp gì cho bạn?"
         logged_out_greeting="Cảm ơn bạn đã quan tâm đến chúng tôi. Chúc bạn một ngày vui vẻ!">
    </div>
@stop