<!-- Start Subscribe section -->
<section class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">

                <div class="subscribe-form">
                    <h3>@lang('site.get_app')</h3>
                    <form action="">
                        <input type="text" class="form-control" placeholder="{{__('site.get_phone')}}">


                        <button type="submit" class="btn">@lang('site.get_link')
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </button>

                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="subscribe-img">
                    <img src="{{asset('public\images\app_link.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="applications-links">
                    <a href=""><img src="{{asset('public\images\App_Store.png')}}" alt="store image"></a>
                    <a href=""><img src="{{asset('public\images\Google_Play.png')}}" alt="google play image"></a>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Subscribe section -->