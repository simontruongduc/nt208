@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')
@section('css')
    <link rel="stylesheet" href="css/topbar.min.css">
@stop
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Sản phẩm')
        @slot('activeName','Sản phẩm')
    @endcomponent
    @component('Layouts.Web.Components.category')
        @slot('categories',$categories)
        @slot('producers',$producers)
        @slot('products',$products)
        @slot('paginate',$paginate)
    @endcomponent
@stop