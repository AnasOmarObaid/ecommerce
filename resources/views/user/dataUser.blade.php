@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.user')</title>
@endsection

@section('content')
<section class="account-setting-page">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" href="{{route('front.userData')}}" role="tab" aria-controls="userData"
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
            <a class="nav-link" href="{{route('front.rating')}}" role="tab" aria-controls="rates"
                aria-selected="false">@lang('site.rating')
            </a>
        </li>
    </ul>

    <div class=" tab-content" id="myTabContent">
        <!-- Start userData section -->
        <div class="tab-pane fade  show active" id="userData" role="tabpanel" aria-labelledby="userData-tab">
            <div class="user-data-sec">
                @include('layouts.dashboard.partetions.errors')
                <form action="{{route('front.user.update', auth()->user())}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="container">

                        <h3>
                            @lang('site.user_data')

                        </h3>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="user-data-inputs">
                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input type="email" class="form-control" name="email" required
                                            value="{{auth()->user()->email}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('site.first_name')

                                                </label>
                                                <input type="text" name="first_name" required
                                                    value="{{auth()->user()->first_name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('site.last_name')</label>
                                                <input type="text" name="last_name" required
                                                    value="{{auth()->user()->last_name}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-address">
                                    <h4>@lang('site.ad_p')</h4>
                                    <div class="form-group">
                                        <label>@lang('site.country')</label>
                                        <input type="text" name="country" value="{{auth()->user()->country}}"
                                            class="form-control">

                                        <div class="form-group mt-3">
                                            <label>@lang('site.city')</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{auth()->user()->city}}">
                                        </div>


                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>@lang('site.zip_code')</label>
                                                    <input type="text" class="form-control" name="postal_code"
                                                        value="{{auth()->user()->postal_code}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>@lang('site.phone_number')</label>
                                                    <input type="text" name="phone_number" class="form-control"
                                                        value="{{auth()->user()->phone_number}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="profile-photo">

                                    <div class="show-profile-photo">
                                        <img src="{{auth()->user()->getPathImage()}}" alt="" class="image-area">

                                    </div>

                                    <div class="add-profile-photo">
                                        <label for="add-profile-photo" class="btn"> <i class="fas fa-camera"></i>
                                            @lang('site.upload_new_image')
                                        </label>

                                        <input type="file" name="image" id="add-profile-photo" class="image-preview">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="next-prev">
                            <div class="prev">
                                <a href=""> <i class="fas fa-long-arrow-alt-right"></i>@lang('site.back_shop')</a>
                            </div>

                            <div class="next">
                                <button class="btn">@lang('site.update_data')</button>
                            </div>
                        </div>


                    </div>
                </form>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>


        <!-- End userData section -->

    </div>
</section>
@endsection