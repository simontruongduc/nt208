<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Giảm giá trong tuần</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @foreach($deal_products as $product)
                        <?php $product = (object)$product ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex";
}">
                                <a href="{{url('product/'.$product->route_name)}}"><img src="img/product/{{$product->image}}" style="width: 70px;height: 70px" alt=""></a>
                                <div class="desc">
                                    <a href="{{url('product/'.$product->route_name)}}" class="title">{{$product->name}}</a>
                                    <div class="price">
                                        <h6>{{number_format($product->sale_price)}} Vnd</h6>
                                        <h6 class="l-through">{{number_format($product->price)}} Vnd</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="img/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
