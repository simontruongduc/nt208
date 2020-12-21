@extends('Layouts.Web.Pages.app')
@section('title','Giỏ hàng')
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Giỏ hàng')
        @slot('activeName','Giỏ hàng')
    @endcomponent
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        @if($total != 0)
                            <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng cộng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartDetail as $product)
                                <tr id="{{$product['id']}}">
                                    <td style="width: 55%">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="img/product/{{$product['image']}}" alt=""
                                                     style="width: 100px; height: 100px">
                                            </div>
                                            <div class="media-body" style="width: 300px">
                                                <p>{{$product['name']}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <h5 id="product_{{$product['id']}}_price">{{number_format($product['price'])}}
                                            ₫</h5>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="product_count">
                                            <input type="text" name="qty" id="product_{{$product['id']}}_qty"
                                                   maxlength="12" value="{{$product['qty']}}" title="Quantity:"
                                                   class="input-text qty" disabled>
                                            <button class="increase items-count PlusQty" type="button"
                                                    data-id="{{$product['id']}}"><i class="lnr lnr-chevron-up"></i>
                                            </button>
                                            <button class="reduced items-count MinusQty" type="button"
                                                    data-id="{{$product['id']}}"><i class="lnr lnr-chevron-down"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <h5 id="product_{{$product['id']}}_total_price">{{number_format($product['qty'] * $product['price'])}}
                                            ₫</h5>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bottom_button">
                                <td>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Mã giảm giá">
                                        <a class="primary-btn" href="#">Áp dụng</a>
                                        <a class="gray_btn" href="#">Hủy áp dụng</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Tổng đơn hàng</h5>
                                </td>
                                <td>
                                    <h5 id="cart_total_price">{{number_format($total)}} ₫</h5>
                                </td>
                            </tr>
                            @else
                                <tr style="text-align: center">
                                    <p style="text-align: center">Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                                </tr>
                            @endif
                            <tr class="out_button_area">
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="{{url('/index')}}">Tiếp tục mua sắm</a>
                                        @if($total != 0)
                                            <a class="primary-btn" href="{{url('cart/check_out')}}">Đặt hàng</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    <script>
      $('.PlusQty').click(function (event) {
        event.preventDefault()
        var id = $(this).data('id')
        $response = $.get('cart/update/' + id + '/plus')
        $response.done(function (res) {
          var price = document.getElementById('product_' + id + '_qty').value
          var product_total_price = document.getElementById('product_' + id + '_total_price').textContent
          var product_price = document.getElementById('product_' + id + '_price').textContent
          var total_price = parseInt(product_price) * (parseFloat(price) + 1) * 1000
          var cart_price = document.getElementById('cart_total_price').textContent
          var current_price = parseFloat(cart_price) * 1000 - parseFloat(product_total_price) * 1000 + total_price
          document.getElementById('product_' + id + '_qty').value = parseFloat(price) + 1
          document.getElementById('product_' + id + '_total_price').innerHTML = total_price.toLocaleString('it-IT',
            { style: 'currency', currency: 'VND' })
          document.getElementById('cart_total_price').innerHTML = current_price.toLocaleString('it-IT',
            { style: 'currency', currency: 'VND' })
        })
        $response.fail(function (res) {
          alert(res.message)
        })
      })
      $('.MinusQty').click(function (event) {
        event.preventDefault()
        var id = $(this).data('id')
        $response = $.get('cart/update/' + id + '/minus')
        $response.done(function (res) {
          var price = document.getElementById('product_' + id + '_qty').value
          var product_total_price = document.getElementById('product_' + id + '_total_price').textContent
          var cart_price = document.getElementById('cart_total_price').textContent
          if (parseFloat(price) - 1 != 0) {
            var product_price = document.getElementById('product_' + id + '_price').textContent
            var total_price = parseInt(product_price) * (parseFloat(price) - 1) * 1000
            var current_price = parseFloat(cart_price) * 1000 - parseFloat(product_total_price) * 1000 + total_price
            document.getElementById('product_' + id + '_qty').value = parseFloat(price) - 1
            document.getElementById('product_' + id + '_total_price').innerHTML = total_price.toLocaleString('it-IT',
              { style: 'currency', currency: 'VND' })
            document.getElementById('cart_total_price').innerHTML = current_price.toLocaleString('it-IT',
              { style: 'currency', currency: 'VND' })
          } else {
            var current_price = parseFloat(cart_price) * 1000 - parseFloat(product_total_price) * 1000
            if (current_price == 0) {
              location.reload()
            }
            document.getElementById('cart_total_price').innerHTML = current_price.toLocaleString('it-IT',
              { style: 'currency', currency: 'VND' })
            document.getElementById(id).remove()
          }
        })
        $response.fail(function (res) {
          alert(res.message)
        })
      })
    </script>
@stop
