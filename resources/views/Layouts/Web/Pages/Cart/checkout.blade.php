@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')
@section('css')
    <style>
        .nice-select .list{
            height: 200px;
            overflow-y: scroll
        }
    </style>
@stop
@section('content')
    @component('Layouts.Web.Components.banner')
    @endcomponent
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Thông tin đặt hàng</h3>
                        <form class="row contact_form" action="{{url('cart/payment')}}" method="post" id="checkout_form">
                            @csrf
                            <input type="hidden" name="district" id="input_district">
                            <input type="hidden" name="ward" id="input_ward">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="first_name" placeholder="Họ" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="last_name" placeholder="Tên" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Số điện thoại" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-4 form-group p_star province">
                                <select class="country_select " name="province" id="province" required>
                                    <option>Tỉnh/Thành Phố</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group p_star district">
                                <select class="country_select" name="select_district" id="district" required disabled>
                                    <option>Quận/Huyện</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group p_star ward">
                                <select class="country_select" name="select_ward" id="ward" required disabled>
                                    <option>Phường/Xã</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" required>
                            </div>
                            @if(count($information)!=0)
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" id="check_box" name="default_address_selector">
                                        <label for="f-option2">Sử dụng địa chỉ mặt định</label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group p_star" id="list_address" style="display: none">
                                    <select class="country_select" id="select_list_address" name="information">
                                        <option>Địa chỉ</option>
                                        @foreach($information as $row)
                                            <?php $row = (object)$row; ?>
                                            <option value="{{$row->id}}">{{$row->address}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="note" id="note" rows="1" placeholder="Ghi chú"></textarea>
                            </div>
                        </form>
                    </div>
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
                                        <td>{{number_format($cart['qty']*$cart['price'])}} Vnd</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <ul class="list list_2">
                                <li><a>Tạm tính <span>{{number_format($total)}} Vnd</span></a></li>
                                <li><a>Phí giao hàng <span>0 Vnd</span></a></li>
                                <li><a href="#">Tổng cộng <span>{{number_format($total)}} Vnd</span></a></li>
                            </ul>
                            <button class="primary-btn" form="checkout_form" type="submit">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    <script src="js/location.js"></script>
@stop