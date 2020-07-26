@extends('layouts.app')

@section('title')
<title>@lang('site.welcome') | @lang('site.support')</title>
@endsection

@section('content')
<!-- Start account-setting page -->
<section class="simple-template">
    <h1>@lang('site.support')

    </h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="AskTheMerchant-tab" data-toggle="tab" href="#AskTheMerchant" role="tab"
                aria-controls="AskTheMerchant" aria-selected="false">@lang('site.ask')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="ConnectwithNama-tab" data-toggle="tab" href="#ConnectwithNama" role="tab"
                aria-controls="ConnectwithNama" aria-selected="true">@lang('site.contact')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="Faq-tab" data-toggle="tab" href="#Faq" role="tab" aria-controls="Faq"
                aria-selected="true">@lang('site.qp')

            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade active show" id="AskTheMerchant" role="tabpanel" aria-labelledby="AskTheMerchant-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.ask')</h2>

                    <p>@lang('site.msg_qp') </p>
                </div>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>
        <div class="tab-pane fade " id="ConnectwithNama" role="tabpanel" aria-labelledby="ConnectwithNama-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.contact')</h2>

                    <p>@lang('site.msg_qp') </p>

                </div>

            </div>

        </div>

        <div class="tab-pane fade " id="Faq" role="tabpanel" aria-labelledby="Faq-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.qp')</h2>

                    <p>@lang('site.msg_qp') </p>

                </div>

            </div>

        </div>

    </div>
</section>
<!-- End account-setting page-->
@endsection