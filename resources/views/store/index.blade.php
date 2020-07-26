@extends('layouts.app')

<title>@lang('site.welcome') | @lang('site.stores')</title>

@section('content')

<section class="product-page">

    <!-- Start Shop Page -->
    <section class="shop-page stores-page">

        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="site-breadcrumb mt-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('front.welcome')}}">@lang('site.home')</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.stores')</li>
                                @if (request()->name_category)
                                <li class="breadcrumb-item active" aria-current="page">{{request()->name_category}}</li>
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
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                @lang('site.categories')
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                        <div class="card-body" data-simplebar>
                                            <ul>

                                                @foreach ($categories as $category)
                                                <li
                                                    class="{{request()->name_category == $category->name ? 'active' : ''}}">
                                                    <a href="{{route('front.store.index', ['category' => $category->id,
                                                        'name_category' => $category->name])}}">{{$category->name}}</a>
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

                            <div class="shop-page-results-products">
                                <div class="row">
                                    @foreach ($stores as $store)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="stores-store">
                                            <a href="{{route('front.store.show', $store)}}">
                                                <div class="quick-product-img">
                                                    <img src="{{$store->getImagePath()}}" alt="">
                                                </div>
                                                <h4 class="new-store-title">
                                                    {{$store->name}}
                                                </h4>
                                                <span class="new-store-desc">
                                                    @lang('site.product') {{$store->getProductCount()}}
                                                </span>
                                                <div class="rate">
                                                    <ul class="five-stars">
                                                        @for ($i = 0; $i < $store->rating; $i++)
                                                            <li><i class="fas fa-star"></i></li>
                                                            @endfor

                                                            @for ($i = $store->rating; $i < 5; $i++) <li><i
                                                                    class="far fa-star"></i></li>
                                                                @endfor

                                                    </ul>
                                                </div>
                                            </a>
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