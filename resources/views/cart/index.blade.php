@extends('layouts.app')

@section('title')
<title>@lang('site.index') | @lang('site.cart')</title>
@endsection

@section('content')
<!-- Start cart page -->
<!-- Start cart page -->
<section class="cart-page">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart"
                aria-selected="true">@lang('site.cart')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="userData-tab" href="{{route('front.user.index')}}" role="tab"
                aria-controls="userData" aria-selected="false">@lang('site.user_data')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pay-tab" href="{{route('front.pay.index')}}" role="tab" aria-controls="pay"
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
        <!-- Start cart section -->
        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
            <div class="cart-sec">
                <div class="container">
                    <form action="{{route('front.cart2.updateCart')}}" method="POST">
                        @csrf
                        @method('post')
                        <h2>{{auth()->user()->products->count()}} @lang('site.cart')</h2>
                        <div class="cart-products">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('site.item')</th>
                                            <th scope="col">@lang('site.price')</th>
                                            <th scope="col">@lang('site.quantity')</th>
                                            <th scope="col">@lang('site.total')</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-r">
                                        @foreach (auth()->user()->products as $product)
                                        <tr>
                                            <td class="product">
                                                <div class="product-box">
                                                    <div class="product-img">
                                                        <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                                            alt="product image">
                                                    </div>
                                                    <div class="product-text">
                                                        <ul>
                                                            <li>{{$product->name}}</li>

                                                            <li>@lang('site.raw'):
                                                                {{$product->raw ?? __('site.no_value')}}</li>


                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="product-price">
                                                {{$product->finalPrice()}}$
                                            </td>

                                            <td class="quantity">
                                                <input type="number" class="change_number2"
                                                    value="{{$product->pivot->quantity}}" min="1"
                                                    max="{{$product->stoke}}" name="quantity[{{$product->id}}]"
                                                    data-id="#product_{{$product->id}}"
                                                    data-price="{{$product->finalPrice()}}" max="{{$product->stoke}}"
                                                    step="1">
                                            </td>


                                            <td class="product_price" id="product_{{$product->id}}"
                                                data-price="{{$product->finalPrice()}}">
                                                {{$product->pivot->quantity * $product->finalPrice()}}$
                                            </td>

                                            {{-- remove from cart --}}
                                            <td class="delete"><a href="{{route('front.cart2.delete', $product)}}"><i
                                                        class="fas fa-times"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="next-prev mt-4">
                            <div class="prev">
                                <a href="{{route('front.welcome')}}"> <i
                                        class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop')</a>
                            </div>
                            <div class="total" id="total-price">
                                @lang('site.total') :

                                <span>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach (auth()->user()->products as $product)
                                    @php
                                    $total+= $product->finalPrice() * $product->pivot->quantity;
                                    @endphp
                                    @endforeach
                                    {{$total}}$
                                </span>
                            </div>
                            @if (auth()->user()->products->count())
                            <div class="next">
                                <button type="submit" class="btn">@lang('site.next')</button>
                            </div>
                            @endif


                        </div>
                    </form>

                </div>
            </div>


        </div>
        <!-- End cart section -->

    </div>
</section>
<!-- End cart page-->
<!-- End cart page-->
@endsection