@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Product')
        @slot('activePage','Product')
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
                                <th>Producer name</th>
                                <th>Category name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{optional($product->producer)->name}}</td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{number_format($product->price).'Vnd'}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>{{date('d-m-Y',strtotime($product->created_at))}}</td>
                                    <td>{{date('d-m-Y',strtotime($product->updated_at))}}</td>
                                    <td>
                                        <a href="{{url('cms/product/'.$product->id)}}" type="button" class="btn btn-block btn-primary">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{$products->links()}}
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
