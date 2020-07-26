@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.clients') | @lang('site.index')</title>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="fas fa-user-tie"></i>@lang('site.clients')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active">@lang('site.clients')</li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card  card-primary card-outline">
                        <div class="card-header">

                            <form action="" method="get">

                                <div class="row">

                                    {{-- search input --}}
                                    <div class="col-md-4 my-auto">
                                        <input type="search" name="search" class="form-control"
                                            value="{{request('search')}}"
                                            placeholder="@lang('site.search_client_place')">
                                    </div>{{-- end col --}}

                                    <div class="col-md-8 my-auto">

                                        <div class="row">

                                            <div class="col-md-6">
                                                {{-- search btn --}}
                                                <button type="submit" class="btn btn-sm btn-info"><i
                                                        class="fas fa-search"></i>
                                                    @lang('site.search')
                                                </button>

                                                {{-- create clients --}}
                                                @if (auth()->user()->isAbleTo('create_users'))
                                                <a href="{{route('dashboard.client.create')}}"
                                                    class="btn btn-success btn-sm "><i class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_client')
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-success btn-sm disabled"><i
                                                        class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_client')
                                                </a>
                                                @endif
                                            </div>{{-- end col --}}
                                        </div>{{-- end row --}}

                                    </div>{{-- end col --}}

                                </div>{{-- end row ---}}
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($clients->count() !=0)
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.first_name')</th>
                                        <th>@lang('site.last_name')</th>
                                        <th>@lang('site.email')</th>
                                        <th>@lang('site.add_order')</th>
                                        <th>@lang('site.country')</th>
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $count=>$client)
                                    <tr>
                                        <th>{{++$count}}</th>
                                        <td>
                                            <img src=" {{$client->getPathImage()}}" style="height: 40px" width="40px"
                                                alt="client Image">
                                        </td>
                                        <td>{{$client->first_name}}</td>
                                        <td>{{$client->last_name}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>
                                            @if (auth()->user()->isAbleTo('create_orders'))
                                            <a href="{{route('dashboard.client.order.create', $client->id)}}"
                                                class="btn btn-info btn-sm">@lang('site.orders')</a>
                                            @else
                                            <a href="#" class="btn btn-info btn-sm disabled">@lang('site.orders')</a>
                                            @endif
                                        </td>
                                        <td>{{$client->country ?? __('site.no_value')}}</td>
                                        <td>{{$client->created_at->toFormattedDateString()}}</td>
                                        <td>

                                            {{-- edit btn --}}
                                            @if (auth()->user()->isAbleTo('update_users'))
                                            <a class="btn btn-primary btn-sm mb-2"
                                                href="{{route('dashboard.client.edit', $client)}}"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @else
                                            <a class="btn btn-primary btn-sm disabled mb-2" href="#"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @endif

                                            {{-- delete form --}}
                                            @if (auth()->user()->isAbleTo('delete_users'))
                                            <form style="display: inline-block" class="delete_user_btn"
                                                data-client="{{$client}}"
                                                data-url="{{route('dashboard.client.destroy', $client)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2"><i
                                                        class="fas fa-trash-alt fa-fw"></i>
                                                    @lang('site.delete')</button>
                                            </form>
                                            @else
                                            <button class="btn btn-danger btn-sm mb-2" disabled><i
                                                    class="fas fa-trash-alt fa-fw"></i>
                                                @lang('site.delete')
                                            </button>
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- no record --}}
                            @else
                            <div class="alert alert-dark" role="alert">
                                <h4 class="alert-heading">@lang('site.no_data_found')</h4>
                                <p>@lang('site.no_client_info') <a class="badge badge-primary"
                                        style="text-decoration: none"
                                        href="{{route('dashboard.client.create')}}">@lang('site.click_me')</a>
                                </p>
                                <hr>
                                <p class="mb-0">@lang('site.advice')</p>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $clients->withQueryString()->links() }}
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->

                </div>{{--end section --}}
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection