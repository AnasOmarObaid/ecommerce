@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.who_us')</title>
@endsection

@section('content')
<!-- Start account-setting page -->
<section class="simple-template">
    <h1>عن نماء</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="aboutUs-tab" data-toggle="tab" href="#aboutUs" role="tab"
                aria-controls="aboutUs" aria-selected="false">@lang('site.we_us')



            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="buyerprotection-tab" data-toggle="tab" href="#buyerprotection" role="tab"
                aria-controls="buyerprotection" aria-selected="true">@lang('site.protection')



            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- Start aboutUs section -->

        <div class="tab-pane fade active show" id="aboutUs" role="tabpanel" aria-labelledby="aboutUs-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.we_us')</h2>

                    <p>@lang('site.msg_qp') </p>
                    <p>@lang('site.msg_qp') </p>

                </div>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>
        <!-- End aboutUs section -->
        <div class="tab-pane fade" id="buyerprotection" role="tabpanel" aria-labelledby="buyerprotection-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.protection')</h2>

                    <p>@lang('site.msg_qp') </p>
                    <p>@lang('site.msg_qp') </p>

                </div>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>

    </div>
</section>
<!-- End account-setting page-->
@endsection