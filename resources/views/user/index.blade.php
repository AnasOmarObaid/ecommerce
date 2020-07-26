@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.user')</title>
@endsection

@section('content')
<!-- Start cart page -->
<section class="cart-page">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="{{route('front.cart.index')}}" role="tab" aria-controls="cart"
                aria-selected="true">@lang('site.cart')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('front.user.index')}}"
                aria-selected="false">@lang('site.user_data')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pay-tab" href="{{route('front.pay.index')}}" role="tab" aria-controls="pay"
                aria-selected="false">@lang('site.pay_pro')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">@lang('site.confirm_process')

            </a>
        </li>
    </ul>

    <div class=" tab-content" id="myTabContent">
        <!-- Start userData section -->
        <div class="tab-pane fade  show active" id="userData" role="tabpanel" aria-labelledby="userData-tab">
            <div class="user-data-sec">
                @include('layouts.dashboard.partetions.errors')
                <form action="{{route('front.user.update', auth()->user())}}" method="post">
                    @csrf
                    @method('put')
                    <div class="container">
                        <input type="hidden" name="type" value="type">
                        <h3>
                            @lang('site.user_data')

                        </h3>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="user-data-inputs">
                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input type="email" class="form-control" name="email" required
                                            value="{{auth()->user()->email}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('site.first_name')

                                                </label>
                                                <input type="text" name="first_name" required
                                                    value="{{auth()->user()->first_name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('site.last_name')</label>
                                                <input type="text" name="last_name" required
                                                    value="{{auth()->user()->last_name}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-address">
                                    <h4>@lang('site.ad_p')</h4>
                                    <div class="form-group">
                                        <label>@lang('site.country')</label>
                                        <input type="text" name="country" value="{{auth()->user()->country}}"
                                            class="form-control">

                                        <div class="form-group mt-3">
                                            <label>@lang('site.city')</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{auth()->user()->city}}">
                                        </div>


                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>@lang('site.zip_code')</label>
                                                    <input type="text" class="form-control" name="postal_code"
                                                        value="{{auth()->user()->postal_code}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>@lang('site.phone_number')</label>
                                                    <input type="text" name="phone_number" class="form-control"
                                                        value="{{auth()->user()->phone_number}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="user-order-details" style="max-width: 300px !important">
                                    <div class="order-details">
                                        <h5>@lang('site.product_des')</h5>

                                        @php
                                        $total = 0;
                                        @endphp

                                        @foreach (auth()->user()->products as $product)
                                        @php
                                        $total+=$product->pivot->quantity * $product->finalPrice();
                                        @endphp
                                        @endforeach
                                        <ul>
                                            <li><span>@lang('site.total')</span> {{$total}}$</li>
                                            <li><span>@lang('site.shi_cost')</span> @lang('site.shi_result')</li>
                                            <li><span>@lang('site.tax')</span> 1.5$</li>
                                            <li><span>@lang('site.discount')</span> @lang('site.no_dis')</li>

                                        </ul>
                                        <div class="order-details-total">
                                            <span>@lang('site.total')

                                            </span>{{$total + 1.5}}$
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="next-prev">
                            <div class="prev">
                                <a href=""> <i class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop')</a>
                            </div>
                            <div class="total">
                                @lang('site.total')

                                <span>{{$total + 1.5}}$

                                </span>
                            </div>
                            <div class="next">
                                <button class="btn">@lang('site.next')</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>


        <!-- End userData section -->

    </div>
</section>
<!-- End cart page-->
@endsection