@extends('layouts.app')

<title>@lang('site.welcome') | @lang('site.stores')</title>

@section('content')

<!-- Start Shop Page -->
<section class="shop-page">
    <div class="shop-page-cover">
        <img src="{{$store->getImagePath()}}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="merchant-logo">
                    <img src="images/stores/Lacoste.png" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <div class="merchant-details">
                    <div class="shop-details">
                        <h5 class="merchant-name">
                            @lang('site.store_name') : <span>{{$store->name}}</span>
                        </h5>
                        <div class="merchant-rate">
                            <span>@lang('site.rating') {{$store->rating}}</span>
                            <ul class="five-stars">
                                @for ($i = 0; $i < $store->rating; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor

                                    @for ($i = $store->rating; $i < 5; $i++) <li><i class="far fa-star"></i></li>
                                        @endfor


                            </ul>
                        </div>
                    </div>
                    <div class="merchant-contact">
                        <h6 class="merchant-contact-title">
                            طرق التواصل :
                        </h6>
                        <div class="merchant-contact-tools">
                            <a href="mailto:info@lacost.com"><i class="far fa-envelope"></i> <span>info@index.com

                                </span></a>
                            <a href=""><i class="fab fa-whatsapp"></i> <span>+97415212052

                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="site-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.welcome')}}">@lang('site.welcome')</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('front.store.index')}}">@lang('site.stores')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$store->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="shop-page-content">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="shop-page-sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            @lang('site.categories')
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                    <div class="card-body" data-simplebar>

                                        <ul>
                                            @foreach ($store->categories as $category)
                                            <li><a href="#">{{$category->name}}</a>
                                                <span class="number">{{$category->products_count}}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="fadebg"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="shop-page-results">
                        <div class="shop-page-results-filter-sec">

                            <div class="shop-page-result-name">
                                <h6>{{$store->name}}

                                    <span>@lang('site.found_about') {{$store->getProductCount()}} @lang('site.result')

                                    </span> </h6>
                            </div>

                        </div>
                        <div class="shop-page-results-products">
                            <div class="row">
                                @foreach ($store->categories as $category)
                                @foreach ($category->products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="result-product">
                                        <div class="product-img">
                                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                                alt="image product">
                                        </div>
                                        <h4 class="product-name">
                                            {{$product->name}}
                                        </h4>
                                        <div class="product-buy">
                                            <a href="{{route('front.product.show', $product)}}"
                                                class="btn">@lang('site.by_now')

                                            </a>
                                            <span class="hh">|</span>
                                            <strong class="price">{{$product->finalPrice()}}$</strong>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Page -->

@endsection