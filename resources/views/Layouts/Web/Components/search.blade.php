<section class="section_gap">
    <!-- single product slide -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Kết quả tìm kiếm</h1>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <?php $product = (object)$product ?>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="single-product">
                        <a href="{{url('product/'.$product->id)}}"><img src="img/product/{{$product->image}}" class="img-fluid" ></a>
                        <div class="product-details">
                            <h6 style="height: 45px"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h6>
                            <div class="price home-price" style="height: 40px">
                                @if($product->sale_price != null)
                                    <h6>{{number_format($product->sale_price)}} Vnd</h6>
                                    <h6 class="l-through">{{$product->price}} Vnd</h6>
                                @else
                                    <h6>{{number_format($product->price)}} Vnd</h6>
                                @endif
                            </div>
                            <div class="prd-bottom" style="text-align: initial">
                                <a class="social-info add_cart" data-id="{{$product->id}}">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Thêm vào giỏ</p>
                                </a>
                                <a href="{{url('product/'.$product->id)}}" class="social-info">
                                    <span class="lnr lnr-eye"></span>
                                    <p class="hover-text">Xem chi tiết</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

</section>
