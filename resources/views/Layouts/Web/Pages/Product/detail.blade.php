@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')

@section('css')
    <link rel="stylesheet" href="css/topbar.min.css">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=417912232463301&autoLogAppEvents=1"></script>
@stop
@section('content')
    <div id="fb-root"></div>
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Sản phẩm')
        @slot('activeName','Sản phẩm')
    @endcomponent
    @component('Layouts.Web.Components.product.introduce')
        @slot('product',$product)
    @endcomponent
    @component('Layouts.Web.Components.product.detail')
        @slot('product',$product)
    @endcomponent
    @component('Layouts.Web.Components.product.suggestion')
        @slot('products',$suggestions)
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
    <script>
      $('.add_cart').click(function( event ) {
        event.preventDefault()
        var id = $(this).data('id');
        $.ajax({
          type:'GET',
          url :'/cart/add/'+ id,
          contentType: false, // The content type used when sending data to the server.
          cache: false, // To unable request pages to be cached
          processData: false,
        }).done(function(res){
          if(res.status != 200 ){
            window.location.href = "/auth/login"
          }
          $("#topbar").show();
          setTimeout(function(){$("#topbar").hide(); }, 30000);
        }).fail(function(error){
          if(error.status != 500 ){
            window.location.href = "/auth/login"
          }
        });
      });
    </script>
@stop
