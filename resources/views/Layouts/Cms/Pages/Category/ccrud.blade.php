@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Category')
        @slot('activePage','category')
    @endcomponent
@stop
@section('css')
    <style>
        @if($type == 'view' || $type== 'confirm')
        .cms-input-form {
            display: none;
            float: right;
        }

        @endif
        .lable-text {
            float: left;
            text-align: center;
            @if($type == 'edit'||$type=='create')
                      display: none;
        @endif



        }
    </style>
@stop
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            @if($type == 'view')
                <h3 class="box-title">Category detail</h3>
            @elseif($type == 'create')
                <h3 class="box-title">Create category</h3>
            @elseif($type == 'edit')
                <h3 class="box-title">Edit category</h3>
            @else
                <h3 class="box-title">Confirm</h3>
            @endif
            @if($type == 'view')
                <button type="button" class="btn btn-danger pull-right" style="margin-left: 10px" data-toggle="modal"
                        data-target="#deleteModel">Delete
                </button>
                <a type="button" class="btn btn-info pull-right" href="{{url('cms/category/'.$category->id.'/edit')}}">Edit</a>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST"
              @if($type == 'edit')
              action="{{url('cms/category/confirm')}}"
              @elseif($type == 'confirm')
                  @if($category->type == 'edit')
                  action="{{url('cms/category/'.$category->id)}}"
                  @else
                  action="{{url('cms/category')}}"
                  @endif
              @elseif($type == 'create')
              action="{{url('cms/category/confirm')}}"
                @endif

        >
            <div class="box-body">
                <div class="form-group col-sm-6">
                    <label for="inputEmail3" class="col-sm-3 control-label">Name :</label>
                    <div class="col-sm-9">
                        @csrf
                        @if(isset($category->id))
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{$category->id}}">
                        @endif
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="text" class="form-control cms-input-form" required name="name"
                               @if($type == 'edit' || $type == 'confirm')
                               value="{{\App\Enums\CategoryEnum::getDispValue($category->name)}}"
                                @endif
                        >
                        @if($type == 'view' || $type == 'confirm')
                            <label class="lable-text control-label">{{\App\Enums\CategoryEnum::getDispValue($category->name)}}</label>
                        @endif
                    </div>
                </div>
                @if($type == 'view')
                    <div class="form-group col-sm-3">
                        <label for="inputEmail3" class="col-sm-10 control-label">Product of category :</label>
                        <div class="col-sm-2">
                            <label class="control-label">{{$products->count()}}</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="inputEmail3" class="col-sm-10 control-label">Producer of category :</label>
                        <div class="col-sm-2">
                            <label class="control-label">{{$producers->count()}}</label>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            @if($type == 'edit' || $type == 'create' || $type == 'confirm')
                <div class="box-footer">
                    <button type="submit" class="btn btn-default pull-right" style="margin-left: 10px">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
        @endif
        <!-- /.box-footer -->
        </form>
    </div>
    @if($type == 'view')
        @component('Layouts.Cms.Component.Category.ProducerTable')
            @slot('producers',$producers);
        @endcomponent
        @component('Layouts.Cms.Component.Category.ProductTable')
            @slot('products',$products);
        @endcomponent
        @component('Layouts.Cms.Component.Model.Model')
        @endcomponent
    @endif
@stop
