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