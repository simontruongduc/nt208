@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','User')
        @slot('activePage','User')
    @endcomponent
@stop
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
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
                                    <div class="form-group has-warning col-md-6">
                                        <label class="control-label" for="inputWarning">Họ tên</label>
                                        <input type="text" class="form-control" id="inputWarning" placeholder="Tìm kiếm bằng họ tên...">
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
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>full name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><span class="badge bg-red">55%</span></td>
                                <td>{{date('d-m-Y',strtotime($user->created_at))}}</td>
                                <td>
                                    <a href="{{url('cms/user/'.$user->id)}}" type="button" class="btn btn-block btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                           @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
