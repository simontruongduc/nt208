@extends('Layouts.Web.Pages.app')
@section('title','Liên hệ')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Tìm kiếm')
        @slot('activeName','Kết quả tìm kiếm')
    @endcomponent
    @component('Layouts.Web.Components.search')
        @slot('products',$products)
    @endcomponent
@stop