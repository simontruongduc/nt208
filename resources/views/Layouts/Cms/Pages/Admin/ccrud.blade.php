@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Admin')
        @slot('activePage','Admin')
    @endcomponent
@stop
@section('content')

@stop
