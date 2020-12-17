<section class="lattest-product-area pb-40 category-list">
    <div class="filter-bar d-flex flex-wrap align-items-center">
        <div class="sorting">
            <select>
                <option>Sắp xếp</option>
                <option value="0">Giá tăng dần</option>
                <option value="1">Giá giảm dần</option>
            </select>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <?php $product = (object) $product ?>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="single-product">
                    <a href="{{url('product/'.$product->route_name)}}"><img class="img-fluid"
                                                                            src="img/product/{{$product->image}}"
                                                                            alt=""></a>
                    <div class="product-details">
                        <h6 style="height: 51px;"><a
                                    href="{{url('product/'.$product->route_name)}}">{{$product->name}}</a></h6>
                        <div class="price">
                            @if($product->sale_price != null)
                                <h6>{{number_format($product->sale_price)}} Vnd</h6>
                                <h6 class="l-through">{{number_format($product->price)}} Vnd</h6>
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
