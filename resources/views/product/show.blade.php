@extends('layouts.app')

<title>@lang('site.product') | @lang('site.show')</title>

@section('content')
<!-- Start product page  -->
<section class="product-page">
    <div class="container">
        <!-- Start product-preview section -->
        <div class="product-preview">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-preview-media">
                        <div class="fotorama" data-width="800" data-height="370" data-nav="thumbs" data-thumbmargin="10"
                            data-thumbwidth="50" data-thumbheight="50">
                            @foreach ($product->images as $image)
                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $image->image)}}">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product-preview-text">

                        <h2 class="product-title">{{$product->name}}</h2>
                        <span class="product-catg">
                            @foreach ($product->category->stores as $store)
                            <span class="badge badge-dark">{{$store->name}}</span>
                            @endforeach
                        </span>
                        <div class="rate">
                            <span>@lang('site.rating') {{count($product->ratings)}}</span>
                            <ul class="five-stars">
                                @for ($i = 0; $i < $product->ratings->count(); $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor
                                    @for ($i = $product->ratings->count(); $i < 5; $i++) <li><i class="far fa-star"></i>
                                        </li>
                                        @endfor
                            </ul>
                        </div>
                        {{-- color section --}}
                        @if (count($product->colors) >0)
                        <div class="color-sec">
                            <span class="color-sec-title">@lang('site.color')</span>
                            <div class="colors">
                                @foreach ($product->colors as $color)
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="{{$color->color}}" name="color"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="{{$color->color}}"></label>
                                </div>

                                @endforeach


                            </div>
                        </div>
                        @endif

                        {{--- size section --}}
                        @if (count($product->sizes) >0)
                        <div class="size-sec">
                            <div class="size-sec-top">
                                <span class="size-sec-title">@lang('site.size')</span>
                                <div class="sizes">
                                    @foreach ($product->sizes as $size)
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="{{$size->name}}" name="size[]"
                                            class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="{{$size->name}}">{{$size->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        @endif
                        <form action="{{route('front.order_create',  $product)}}" method="post" class="custom_form">
                            @csrf
                            @method('post')
                            {{-- quantity section --}}
                            <div class="quantity-sec">
                                <span class="quantity-sec-title">
                                    @lang('site.quantity')
                                </span>
                                <input type="number" value="1" min="1" max="{{$product->stole}}" name="quantity"
                                    class="custom_quantity">

                                <span class="quantity-sec-details">
                                    {{$product->stoke - $product->number_sale}} @lang('site.available') /
                                    {{$product->number_sale}} @lang('site.bought')
                                </span>
                            </div>

                            {{-- tages secion --}}
                            @if ($product->tag)

                            <?php  $tags = explode(',', $product->tag) ?>

                            <ul class="badges-sec">
                                @foreach ($tags as $tag)
                                <li class="best"><span>{{$tag}}</span></li>
                                @endforeach
                            </ul>
                            @endif

                            {{-- price section --}}
                            <div class="price-sec">
                                @if ($product->new_sale_price)
                                <span class="current-price">{{$product->new_sale_price}}$</span>
                                <span class="old-price">{{$product->curet_sale_price}}$</span>
                                @else
                                <span class="current-price">{{$product->curet_sale_price}}$</span>
                                @endif

                            </div>

                            {{-- cart --}}
                            <div class="product-buy-butons">

                                @auth
                                <input type="submit" value="{{__('site.buy_now')}}" class="buynow btn">
                        </form>

                        @else
                        <buton class="buynow btn" onclick="login_model()">
                            @lang('site.buy_now')
                        </buton>
                        @endauth

                        @auth

                        @if (in_array($product->id, auth()->user()->products->pluck('id')->toArray()))

                        {{-- remove cart --}}

                        <a href="{{route('front.cart2.delete', $product)}}" class="addToCart btn">
                            <i class="fas fa-shopping-cart"></i>@lang('site.remove_cart')
                        </a>


                        @else
                        {{-- add cart --}}

                        <a href="{{route('front.cart2.add', $product)}}" class="addToCart btn">
                            <i class="fas fa-shopping-cart"></i>@lang('site.add_cart')
                        </a>

                        @endif


                        @else
                        <a class="addToCart btn" onclick="login_model()">
                            <i class="fas fa-shopping-cart"></i>@lang('site.add_cart')
                        </a>
                        @endauth

                    </div>

                </div>
            </div>


        </div>
    </div>
    <!-- End product-preview section -->

    <!-- Start product-details-and-reviews section -->
    <div class="product-details-and-reviews">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab"
                    aria-controls="details" aria-selected="true">@lang('site.product_det')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                    aria-controls="reviews" aria-selected="false">@lang('site.ratings')
                    ({{count($product->ratings)}})</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="product-details">
                    <div class="row">
                        <div class="col-md-10 offset-md-2">
                            <div class="product-details-box first">
                                <h3>@lang('site.product_desc')</h3>
                                <p>{{$product->description}}</p>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 offset-md-2">
                            <div class="product-details-box props">
                                <h3>@lang('site.product_pro') </h3>
                                <ul class="proudct-props" id="print-product_det">
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span>@lang('site.product_name')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            {{$product->name}}
                                        </span>
                                    </li>
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span> @lang('site.product_number')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            {{$product->product_number}}
                                        </span>
                                    </li>
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span>@lang('site.sale_price')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            {{$product->finalPrice()}}$
                                        </span>
                                    </li>
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span>@lang('site.add_by')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            @if ($product->user_id)
                                            {{$product->user->getFullName()}}
                                            @else
                                            @lang('site.un_know')
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span>@lang('site.comments')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            {{count($product->ratings)}}
                                        </span>
                                    </li>
                                    <li>
                                        <div class="proudct-prop-name">
                                            <span>@lang('site.number_sale')</span>
                                        </div>
                                        <span class="proudct-prop-val">
                                            {{$product->number_sale}}
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        {{-- product-detail --}}
                        <div class="col-lg-5">
                            <div class="product-details-box help">
                                <h3>@lang('site.product_details_pro')</h3>

                                <ul class="product-help">
                                    <?php  $pro_ins = explode(',', $product->pro_ins) ?>
                                    @foreach ($pro_ins as $pro)
                                    <li>{{$pro}}</li>
                                    @endforeach
                                </ul>

                                <div class="download print-det-btn" style="cursor: pointer;">
                                    <i class="far fa-file"></i>
                                    <p>
                                        <strong>@lang('site.product_pro')</strong>
                                        <span>PDF, 12 Mb</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- comments section--}}
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="product-reviews">
                    <div class="row">
                        <div class="col offset-md-2">
                            <div class="product-reviews-head">
                                <ul class="five-stars">
                                    @for ($i = 0; $i < count($product->ratings); $i++)
                                        <li><i class="fas fa-star"></i></li>
                                        @endfor
                                        <li><i class="far fa-star"></i></li>
                                </ul>
                                <h6>@lang('site.product_avg'): {{count($product->ratings)}}
                                    @lang('site.out_of') 5
                                    ({{$all_rating}}@lang('site.rating') )
                                </h6>
                                <span>@lang('site.share')</span>
                                @auth
                                <a class="btn scroll-btn" href="#add-rate">@lang('site.write_rating')</a>
                                @else
                                <a class="btn btn-info btn-sm" onclick="login_model()" href="#">@lang('site.login')</a>
                                @endauth
                            </div>

                            @if (count($product->ratings) != 0)
                            @foreach ($product->ratings as $rating)

                            <div class="product-review">
                                <div class="product-review-top">
                                    <ul class="five-stars">
                                        @for ($i = 0; $i < $rating->rating; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                            @endfor
                                            @for ($i = $rating->rating; $i < 5; $i++) <li><i class="far fa-star"></i>
                                                </li>
                                                @endfor
                                    </ul>

                                    <div class="product-review-title m-0">
                                        <h4>{{$rating->title}}</h4>
                                        <h6>:
                                            @lang('site.add_by')<span>{{$rating->user->getFullName()}}</span>{{$rating->created_at->toFormattedDateString()}}
                                        </h6>
                                    </div>

                                </div>
                                <ul class="details" style="margin-top:15px">
                                    <li><span>@lang('site.features')</span>{{$rating->features}}</li>
                                    <li><span>@lang('site.defects')</span>{{$rating->defects}}

                                    </li>
                                    <li><span>@lang('site.review')

                                        </span>{{$rating->review}}</li>

                                </ul>
                            </div>

                            @endforeach
                            @endif

                            @auth
                            {{-- add rating --}}
                            <div class="review-form" id="add-rate">
                                <form action="{{route('front.rating.store', $product->id)}}" method="POST">

                                    @csrf
                                    @method('post')
                                    <div class="product-name">{{$product->name}}</div>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    {{-- stars --}}
                                    <div class="rating">
                                        <span class="name">@lang('site.rating')</span>
                                        <div class='star-rating'>
                                            <input checked id='my_rating_0' name='my_rating' type='radio' value='0'>
                                            <label for='my_rating_0' title='0 stars'>0 stars</label>
                                            <input id='my_rating_1' name='my_rating' type='radio' value='1'>
                                            <label for='my_rating_1' title='1 star'>1 star</label>
                                            <input id='my_rating_2' name='my_rating' type='radio' value='2'>
                                            <label for='my_rating_2' title='2 stars'>2 stars</label>
                                            <input id='my_rating_3' name='my_rating' type='radio' value='3'>
                                            <label for='my_rating_3' title='3 stars'>3 stars</label>
                                            <input id='my_rating_4' name='my_rating' type='radio' value='4'>
                                            <label for='my_rating_4' title='4 stars'>4 stars</label>
                                            <input id='my_rating_5' name='my_rating' type='radio' value='5'>
                                            <label for='my_rating_5' title='5 stars'>5 stars</label>
                                        </div>
                                        <div class='output'>

                                            <span id='display_selected'></span>
                                            @lang('site.star')
                                        </div>

                                    </div>

                                    {{-- inputs --}}
                                    <div class="inputs">

                                        {{-- title input --}}
                                        <div class="form-group">
                                            <label for="Title">@lang('site.title')</label>
                                            <input type="text" class="form-control" name="title" id="Title" required>
                                        </div>

                                        {{-- features --}}
                                        <div class="form-group">
                                            <label for="Features">@lang('site.features')</label>
                                            <input type="text" class="form-control" name="features" id="Features"
                                                required>
                                        </div>

                                        {{-- defects --}}
                                        <div class="form-group">
                                            <label for="Defects">@lang('site.defects')</label>
                                            <input type="text" class="form-control" name="defects" id="Defects"
                                                required>
                                        </div>

                                        {{-- review --}}
                                        <div class="form-group textarea">
                                            <label for="review">@lang('site.review')</label>
                                            <textarea class="form-control" name="review" id="review"></textarea>
                                            <p>@lang('site.review_note')</p>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn add">
                                            @lang('site.add')
                                            <i class="fas fa-long-arrow-alt-left"></i>

                                        </button>
                                        <button class="cancel btn">@lang('site.cancel')</button>
                                    </div>
                                </form>

                            </div>

                            @endauth

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End product-details-and-reviews section -->

        <!-- Start Recent buys section -->
        <div class="recent-buys">
            <h3>@lang('site.recent')</h3>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-3 col-sm-6">
                    <div class="recent-buy-product">
                        <div class="product-img">
                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                alt="">
                        </div>
                        <div class="product-details">
                            <a href="">
                                <h6 class="product-name">
                                    {{$product->name}}
                                </h6>
                            </a>
                            <div class="buy">
                                <span class="price">{{$product->finalPrice()}}$</span>

                                <span class="hh">|</span>

                                @auth

                                @if (in_array($product->id, auth()->user()->products->pluck('id')->toArray()))
                                <a class="btn btn-buy" style="font-size: 13px">
                                    @lang('site.remove_cart')
                                </a>

                                @else
                                <a class="btn btn-buy" style="font-size: 13px">
                                    @lang('site.add_cart')
                                </a>

                                @endif


                                @else
                                <a class="btn btn-buy" onclick="login_model()" style="font-size: 13px">
                                    @lang('site.add_cart')
                                </a>

                                @endauth


                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- End Recent buys section -->

    </div>
</section>
<!-- End product page -->
<!-- Start Subscribe section -->
@endsection