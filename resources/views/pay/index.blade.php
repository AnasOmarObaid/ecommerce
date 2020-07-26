@extends('layouts.app')

@section('title')
<title>@lang('site.index') | @lang('site.pay_pro')</title>
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
            <a class="nav-link" href="{{route('front.user.index')}}">@lang('site.user_data')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="pay-tab" href="{{route('front.pay.index')}}" role="tab" aria-controls="pay"
                aria-selected="false">@lang('site.pay_pro')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="confirmProcess-tab" data-toggle="tab" href="#confirmProcess" role="tab"
                aria-controls="confirmProcess" aria-selected="false">@lang('site.confirm_process')

            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade  show active" id="pay" role="tabpanel" aria-labelledby="pay-tab">
            <div class="pay-sec">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shipping-details">
                                <h2>@lang('site.shipping')</h2>
                                <div class="shipping-details-inner">
                                    <div class="shipping-company">
                                        <h6 class="company-name">@lang('site.name_shi')</h6>
                                        <div class="company-img">
                                            <img src="{{asset('public/images/logo_new.png')}}" alt="logo">
                                        </div>

                                    </div>
                                    <ul>
                                        <li>@lang('site.time_out'):1 - 3 أيام

                                        </li>
                                        <li>@lang('site.shi_cost'):
                                            <span>@lang('site.shi_result')</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pay-details mt-4">
                                <h2>@lang('site.payment')</h2>
                                <strong>@lang('site.chose_pay')</strong>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" checked
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">
                                        <h5><span>@lang('site.cash')

                                            </span> </h5>
                                        <p>@lang('site.cash_info')

                                        </p>

                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>@lang('site.confirm_sale')</h2>
                            <div class="user-details">
                                <h3>@lang('site.user_data')</h3>
                                <div class="order-details">

                                    <ul class="mt-1">
                                        <li>@lang('site.name') : {{auth()->user()->getFullName()}}</li>
                                        <li>@lang('site.city') : {{auth()->user()->city ?? __('site.no_value')}}</li>
                                        <li>@lang('site.country') : {{auth()->user()->country ?? __('site.no_value')}}
                                        </li>
                                        <li>@lang('site.p_c') : {{auth()->user()->postal_code ?? __('site.no_value')}}
                                        </li>
                                        <li> @lang('site.phone_number') :
                                            {{auth()->user()->phone_number ?? __('site.no_value')}}

                                        </li>

                                    </ul>
                                    <div class="order-details-total mt-3">
                                        <h3 class="pr-4">@lang('site.product_des')</h3>
                                        <table class="table pr-4">
                                            <thead>
                                                <tr>
                                                    <th>@lang('site.item')</th>
                                                    <th>@lang('site.quantity')</th>
                                                    <th>@lang('site.price')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $total = 0;
                                                @endphp

                                                @foreach (auth()->user()->products as $product)
                                                <tr>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->pivot->quantity}}</td>
                                                    <td>{{$product->pivot->quantity * $product->finalPrice()}}$</td>
                                                </tr>
                                                @php
                                                $total+=$product->pivot->quantity * $product->finalPrice();
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <ul class="total">
                                            <li>

                                                <span>@lang('site.total')</span><span>{{$total + 1.5}}$</span>

                                            </li>
                                            <li>
                                                <span>@lang('site.shi_cost')</span>
                                                <span>@lang('site.shi_result')</span>

                                            </li>
                                            <li>
                                                <span>@lang('site.tax')</span> <span>1.5$</span>

                                            </li>
                                            <li>
                                                <span>@lang('site.discount')</span> <span>@lang('site.no_dis')</span>

                                            </li>
                                        </ul>
                                        <div class="final-total">
                                            <span>@lang('site.total')</span> <span>{{$total + 1.5}}$</span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="next-prev">
                        <div class="prev">
                            <a href="{{route('front.welcome')}}"> <i
                                    class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop')</a>
                        </div>
                        <div class="total">
                            : @lang('site.total')

                            <span>{{$total + 1.5}}$

                            </span>
                        </div>
                        <div class="next">
                            @if (auth()->user()->products->count())
                            <form action="{{route('front.order2.storeProduct')}}" method="post">
                                @csrf
                                @method('post')

                                <button type="submit" class="btn">@lang('site.next')</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End cart page-->
@endsection