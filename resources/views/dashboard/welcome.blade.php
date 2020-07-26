@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.welcome')</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.dashboard')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item"><a href="#">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active">@lang('site.dashboard')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content mt-3">

        <div class="container-fluid">
            <div class="row">
                <!-- users -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$user_count}}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{route('dashboard.user.index')}}" class="small-box-footer">@lang('site.more_info')<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- categories --}}
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$category_count}}</h3>

                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('dashboard.category.index')}}"
                            class="small-box-footer">@lang('site.more_info')<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- client --}}
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$client_count}}</h3>

                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{route('dashboard.client.index')}}" class="small-box-footer">@lang('site.more_info')<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- products --}}
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$product_count}}</h3>

                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('dashboard.product.index')}}"
                            class="small-box-footer">@lang('site.more_info')<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            <div class="row p-0 pt-3">
                <div class="col-12 p-0">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="col-md-12 p-0">
                                <!-- LINE CHART -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                                            @lang('site.sale_g')
                                        </h3>

                                        <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                    class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="myfirstchart" style="height: 250px;"></div>
                                    </div>
                                    <!-- /.card-body-->
                                </div>
                                <!-- /.col (RIGHT) -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')
<script>
    new Morris.Line({
// ID of the element in which to draw the chart.
element: 'myfirstchart',

data: [
        @foreach ($sales_data as $data)
            {
                
                ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"

            },
        @endforeach
],
// The name of the data record attribute that contains x-values.
xkey: 'ym',
// A list of names of data record attributes that contain y-values.
ykeys: ['sum'],
// Labels for the ykeys -- will be displayed when you hover over the
// chart.
labels: ['Value']
});

</script>
@endpush