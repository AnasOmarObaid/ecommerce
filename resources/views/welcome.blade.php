@extends('layouts.app')

@section('title')
<title>@lang('site.welcome')</title>
@endsection

@section('content')

@if (count($products) > 0)
<!-- Start main slider section -->
<section class="main-slider">

    <div class="owl-carousel" id="main-slider">

        @foreach ($products as $product)
        <div class="item">
            <div class="slide-item"
                style="background: url({{asset('public/images/upload/product/image/poster/' . $product->getNamePoster())}})">
                <div class="container">
                    <div class="side-item-inner">
                        <div class="slide-text">
                            <h2 class="animated flipInX">{{$product->name}}</h2>
                            <p class="animated fadeInUp my-5">{{Str::limit($product->description, 200)}}</p>
                            <a href="{{route('front.product.show', $product)}}"
                                class="btn animated fadeInUp mt-3">@lang('site.shop_now')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</section>
<!-- End main slider section -->
@endif

@if (count($categories) >0)
<!-- Start site category section -->
<section class="site-category">
    <div class="container">
        <h2 class="sec-title">@lang('site.category_website')</h2>
        <div class="site-categorys">
            <div class="row">

                @foreach ($categories as $category)

                <div class="col-lg col-md-3 col-sm-4 col-6">
                    <div class="site-category-box">
                        <img src="{{$category->getImagePath()}}" alt="">
                        <h6>{{$category->name}}</h6>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- End site category section -->

@endif

<!-- Start Most sells section -->
<section class="most-sells">
    <div class="container">
        <div class="most-sells-head">
            <h2 class="sec-title">
                @lang('site.most_sells')
            </h2>
            <h6><a href="{{route('front.product.index')}}">@lang('site.watch_all')</a></h6>
        </div>
        <div id="most-sells-slider" class="owl-carousel">
            @foreach ($hight_sales as $hight)
            <div class="item">
                <div class="most-sells-product">
                    <a href="{{route('front.product.show', $hight)}}">
                        <div class="most-product-img">
                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $hight->images->first()->image)}}"
                                alt="">
                        </div>
                        <h4 class="most-product-title">

                            {{$hight->name}}

                        </h4>
                        <span class="most-product-price">
                            {{$hight->finalPrice() . '$'}}
                        </span>
                    </a>

                    <a class="btn most-product-button" href="{{route('front.product.show', $hight)}}">
                        <i class="fas fa-shopping-cart"></i>
                        @lang('site.by_now')
                    </a>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</section>
<!-- End Most sells section -->

<!-- Start Quick Offers section -->
@if (count($offers) > 0)
<section class="quick-offers">
    <div class="container">
        <div class="quick-offers-head">
            <h2 class="sec-title">
                @lang('site.quick_offers')
            </h2>
            <h6><a href="{{route('front.product.index')}}">@lang('site.watch_all')</a></h6>
        </div>
        <div id="quick-offers-slider" class="owl-carousel">
            @foreach ($offers as $offer)
            <div class="item">
                <a href="{{route('front.product.show', $offer)}}">
                    <div class="quick-offers-product">
                        <div class="quick-product-img">
                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $offer->images->first()->image)}}"
                                alt="">
                        </div>
                        <h4 class="quick-product-title">
                            {{$offer->name}}
                        </h4>
                        <span class="quick-product-price">
                            {{$offer->finalPrice() . '$'}} <span class="old">{{$offer->curet_sale_price . '$'}}</span>
                        </span>
                        <button class="btn badge">
                            @lang('site.show')
                        </button>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End Quick Offers section -->
@endif

<!-- Start New stores section -->
<section class="new-stores">
    <div class="container">
        <div class="new-stores-head">
            <h2 class="sec-title">
                @lang('site.new_store')
            </h2>
            <h6><a href="{{route('front.store.index')}}">@lang('site.watch_all')</a></h6>
        </div>
        <div id="new-stores-slider" class="owl-carousel">

            @foreach ($new_stores as $store)
            <div class="item">
                <a href="{{route('front.store.show', $store)}}">
                    <div class="new-stores-store">
                        <div class="quick-product-img">
                            <img src="{{$store->getImagePath()}}" alt="">
                        </div>
                        <h4 class="new-store-title">
                            {{$store->name}}
                        </h4>
                        <span class="new-store-desc">
                            {{$store->getProductCount() . ' ' . __('site.t_product')}}
                        </span>
                        <button class="btn badge">
                            @lang('site.new')
                        </button>
                    </div>
                </a>

            </div>

            @endforeach

        </div>
    </div>
</section>
<!-- End New stores section -->
@endsection