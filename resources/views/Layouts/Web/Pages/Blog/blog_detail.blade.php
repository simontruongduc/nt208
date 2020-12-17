@extends('Layouts.Web.Pages.app')
@section('title','Đăng nhập')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Blog')
        @slot('activeName','Blog')
    @endcomponent

@stop
