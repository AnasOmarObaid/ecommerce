@extends('layouts.app')

<title>@lang('site.welcome') | @lang('site.products')</title>

@section('content')

<section class="product-page">

    <!-- Start Shop Page -->
    <section class="shop-page">

        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="site-breadcrumb mt-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('front.welcome')}}">@lang('site.welcome')</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('front.product.index')}}">@lang('site.products')</a></li>
                                @if (request()->category_name)
                                <li class="breadcrumb-item active" aria-current="page">{{request()->category_name}}</li>
                                @endif

                                @if (request()->search)
                                <li class="breadcrumb-item active" aria-current="page">{{request()->search}}</li>
                                @endif
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="shop-page-content">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="shop-page-sidebar">
                            <div class="accordion1" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                @lang('site.products')
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                        <div class="card-body" data-simplebar>
                                            <ul>
                                                @foreach ($categories as $category)
                                                <li
                                                    class="{{request()->category_name == $category->name ? 'active' : ''}}">
                                                    <a
                                                        href="{{route('front.product.index', ['category_name' => $category->name, 'category_id'=>$category->id])}}">{{$category->name}}</a>
                                                    <span class="number">{{$category->products_count}}</span>
                                                </li>
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
                                    @if (request()->search)
                                    <h6>{{request()->search}}

                                        <span>@lang('site.found_about') {{count($products)}} @lang('site.result')

                                        </span> </h6>
                                    @elseif(request()->category_name)
                                    <h6>
                                        {{request()->category_name}}
                                        <span>@lang('site.found_about'){{count($products)}}@lang('site.result')

                                        </span> </h6>
                                    @else
                                    <h6>
                                        @lang('site.all_product')
                                        <span>@lang('site.found_about') {{$products_count}} @lang('site.result')

                                        </span> </h6>
                                    @endif
                                </div>

                            </div>
                            <div class="shop-page-results-products">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="result-product">
                                            <div class="product-img">
                                                <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                                    alt="image product" alt="">
                                            </div>
                                            <h4 class="product-name">
                                                {{$product->name}}
                                            </h4>
                                            <div class="product-buy">
                                                <a href="{{route('front.product.show', $product->id)}}"
                                                    class="btn">@lang('site.buy_now')

                                                </a>
                                                <span class="hh">|</span>
                                                <strong class="price">{{$product->finalPrice()}}$</strong>
                                            </div>
                                        </div>
                                    </div>

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

</section>


@endsection