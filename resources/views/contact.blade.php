@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.contact_us')</title>
@endsection

@section('content')
<!-- Start account-setting page -->
<section class="account-setting-page contact-page">

    <!-- Start userData section -->
    <form action="">
        <div id="userData">
            <div class="user-data-sec">
                <div class="container">
                    <h2 class="be-merchant-title mb-5">@lang('site.contact_us')</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="user-data-inputs">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>@lang('site.name')</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>@lang('site.email')</label>
                                                    <input type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label>@lang('site.phone_number')</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.add_msg')</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.msg')

                                            </label>
                                            <textarea rows="5" class="form-control"> </textarea>
                                        </div>




                                    </div>
                                    <div class="next-prev d-flex justify-content-center mt-5">
                                        <div class="next">
                                            <button class="btn" type="submit">@lang('site.send_msg')</button>
                                        </div>


                                    </div>
                                </div>



                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="contact-details ">
                                <div class="details-box">
                                    <h6>@lang('site.address')</h6>
                                    <h5>شارع 123 , الدوحة , قطر</h5>
                                </div>
                                <div class="details-box">
                                    <h6>@lang('site.phone_number')</h6>
                                    <h5>تلفون : +972541424854</h5>
                                    <h5>فاكس : +972541424854</h5>
                                </div>
                                <div class="details-box">
                                    <h6>@lang('site.box_email')</h6>
                                    <h5>41424854</h5>
                                </div>
                                <div class="details-box">
                                    <h6>@lang('site.email_code')</h6>
                                    <h5>41424854</h5>
                                </div>
                                <div class="details-box">
                                    <h6>@lang('site.work_time')</h6>
                                    <h5>من الأحد - الخميس 8:00صباحاً - 4:00 مساءً</h5>
                                </div>
                                <div class="details-box">
                                    <h6>@lang('site.location')</h6>
                                    <h5><span>الموقع على الخريطة</span><a href="#"><i
                                                class="fas fa-map-marker-alt"></i></a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>
    </form>

    <!-- End userData section -->



</section>
<!-- End account-setting page-->
@endsection