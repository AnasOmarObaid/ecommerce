@extends('layouts.app')

@section('title')
<title> @lang('site.welcome') | @lang('site.delivery')</title>
@endsection

@section('content')
<!-- Start account-setting page -->
<section class="simple-template">
    <h1>@lang('site.order_delivery')
    </h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="DeliveryPartners-tab" data-toggle="tab" href="#DeliveryPartners" role="tab"
                aria-controls="DeliveryPartners" aria-selected="false">@lang('site.company_delivery')

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="ReturnPolicy-tab" data-toggle="tab" href="#ReturnPolicy" role="tab"
                aria-controls="ReturnPolicy" aria-selected="true">@lang('site.policity')



            </a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- Start DeliveryPartners section -->

        <div class="tab-pane fade active show" id="DeliveryPartners" role="tabpanel"
            aria-labelledby="DeliveryPartners-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.company_delivery')</h2>

                    <p>@lang('site.msg_qp')</p>
                    <p>
                        @lang('site.msg_qp')
                    </p>

                </div>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>
        <!-- End DeliveryPartners section -->
        <div class="tab-pane fade " id="ReturnPolicy" role="tabpanel" aria-labelledby="ReturnPolicy-tab">
            <div class="simple-template-sec">
                <div class="container">
                    <h2>@lang('site.policity')</h2>

                    <p>@lang('site.msg_qp') </p>
                    <p>
                        @lang('site.msg_qp')
                    </p>

                </div>

            </div>
            <!-- End userData section -->
            <!-- Start userData section -->
        </div>

    </div>
</section>
<!-- End account-setting page-->
@endsection