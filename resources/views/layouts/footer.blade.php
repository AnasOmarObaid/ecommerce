<!-- Start Footer section -->
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="logo-and-soical">
                    <div class="footer-logo">
                        <a href="index.html"><img src="images/logo-white.png" alt=""></a>
                    </div>
                    <ul class="social-media">
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg col-sm">
                <div class="footer-list">
                    <h4>@lang('site.support')</h4>
                    <ul>
                        <li><a href="{{route('front.support')}}">@lang('site.ask')</a></li>
                        <li><a href="{{route('front.support')}}">@lang('site.contact')</a></li>
                        <li><a href="{{route('front.support')}}">@lang('site.qp')

                            </a></li>

                    </ul>
                </div>
            </div>
            <div class="col-lg col-sm">
                <div class="footer-list">
                    <h4>@lang('site.order_and_contact')</h4>
                    <ul>
                        <li><a href="{{route('front.delivery')}}">@lang('site.company_d')

                            </a></li>
                        <li><a href="{{route('front.delivery')}}">@lang('site.policity')</a></li>


                    </ul>
                </div>
            </div>
            <div class="col-lg col-sm">
                <div class="footer-list">
                    <h4>@lang('site.about_nemaa')</h4>
                    <ul>
                        <li><a href="{{route('front.nama')}}">@lang('site.who_us')

                            </a></li>
                        <li><a href="{{route('front.nama')}}">@lang('site.protection')</a></li>


                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-us-footer">
                    <h4>@lang('site.contact_us')</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-phone-volume"></i>
                                2-800-132-0000
                            </a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i>info@nama.qa

                            </a></li>


                    </ul>
                    <form action="">
                        <label for="sub-email">@lang('site.subscripe')

                        </label>
                        <div class="form-group">
                            <input type="email" id="sub-email" class="form-control" placeholder="{{__('email')}}">


                            <button type="submit" class="btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <h6 class="copy-right">
            @lang('site.all_rights') ©2019
        </h6>
    </div>
</section>
<!-- End Footer section -->