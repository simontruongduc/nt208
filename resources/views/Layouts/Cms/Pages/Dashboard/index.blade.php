@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Dashboard')
        @slot('activePage','Dashboard')
    @endcomponent
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @component('Layouts.Cms.Component.Dashboard.controlBox')
                @slot('newOrderCount',$controlBox->newOrderCount)
                @slot('newMessageCount',$controlBox->newMessageCount)
                @slot('revenue',$controlBox->revenue)
            @endcomponent
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
