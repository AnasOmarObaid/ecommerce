@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.orders') | @lang('site.add_order')</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-clients"></i> @lang('site.orders')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item p-0"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item p-0"><a
                                href="{{route('dashboard.client.index')}}">@lang('site.clients')</a>
                        </li>
                        <li class="breadcrumb-item active p-0">@lang('site.add_order')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('layouts.dashboard.partetions.errors')
                {{-- section --}}

                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- category list -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                                        @lang('site.categories')
                                    </h3>

                                    <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (count($categories) <= 0 ) <p class=" alert alert-danger">
                                        @lang('site.no_category_info') <a href="{{route('dashboard.category.create')}}"
                                            class="">@lang('site.click_me')</a>
                                        </p>
                                        @else
                                        @foreach ($categories as $category)
                                        {{-- categories List --}}
                                        <div class="card card-info">
                                            <div class="card-header" data-toggle="collapse"
                                                href="#{{str_replace(' ', '-', $category->name)}}" role="button"
                                                aria-expanded="false" aria-controls="1" style="cursor:pointer">
                                                <h3
                                                    class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                                                    {{$category->name}}</h3>
                                            </div>
                                            <div class="collapse" id="{{str_replace(' ', '-', $category->name)}}">
                                                <div class="card-body">
                                                    @if ($category->products()->count() == 0)
                                                    <p class="alert alert-danger">@lang('site.no_product_info') <a
                                                            href="{{route('dashboard.product.create')}}">@lang('site.click_me')</a>
                                                    </p>
                                                    @else
                                                    <table class="table table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">@lang('site.name')</th>
                                                                <th scope="col">@lang('site.stoke')</th>
                                                                <th scope="col">@lang('site.current_sale_price')</th>
                                                                <th scope="col">@lang('site.add')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($category->products as
                                                            $product)
                                                            <tr id="product-{{$product->id}}">
                                                                <td><span>{{$product->name}}</span></td>
                                                                <td><span
                                                                        id="stock-product{{$product->id}}">{{$product->stoke }}</span>
                                                                </td>
                                                                <td><span
                                                                        class="span-price">{{$product->finalPrice()}}</span>
                                                                </td>
                                                                <td>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-success product-data"
                                                                        id="link-product{{$product->id}}"
                                                                        data-name="{{$product->name}}"
                                                                        data-id="{{$product->id}}"
                                                                        data-price="{{$product->finalPrice()}}"
                                                                        data-quantity="{{$product->stoke}}">
                                                                        <i class="fas fa-plus fa-fw"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End categories List --}}
                                        @endforeach
                                        @endif
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- End category list -->
                        </div>

                        <div class="col-md-6">
                            <!-- order list -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}} ">
                                        @lang('site.orders')
                                    </h3>
                                    <div class="card-tools  float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}} ">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="order-submit" method="POST"
                                        action="{{route('dashboard.client.order.store', $client)}}">
                                        @csrf
                                        @method('POST')
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><span>@lang('site.product')</span></th>
                                                    <th scope="col"><span>@lang('site.quantity')</span></th>
                                                    <th scope="col"><span>@lang('site.price')</span></th>
                                                    <th scope="col"><span>@lang('site.action')</span></th>
                                                </tr>
                                            </thead>
                                            <thead class="table-head">

                                            </thead>
                                        </table>
                                        <h5 style="margin-top:12px">Total: <span id="total-price"></span></h5>
                                        <button type="submit" class="btn btn-info btn-block disabled btn-submit">Add
                                            Product</button>
                                    </form>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- End order list -->
                        </div>


                        <!-- order previous list -->
                        <div class="col-md-6">
                            <div class="card card-dark card-outline">
                                <div class="card-header">
                                    <h3 class="card-title float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">

                                        @lang('site.previous')
                                    </h3>
                                    <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (count($orders) == 0)
                                    <p class="alert alert-danger">@lang('site.no_order')</p>
                                    @else
                                    @foreach ($orders as $index=>$order)
                                    <div class="card card-dark">
                                        <div class="card-header" data-toggle="collapse" href="#order{{$order->id}}"
                                            role="button" aria-expanded="false" aria-controls="1"
                                            style="cursor:pointer">
                                            Order Number {{$index+1}}
                                        </div>

                                        <div class="collapse" id="order{{$order->id}}">
                                            <div class="card-body">
                                                <table class="table table-hover text-center">
                                                    <thead>
                                                        <td>@lang('site.name')</td>
                                                        <td>@lang('site.total')</td>
                                                        <td>@lang('site.quantity')</td>
                                                        <td>@lang('site.add_at')</td>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                        <tr>
                                                            <td>{{$product->name}}</td>
                                                            <td>{{$order->total_price}}</td>
                                                            <td>{{$product->pivot->quantity}}</td>
                                                            <td>{{$order->created_at->toFormattedDateString()}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <!-- /.card-body-->
                            </div>


                        </div>
                </section>

                {{-- end section --}}
            </div>
        </div>
    </div>

</div>
@endsection