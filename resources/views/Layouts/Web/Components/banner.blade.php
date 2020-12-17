<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                @if(isset($pageName))
                    <h1>{{$pageName}}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{url('/index')}}">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        @if(isset($pivot))
                            <a href="{{$url}}">{{$pivot}}<span class="lnr lnr-arrow-right"></span></a>
                        @endif
                        <a style="color: white">{{$activeName}}</a>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
