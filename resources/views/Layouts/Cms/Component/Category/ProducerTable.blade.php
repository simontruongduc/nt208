<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Producer</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Product number</th>
                            <th>Categories number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($producers as $producer)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$producer->name}}</td>
                                <td>{{$producer->products()->count()}}</td>
                                <td>{{$producer->categories()->count()}}</td>
                                <td>
                                    <a href="{{url('cms/producer/'.$producer->id)}}" type="button" class="btn btn-block btn-primary">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{$producers->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->