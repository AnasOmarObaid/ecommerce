@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.categories') | @lang('site.index')</title>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="fas fa-list fa-fw"></i> @lang('site.categories')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('site.categories')
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
                                            placeholder="@lang('site.search_place_category')">
                                    </div>{{-- end col --}}

                                    <div class="col-md-8 my-auto">

                                        <div class="row">

                                            <div class="col-md-12">
                                                {{-- search btn --}}
                                                <button type="submit" class="btn btn-sm btn-info"><i
                                                        class="fas fa-search"></i>
                                                    @lang('site.search')
                                                </button>

                                                {{-- create categories --}}
                                                @if (auth()->user()->isAbleTo('create_categories'))
                                                <a href="{{route('dashboard.category.create')}}"
                                                    class="btn btn-success btn-sm "><i class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_category')
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-success btn-sm disabled"><i
                                                        class="fas fa-plus fa-fw"></i>
                                                    @lang('site.create_category')
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
                            @if ($categories->count() !=0)
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.product_count')</th>
                                        <th>@lang('site.products')</th>
                                        <th>@lang('site.add_by')</th>
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $count=>$category)
                                    <tr>
                                        <th>{{++$count}}</th>

                                        <td>
                                            <img src="{{$category->getImagePath()}}" style="height: 40px" width="40px"
                                                alt="category Image">
                                        </td>

                                        <td>{{$category->name}}</td>

                                        <td>{{$category->products_count}}</td>

                                        <td><a href="{{route('dashboard.product.index', ['category' => $category->id])}}"
                                                class="btn btn-info btn-sm">@lang('site.products')</a></td>

                                        <td>{{ $category->user_id == null ? __('site.no_value') : $category->user->getFullName() }}
                                        </td>
                                        <td>{{$category->created_at->toFormattedDateString()}}</td>
                                        <td>

                                            {{-- edit btn --}}
                                            @if (auth()->user()->isAbleTo('update_categories'))
                                            <a class="btn btn-primary btn-sm mb-2"
                                                href="{{route('dashboard.category.edit', $category)}}"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @else
                                            <a class="btn btn-primary btn-sm disabled mb-2" href="#"><i
                                                    class="fas fa-edit fa-fw"></i> @lang('site.edit')
                                            </a>
                                            @endif

                                            {{-- delete form --}}
                                            @if (auth()->user()->isAbleTo('delete_categories'))
                                            <form style="display: inline-block" class="delete_user_btn"
                                                data-url=" {{route('dashboard.category.destroy', $category)}}">
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
                                <p>@lang('site.no_category_info') <a class="badge badge-primary"
                                        style="text-decoration: none"
                                        href="{{route('dashboard.category.create')}}">@lang('site.click_me')</a>
                                </p>
                                <hr>
                                <p class="mb-0">@lang('site.advice')</p>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $categories->withQueryString()->links() }}
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