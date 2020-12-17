@extends('adminlte::page')

@section('title', 'Sale')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Sale')
        @slot('activePage','Sale')
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
                                        <input type="text" class="form-control" id="inputSuccess"
                                               placeholder="Tìm kiếm bằng email...">
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
                                <th>Product name</th>
                                <th>Category</th>
                                <th>Producer</th>
                                <th>Sale</th>
                                <th>Qty</th>
                                <th>Date start</th>
                                <th>Date finish</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <a href="{{url('cms/product/'.$sale->product_id)}}}">{{optional($sale->product)->name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{url('cms/category/'.optional($sale->product->category)->id)}}}">{{optional($sale->product->category)->name}}
                                    </td>
                                    <td>
                                        <a href="{{url('cms/product/'.optional($sale->product->producer)->id)}}}">{{optional($sale->product->producer)->name}}
                                    </td>
                                    <td>{{($sale->sale*100).'%'}}</td>
                                    <td>{{$sale->qty}}</td>
                                    <td>{{$sale->date_start}}</td>
                                    <td>{{$sale->date_finish}}</td>
                                    <td>{{date('d-m-Y',strtotime($sale->created_at))}}</td>
                                    <td>{{date('d-m-Y',strtotime($sale->updated_at))}}</td>
                                    <td>
                                        <a href="{{url('cms/sale/'.$sale->id)}}" type="button"
                                           class="btn btn-block btn-primary">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{$sales->links()}}
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
