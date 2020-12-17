<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bài viết</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                   aria-selected="false">Bình luận</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                   aria-selected="false">Đánh giá</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                {!! $product->introduce !!}
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="comment_list">--}}
{{--                            <div class="review_item">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="img/product/review-1.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h4>Blake Ruiz</h4>--}}
{{--                                        <h5>12th Feb, 2018 at 05:56 pm</h5>--}}
{{--                                        <a class="reply_btn" href="#">Reply</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et--}}
{{--                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
{{--                                    commodo</p>--}}
{{--                            </div>--}}
{{--                            <div class="review_item reply">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="img/product/review-2.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h4>Blake Ruiz</h4>--}}
{{--                                        <h5>12th Feb, 2018 at 05:56 pm</h5>--}}
{{--                                        <a class="reply_btn" href="#">Reply</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et--}}
{{--                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
{{--                                    commodo</p>--}}
{{--                            </div>--}}
{{--                            <div class="review_item">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="img/product/review-3.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h4>Blake Ruiz</h4>--}}
{{--                                        <h5>12th Feb, 2018 at 05:56 pm</h5>--}}
{{--                                        <a class="reply_btn" href="#">Reply</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et--}}
{{--                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
{{--                                    commodo</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="review_box">--}}
{{--                            <h4>Post a comment</h4>--}}
{{--                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12 text-right">--}}
{{--                                    <button type="submit" value="submit" class="btn primary-btn">Submit Now</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="fb-comments" data-href="{{url('/product/'.$product->id)}}" data-width="1050" data-numposts="5"></div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Đánh giá</h5>
                                    <h4>{{$product->medium_score_rate}}</h4>
                                    <h6>({{$product->reviews}} Đánh giá)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Thống kê đánh giá</h3>
                                    <ul class="list">
                                        <li><a href="#">5 Sao <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> {{$product->rate_detail['5']}}</a></li>
                                        <li><a href="#">4 Sao <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> {{$product->rate_detail['4']}}</a></li>
                                        <li><a href="#">3 Sao <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> {{$product->rate_detail['3']}}</a></li>
                                        <li><a href="#">2 Sao <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> {{$product->rate_detail['2']}}</a></li>
                                        <li><a href="#">1 Sao <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> {{$product->rate_detail['1']}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/review-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Đánh giá của bạn</h4>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Đánh giá của bạn..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn">Đánh giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
