@extends('front.master_front')
@section('content')
    <section id="check-out">
        <div class="container check-out">
            <form action="{{ route('post_check_with_payment') }}" method="post" class="add-address" style="padding-top: 10px">
                @csrf
            <div class="row">
                <div class=" col-lg-7 col-md-7 col-sm-12 deliver__address" style="margin-bottom:10px; background: white">
                    <h2><span class="glyphicon glyphicon-home"></span> Delivery Address</h2>

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="First name" required @if($preset_address != null) value="{{$preset_address->first_name}}" @endif>
                            </div>
                            <div class="col-sm-6 col-12">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last name" required @if($preset_address != null) value="{{$preset_address->first_name}}" @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="inputPhone">Phone</label>
                                <input type="number" name="phone" class="form-control" id="inputPhone" value="@if($preset_address != null){{ $preset_address->phone }}@endif" required></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="inputLocation">Location</label>
                                <select name="location" class="form-control shipping" id="inputLocation" required>
                                    <option value="" disabled selected>Select a shipping district</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->shipping_price }}">
                                            {{ $location->shipping_location }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>


                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6 col-12">--}}
                                {{--<label for="inputCity">Zone</label>--}}
                                {{--<input type="text" class="form-control" id="inputZone">--}}

                            {{--</div>--}}
                            {{--<div class="col-sm-6 col-12">--}}
                                {{--<label for="inputCity">City</label>--}}
                                {{--<input type="text" class="form-control" id="inputCity">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="row">
                            <div class="col-12">
                                <label for="inputAddress">Address</label>
                                <input type="text" name="delivery_address" list="previousAddress" class="form-control" id="inputAddress" placeholder="Enter delivery location" @if($preset_address != null) value="{{ $preset_address->address }}" @endif>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                        <label for="payment_type">Payment</label>
                        <div class="col-md-6"></div>
                        <select id="payment_type" required name="paid" class="form-control">
                            <option value="" disabled selected>Select a payment type</option>
                            <option value="0">Cash On delivery</option>
                            <option value="1">Pay Now</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-5 col-md-5 col-sm-12 ">
                    <div class="card ">
                        <div class="card-header" style="margin-bottom: 10px;">
                            Review Order
                            <div class="float-right">
                                <small><a class="afix-1" href="/view_cart">Edit Cart</a></small>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-block p-3">
                            <div class=" group">
                                @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                                <div class="row">
                                    <div class="col-sm-3 col-3">
                                        <img class="img-fluid" src="{{asset($product->attributes['image'])}}">
                                    </div>
                                    <div class="col-sm-6 col-6">
                                        <div class="col-12">{{$product->name}}</div>
                                        <div class="col-12">
                                            <small>Quantity:<span>{{$product->quantity}}</span></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-3 text-right">
                                        <h6><span>Rs.</span>{{$product->price}}</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr>
                                @endforeach

                            </div>
                            @if(!session()->get('coupon'))
                                <div style="height: 60px">
                                    <div class="form-group">
                                        <span>Have a coupon?</span>
                                        <input type="text" id="coupon_code" class="pull-right" name="coupon_code" placeholder="Apply Coupon Code">
                                    </div>
                                    <div>
                                        <a class="btn btn-sm btn-success pull-right" style="display: inline;" id="apply_coupon">Apply</a>
                                        <span id="coupon_error" style="display:none; color: red"></span>
                                    </div>
                                </div>
                            <hr>
                            @endif
                            <div class="row">
                                @if(!session()->get('coupon'))
                                <div class="col-12">
                                    <strong>Subtotal</strong>
                                    <div class="float-right"><span>Rs.</span><span id="no_dis_subtotal">{{ $subtotal }}</span></div>
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <div class="clearfix"></div>
                                </div>
                                @else
                                    <div class="col-12">
                                        <strong>Subtotal</strong>
                                        <div class="float-right"><span>Rs.</span><span>{{ $subtotal }}</span></div>
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-12">
                                        <strong>Discount ({{ session()->get('coupon')['discount'] }})</strong>
                                        <a class="btn btn-danger btn-sm" href="{{ route('coupon_destroy') }}" id="remove_coupon" style="font-size: 11px; border: none">Remove</a>
                                            <span class="d-inline-block w-100px pull-right">- {{ session()->get('coupon')['discount'] }}</span>
                                        <input type="hidden" name="discount" value="{{ session()->get('coupon')['discount'] }}">
                                        <input type="hidden" name="coupon_name" value="{{ session()->get('coupon')['name'] }}">
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <strong>New Subtotal</strong>
                                        <div class="float-right"><span>Rs.</span><span id="after_dis_subtotal">{{ $subtotal-session()->get('coupon')['discount'] }}</span></div>
                                        <input type="hidden" name="subtotal" value="{{ $subtotal-session()->get('coupon')['discount'] }}">
                                        <div class="clearfix"></div>
                                    </div>
                                    <hr>
                                @endif
                                <div class="col-12">
                                    <small>Shipping</small>
                                    <div class="float-right"><span>Rs.</span><span id="shipping_price">-</span></div>
                                    <input type="hidden" id="form_shipping_price" name="shipping_price" value="0">
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="padding: 0 0 10px">
                                <div class="col-12">
                                    <strong>Order Total</strong>
                                    <div class="float-right"><span>Rs.</span><span id="order_total">
                                            @if(session()->get('coupon')){{ $subtotal-session()->get('coupon')['discount'] }}@else{{ $subtotal }}@endif
                                        </span></div>
                                    <input type="hidden" id="form_order_total" name="order_total" value="0">
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <input type="hidden" name="drop_location" id="drop_location" value="">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="uk-button checkout float-right">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>


    @endsection
@section('script')

    <script>
        $('.shipping').change(function () {
            // console.log('changed');
            var dataId = $('.shipping').val();
            var location = $('.shipping option:selected').text();
            // console.log(location);
            // console.log(dataId);
            $('#shipping_price').html(dataId);
            @if(!session()->get('coupon')){

                var subtotal = $('#no_dis_subtotal').text();
                console.log(subtotal);
                console.log('a');
            }
            @else{
                console.log('a');
                var subtotal = $('#after_dis_subtotal').text();
            }
            @endif
            // console.log(subtotal);
            var ordertotal = parseInt(subtotal) + parseInt(dataId);
            console.log(ordertotal);
            $('#order_total').empty();
            $('#order_total').html(ordertotal);
            $('#form_shipping_price').val(dataId);
            var check = $('#form_shipping_price').val();
            console.log(check);
            $('#form_order_total').val(ordertotal);
            // console.log(location);
            $('#drop_location').val(location);
        })
    </script>
    <script>
        $('#payment_type').change(function () {
            var paid = $('#payment_type').val();
            if(paid == '1'){

            }
            else{

            }

        });
    </script>

    {{--//coupon code--}}
    <script>
        $('#apply_coupon').on('click',function (e) {
            e.preventDefault();
            $('#coupon_error').hide();
            $('#coupon_error').empty();
            var coupon_code = $('#coupon_code').val();
            // console.log(coupon_code);
            $.ajax({
                type: 'get',
                url: '/apply_coupon/'+coupon_code,
                // data: $('form').serialize(),
                // dataType: "JSON",
                // data: new FormData($('form')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    location.reload();
                    var total = $('#form_order_total').val();
                    var discount = $('#discount').val();
                    console.log(discount);

                },
                error: function (response) {
                    console.log(response.responseJSON.errors);
                    $('#coupon_error').show();
                    $('#coupon_error').append('<p>'+ response.responseJSON.errors +'</p>');
                }
            });
        });

    </script>
@endsection