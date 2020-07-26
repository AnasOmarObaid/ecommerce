@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.confirm')</title>
@endsection

@section('content')

<!-- Start cart page -->
<section class="cart-page">

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade  show active" id="confirmProcess" role="tabpanel"
            aria-labelledby="confirmProcess-tab">

            <div class="confirmProcess-sec mt-1">
                <div class="container">
                    <div class="confirmProcess-content">
                        <div class="img-done animated fadeIn">
                            <img src="{{asset('public/images/done.svg')}}" alt="">
                        </div>
                        <h3>@lang('site.msg_success')

                        </h3>
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
        <!-- End userData section -->

    </div>
</section>
<!-- End cart page-->

@endsection