<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="img/product/{{$product->image}}" alt="" style="width: 85%">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="img/product/{{$product->image}}" alt=""style="width: 85%">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="img/product/{{$product->image}}" alt=""style="width: 85%">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{$product->name}}</h3>
                    @if($product->sale_price != null)
                    <h2>{{number_format($product->sale_price)}} Vnd </h2>
                        <h6 class="l-through"><strike>{{number_format($product->price)}} Vnd</strike></h6>
                    @else
                        <h2>{{number_format($product->price)}} Vnd </h2>
                    @endif
                    <ul class="list">
                        <li><span>Trạng thái</span> : {{$product->status}}</li>
                        <li><span>Nhà sản xuất</span> : {{$product->producer}}</li>
                    </ul>
                    <p>{!!$product->short_introduce!!}</p>
                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn add_cart" data-id="{{$product->id}}" style="color: white">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
