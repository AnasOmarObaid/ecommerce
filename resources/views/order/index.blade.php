@extends('layouts.app')

@section('title')
<title>@lang('site.orders') | @lang('site.order_list')</title>
@endsection

@section('content')
<section class="account-setting-page">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link" href="{{route('front.userData')}}" role="tab" aria-controls="userData"
                aria-selected="false">@lang('site.user_data')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{route('front.order.index')}}" role="tab" aria-controls="applicationLog"
                aria-selected="true">@lang('site.order_list')

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('front.alert')}}" role="tab" aria-controls="alerts"
                aria-selected="false">@lang('site.notification')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('front.rating')}}" role="tab" aria-controls="rates"
                aria-selected="false">@lang('site.rating')
            </a>
        </li>
    </ul>

    <div class=" tab-content" id="myTabContent">
        <!-- Start seeting section -->

        <div class="tab-pane fade show active" id="applicationLog" role="tabpanel" aria-labelledby="applicationLog-tab">
            <div class="applicationLog-sec" style="max-width: 900px;">
                <div class="container">
                    <div class="applicationLog-pagination">

                    </div>
                    <div class="applicationLog-products">
                        <div class="table-responsive">

                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('site.item')</th>
                                        <th scope="col">@lang('site.order_status')</th>
                                        <th scope="col">@lang('site.action')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->orders as $order)

                                    @if($order->status == 1)

                                    <tr>
                                        <td class="product">
                                            <div class="product-box-top">

                                                <ul class="application-details">
                                                    <li>@lang('site.order_number') :
                                                        <span>{{$order->order_number}}</span></li>
                                                    <li>@lang('site.order_date') :
                                                        <span>{{$order->created_at->toFormattedDateString()}}</span>
                                                    </li>
                                                </ul>

                                                <div class="merchant-details">
                                                    <h6> @lang('site.name_store'):
                                                        <span>{{$order->products->first()->category->stores()->first()->name ?? __('site.no_value')}}

                                                        </span></h6>

                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            @lang('site.order_suucess')
                                        </td>

                                        <td class="action action-del-total">
                                            <div class="total-price">
                                                <h6>: @lang('site.total') </h6>
                                                <h5>{{$order->total_price + 1.5}}$</h5>

                                            </div>
                                        </td>
                                    </tr>

                                    @else

                                    <tr id="#{{$order->id}}">
                                        <td class="product">
                                            @foreach ($order->products as $product)
                                            <div class="product-box-bottom">
                                                <div class="product-img">
                                                    <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                                        alt="product iamge">
                                                </div>
                                                <div class="product-text">
                                                    <ul>
                                                        <li class="product-name">{{$product->name}}</li>
                                                        <li>{{$product->finalPrice() . '$'}} *
                                                            {{$product->pivot->quantity}}
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                            @endforeach

                                        </td>

                                        <td class="product-status">
                                            @lang('site.product_is_arraive')
                                        </td>

                                        <td class="action">

                                            <div class="action-buttons">

                                                <form action="{{route('front.order_confirm', $order)}}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <button type="submit" class="btn confirm">
                                                        @lang('site.confirm_order')
                                                        <i class="fas fa-long-arrow-alt-left"></i>
                                                    </button>
                                                </form>

                                                <a href="{{route('front.product.show', $order->products()->first())}}"
                                                    class="btn add-rate btn-block">
                                                    @lang('site.add_rating')
                                                    <i class="fas fa-long-arrow-alt-left"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>

                                    @endif

                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="next-prev">
                        <div class="prev">
                            <a href="{{route('front.welcome')}}"> <i
                                    class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop')</a>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- End applicationLog section -->


        <!-- End seeting section -->

    </div>
</section>
@endsection