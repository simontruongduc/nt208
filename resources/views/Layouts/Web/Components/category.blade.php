<div class="container" style="margin-top: 100px;margin-bottom:100px">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <div class="head">Danh mục sản phẩm</div>
                <ul class="main-categories">
                    @foreach($categories as $category)
                        <?php $category = (object)$category?>
                    <li class="main-nav-list"><a href="{{url('category/'.$category->route_name)}}">{{$category->name}}<span class="number">({{$category->product}})</span></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="sidebar-filter mt-50">
                <div class="top-filter-head">Bộ lọc</div>
                <div class="common-filter">
                    <div class="head">Nhà sản xuất</div>
                    <form action="#">
                        <ul>
                            @foreach($producers as $producer)
                                <?php $producer = (object)$producer?>
                            <li class="filter-list"><input class="pixel-radio" type="radio" name="brand"><label for="apple">{{$producer->name}}</label></li>
                            @endforeach
                        </ul>
                    </form>
                </div>
                <div class="common-filter">
                    <div class="head">Giá bán</div>
                    <div class="price-range-area">
                        <div id="price-range"></div>
                        <div class="value-wrapper d-flex">
                            <div class="price">Giá từ:</div>
                            <span>$</span>
                            <div id="lower-value"></div>
                            <div class="to">đến</div>
                            <span>$</span>
                            <div id="upper-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            @component('Layouts.Web.Components.product')
                @slot('products',$products)
            @endcomponent
            <!-- End Best Seller -->
            <!-- Start Filter Bar -->
            @if($products)
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="pagination">
                {{$paginate}}
               </div>
            </div>
            @endif
            <!-- End Filter Bar -->
        </div>
    </div>
</div>
