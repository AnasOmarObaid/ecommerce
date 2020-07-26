@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.ratings')</title>
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
            <a class="nav-link" href="{{route('front.order.index')}}" role="tab" aria-controls="applicationLog"
                aria-selected="true">@lang('site.order_list')

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('front.alert')}}" role="tab" aria-controls="alerts"
                aria-selected="false">@lang('site.notification')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{route('front.rating')}}" role="tab" aria-controls="rates"
                aria-selected="false">@lang('site.rating')
            </a>
        </li>

    </ul>

    <div class=" tab-content" id="myTabContent">
        <!-- Start seeting section -->

        <div class="tab-pane  show active">
            <div class="rates-sec">

                <div class="container">

                    <div class="rates-list">

                        @foreach (auth()->user()->ratings as $rating)
                        <div class="product-review">

                            <div class="product-review-top">
                                <ul class="five-stars">
                                    @for ($i = 0; $i < $rating->rating; $i++)
                                        <li><i class="fas fa-star"></i></li>
                                        @endfor
                                        @for ($i = $rating->rating; $i < 5; $i++) <li><i class="far fa-star"></i></li>
                                            @endfor
                                </ul>
                                <div class="product-review-title">
                                    <h4>{{$rating->title}}</h4>
                                    <h6>@lang('site.store') :
                                        <span>{{$rating->product->category->stores->first()->name  ?? __('site.no_value')}}</span>{{$rating->created_at->toFormattedDateString()}}
                                    </h6>
                                </div>

                            </div>
                            <ul class="details">
                                <li><span>@lang('site.features')</span>{{$rating->features}}</li>
                                <li><span>@lang('site.defects')</span>{{$rating->defects}}

                                </li>
                                <li><span>@lang('site.review')

                                    </span>{{$rating->review}}</li>

                            </ul>
                        </div>

                        @endforeach

                    </div>
                    <div class="next-prev">
                        <div class="prev">
                            <a href="{{route('front.welcome')}}"> <i
                                    class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop') </a>
                        </div>

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