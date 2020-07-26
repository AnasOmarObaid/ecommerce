@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.alerts')</title>
@endsection

@section('content')

<!-- Start account-setting page -->
<section class="account-setting-page">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link" href="{{route('front.userData')}}" role="tab" aria-controls="userData"
                aria-selected="false">@lang('site.user_data')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('front.order.index')}}" role="tab" aria-controls="applicationLog"
                aria-selected="true">@lang('site.order_list')

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{route('front.alert')}}" role="tab" aria-controls="alerts"
                aria-selected="false">@lang('site.notification')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('front.rating')}}" role="tab" aria-controls="rates"
                aria-selected="false">@lang('site.rating')
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Start applicationLog section -->

        <!-- End applicationLog section -->


        <div class="tab-pane active" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">


            <div class="alerts-sec">

                <div class="container">

                    <div class="alerts-table">
                        <div class="alerts-head">
                            <h6>@lang('site.alert')</h6>
                        </div>

                        @foreach (auth()->user()->orders as $order)
                        <div class="single-alert">
                            <div class="alerts-details">

                                <span class="alert-date">
                                    {{$order->created_at->toFormattedDateString()}}
                                </span>
                                <span class="alert-name">
                                    @lang('site.order_number') : <strong>{{$order->order_number}}

                                    </strong>
                                </span>
                            </div>
                            <h6 class="alert-message">
                                @if ($order->status == 0)
                                {{__('site.order_success_arraive')}}
                                @else
                                {{__('site.order_no_arraive')}}
                                @endif
                            </h6>
                        </div>
                        @endforeach


                        <div class="single-alert">
                            <h6 class="alert-message">
                                {{auth()->user()->first_name}} @lang('site.for_auth')

                            </h6>
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


    </div>
</section>
<!-- End account-setting page-->

<!-- End alert section -->

@endsection