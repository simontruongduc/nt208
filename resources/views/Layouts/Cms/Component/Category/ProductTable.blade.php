<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Product</h3>
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