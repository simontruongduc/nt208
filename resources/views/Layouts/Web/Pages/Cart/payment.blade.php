@extends('Layouts.Web.Pages.app')
@section('title','Thanh toán đơn hàng')
@section('content')
    @component('Layouts.Web.Components.banner')
    @endcomponent
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Đơn hàng</h2>
                            <table>
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 50%">Sản phẩm</th>
                                    <th scope="col" style="width: 10%"></th>
                                    <th scope="col" style="width: 40%">Đơn giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cartDetail as $cart)
                                    <tr>
                                        <td>{{$cart['name']}}</td>
                                        <td> x {{$cart['qty']}}</td>
                                        <td>{{number_format($cart['qty']*$cart['price'])}} ₫</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <ul class="list list_2">
                                <li><a>Tạm tính <span>{{number_format($total)}} ₫</span></a></li>
                                <li><a>Phí giao hàng <span>0 ₫</span></a></li>
                                <li><a href="#">Tổng cộng <span>{{number_format($total)}} ₫</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8" style="margin-top: 20px;">
                        <div class="col-lg-12">
                            <h3>Thông tin đặt hàng</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-6 form-group">
                                    <ul style="list-style-type: none;">
                                        <li ><b>Họ tên</b> : {{$information->name}}</li>
                                        <li ><b>Email</b> : {{$information->email}}</li>
                                        <li ><b>Số điện thoại</b> : {{$information->phone}}</li>
                                        <li ><b>Địa chỉ</b> : {{$information->address.', '.$information->ward->name.', '.$information->district->name.', '.$information->province->name}} </li>
                                    </ul>
                                </div>
                                <div class="col-md-6 form-group">
                                    <span class="placeholder"><b>Ghi chú</b> : @if(!empty($information->note)){{$information->note}}@endif</span>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <h3>Phương thức thanh toán</h3>
                            <form class="row contact_form" action="{{url('cart/confirm')}}" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group">
                                    @csrf
                                    <input type="hidden" name="information" value="{{$information->id}}">
                                    <div class="creat_account">
                                        <ul>
                                            <li>
                                                <input type="radio" id="f-option1" name="payment" value="cod">
                                                <label for="f-option1">Thanh toán khi nhận hàng</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="f-option2" name="payment" value="paypal">
                                                <label for="f-option2">Thanh toán qua PayPal</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <button class="primary-btn" style="float: right;">Thanh toán</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
