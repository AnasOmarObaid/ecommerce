@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.orders') | @lang('site.index')</title>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="nav-iconfas fas fa-folder-open"></i> @lang('site.orders')
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active">@lang('site.orders')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- Client list -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">

                            <h3 class="card-title" style="float: right">
                                <i class="far fa-chart-bar"></i>
                                @lang('site.client_list')
                            </h3>

                            {{-- Form --}}
                            <form class="col-md-9 form-inline" style="justify-content: {{app()->getLocale() == 'ar' ? 'flex-end' : ''}};
                            float: left;">
                                <div class="form-group mx-2">
                                    <input type="search" class="form-control" name="search"
                                        placeholder="{{__('site.search')}}" required
                                        value="{{request('search') ?? ''}}">
                                </div>

                                <div class="" style="">
                                    <button type="submit" class="btn btn-success btn-sm"> <i
                                            class="fas fa-search fa-fw"></i>
                                        @lang('site.search')</button>
                                </div>
                            </form>
                            <!-- /.End Form -->
                        </div>
                        {{-- Client List --}}
                        <div class="card-body">
                            @if (count($orders) <= 0 ) <p class=" alert alert-danger">@lang('site.no_client_info')</p>
                                @else
                                <table class="table table-hover text-center">
                                    <thead>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.add_at')</th>
                                        <th>@lang('site.action')</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->user->getFullName()}}</td>

                                            <td>{{$order->total_price}}</td>

                                            <td>{{$order->created_at->toFormattedDateString()}}</td>
                                            <td>
                                                <a href="#order"
                                                    data-url="{{route('dashboard.order.products', $order)}}"
                                                    class="btn btn-sm btn-info get-order">
                                                    <i class="fas fa-shopping-basket fa-fw"></i>
                                                    @lang('site.show')
                                                </a>

                                                @if (auth()->user()->isAbleTo('update_orders'))

                                                <a class="btn btn-sm btn-warning"
                                                    href="{{route('dashboard.order.edit', $order)}}"
                                                    style="color:white"><i class="fas fa-store-alt fa-fw"></i>
                                                    @lang('site.edit')</a>

                                                @else
                                                <a href="#" class="btn btn-sm btn-warning disabled"
                                                    style="color:white"><i class="fas fa-store-alt fa-fw"></i>
                                                    @lang('site.edit')</a>
                                                @endif

                                                {{-- delete orders --}}
                                                @if (auth()->user()->isAbleTo('delete_orders'))
                                                <form action="" class="delete_user_btn" style="display:inline-block"
                                                    data-url=" {{route('dashboard.order.destroy', $order)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="far fa-trash-alt fa-fw"></i>@lang('site.delete')
                                                    </button>
                                                </form>
                                                @else
                                                <a href="#" class="btn btn-sm btn-danger disabled"><i
                                                        class="far fa-trash-alt fa-fw"></i>
                                                    @lang('site.delete')</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="margin-top:15px">
                                    {{ $orders->appends(['search' => request('search')])->links()}}
                                </div>
                                @endif
                        </div>
                        {{-- End Client List --}}
                    </div>
                    <!-- End Client list -->
                </div>

                <div class="col-md-5">

                    <!-- Order list -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title" style="float: right">
                                <i class="far fa-chart-bar"></i>
                                @lang('site.order_list')
                            </h3>
                            <div class="card-tools" style="float:left">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" id="order-data">
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- End Order list -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection