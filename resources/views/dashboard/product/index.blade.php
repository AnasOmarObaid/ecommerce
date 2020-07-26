@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.products') | @lang('site.index')</title>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="fab fa-product-hunt fa-fw"></i> @lang('site.products')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('site.products')
                        </li>
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
                                            placeholder="@lang('site.search_place_product')">
                                    </div>{{-- end col --}}

                                    {{-- select categories --}}
                                    <div class="col-md-4 my-auto">
                                        <select name="category" class="select2 form-control">
                                            <option value="">@lang('site.all_cat')</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if (request('category'))
                                                {{request('category') == $category->id ? 'selected' : ''}} @endif>
                                                {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>{{-- end col --}}

                                    <div class="col-md-4 my-auto">

                                        <div class="row">

                                            <div class="col-md-12">
                                                {{-- search btn --}}
                                                <button type="submit" class="btn btn-sm btn-info"><i
                                                        class="fas fa-search"></i>
                                                    @lang('site.search')
                                                </button>

                                                {{-- create products --}}
                                                @if (auth()->user()->isAbleTo('create_products'))
                                                <a href="{{route('dashboard.product.create')}}"
                                                    class="btn btn-success btn-sm "><i class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_product')
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-success btn-sm disabled"><i
                                                        class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_product')
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
                            @if ($products->count() !=0)
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>

                                        <th>@lang('site.name')</th>

                                        <th>@lang('site.poster')</th>

                                        <th>@lang('site.add_by')</th>

                                        <th>@lang('site.purchase_price')</th>

                                        <th>@lang('site.sale_price')</th>

                                        <th>@lang('site.profit')</th>

                                        <th>@lang('site.stoke')</th>

                                        <th>@lang('site.created_at')</th>

                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $count=>$product)
                                    <tr>
                                        <th>{{++$count}}</th>

                                        <td>{{$product->name}}</td>

                                        <td><img src="{{$product->getPoster()}}" alt="poster image"
                                                style="max-width: 85px; max-height:70px">
                                        </td>

                                        <td>{{ $product->user_id == null ? __('site.no_value') : $product->user->getFullName() }}
                                        </td>

                                        <td>{{$product->purchase_price}}$</td>

                                        <td>{{$product->new_sale_price ?? $product->curet_sale_price}}$</td>

                                        <td>{{$product->profit()}}%</td>

                                        <td>{{$product->stoke}}</td>

                                        <td>{{$product->created_at->toFormattedDateString()}}</td>

                                        <td>
                                            {{-- edit btn --}}
                                            @if (auth()->user()->isAbleTo('update_products'))
                                            <a class="btn btn-primary btn-sm mb-2"
                                                href="{{route('dashboard.product.edit', $product)}}"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @else
                                            <a class="btn btn-primary btn-sm disabled mb-2" href="#"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @endif

                                            {{-- delete form --}}
                                            @if (auth()->user()->isAbleTo('delete_products'))
                                            <form style="display: inline-block" class="delete_user_btn"
                                                data-url=" {{route('dashboard.product.destroy', $product)}}">
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

                                        @endforeach
                                </tbody>
                            </table>
                            {{-- no record --}}
                            @else
                            <div class="alert alert-dark" role="alert">
                                <h4 class="alert-heading">@lang('site.no_data_found')</h4>
                                <p>@lang('site.no_product_info') <a class="badge badge-primary"
                                        style="text-decoration: none"
                                        href="{{route('dashboard.product.create')}}">@lang('site.click_me')</a>
                                </p>
                                <hr>
                                <p class="mb-0">@lang('site.advice')</p>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $products->withQueryString()->links() }}
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