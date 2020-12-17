<section class="section_gap">
    <!-- single product slide -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Sản phẩm mới nhất</h1>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <?php $product = (object)$product ?>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="single-product">
                        <a href="{{url('product/'.$product->route_name)}}"><img src="img/product/{{$product->image}}" class="img-fluid" ></a>
                        <div class="product-details">
                            <h6 style="height: 45px"><a href="{{url('product/'.$product->route_name)}}">{{$product->name}}</a></h6>
                            <div class="price home-price" style="height: 40px">
                                @if($product->sale_price != null)
                                    <h6>{{number_format($product->sale_price)}} Vnd</h6>
                                    <h6 class="l-through">{{$product->price}} Vnd</h6>
                                @else
                                    <h6>{{number_format($product->price)}} Vnd</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

</section>
