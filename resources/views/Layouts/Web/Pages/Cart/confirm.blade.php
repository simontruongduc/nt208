@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')
@section('content')
    @component('Layouts.Web.Components.banner')
    @endcomponent
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation" style="color: black;font-size: 30px">Xác nhận đơn hàng</h3>
            <div class="order_details_table">
                <h2>Thông tin đơn hàng</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartDetail as $row)
                            <?php $row = (object)$row; ?>
                            <tr>
                                <td>
                                    <p>{{$row->name}}</p>
                                </td>
                                <td>
                                    <h5>x {{$row->qty}}</h5>
                                </td>
                                <td>
                                    <p>{{number_format($row->qty*$row->price)}}</p>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>Tạm tính</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{number_format($total)}} Vnd</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Phí giao hàng</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>0 Vnd</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Tổng cộng</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{number_format($total)}} Vnd</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="order_details_table">
                <div class="col-lg-12">
                    <h3>Thông tin đặt hàng</h3>
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
                </div>
                <div class="col-lg-12">
                    <h3>Phương thức thanh toán</h3>
                    <form class="row contact_form" action="{{url('cart/order')}}" method="post" novalidate="novalidate">
                        <div class="col-md-12 form-group">
                            @csrf
                            <input type="hidden" name="information" value="{{$information->id}}">
                            <input type="hidden" name="payment" value="{{$payment}}">
                            <div class="creat_account">
                                <label>@if($payment == 'cod')Thanh toán khi nhận hàng.@elseif($payment == 'paypal')Thanh toán qua PayPal.@endif</label>
                            </div>
                            <div class="checkout_btn_inner d-flex align-items-center">
                                @if($payment == 'cod')
                                    <button class="primary-btn" style="float: right;" type="submit">Đặt hàng</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    @if($payment == 'paypal')
                        <div id="paypal-button"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
@if($payment == 'paypal')
    @section('js')
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
          paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
              size: 'medium',
              color: 'gold',
              shape: 'pill',
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
              // 2. Make a request to your server
              return actions.request.post('/api/create-payment')
              .then(function(res) {
                // 3. Return res.id from the response
                // console.log(res);
                return res.id;
              });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
              // 2. Make a request to your server
              return actions.request.post('/api/execute-payment', {
                paymentID: data.paymentID,
                payerID:   data.payerID
              })
              .then(function(res) {
                console.log(res);
                alert('PAYMENT WENT THROUGH!!');
                // 3. Show the buyer a confirmation message.
              });
            }
          }, '#paypal-button');
        </script>
    @stop
@endif