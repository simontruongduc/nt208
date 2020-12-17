@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Categories')
        @slot('activePage','Categories')
    @endcomponent
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div>
                            <div class="box-body">
                                <form role="form">
                                    <!-- input states -->
                                    <div class="form-group has-success col-md-6">
                                        <label class="control-label" for="inputSuccess">Email</label>
                                        <input type="text" class="form-control" id="inputSuccess" placeholder="Tìm kiếm bằng email...">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-block btn-success btn-lg" style="margin-left: 15px;
    height: 42px;width: 100px">Tìm kiếm
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Products number</th>
                                <th>Producer number</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->products()->count()}}</td>
                                <td>{{$category->producers()->count()}}</td>
                                <td>
                                    <a href="{{url('cms/category/'.$category->id)}}" type="button" class="btn btn-block btn-primary">Detail</a>
                                </td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{$categories->links()}}
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
