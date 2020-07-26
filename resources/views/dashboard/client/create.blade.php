@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.clients') | @lang('site.add_client')</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-clients"></i> @lang('site.clients')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item p-0"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item p-0"><a
                                href="{{route('dashboard.client.index')}}">@lang('site.clients')</a>
                        </li>
                        <li class="breadcrumb-item active p-0">@lang('site.add_client')</li>
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
                <form action="{{route('dashboard.client.store')}}" method="post" class="allow-delete"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <section class="content">
                        {{-- General info --}}

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}} ">
                                    @lang('site.general_info')
                                </h3>

                                <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div> {{-- end tools --}}

                            </div>

                            <div class="card-body">

                                {{-- first name --}}
                                <div class="form-group">
                                    <label>@lang('site.first_name')</label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}"
                                        class="form-control">
                                </div>

                                {{-- last name --}}
                                <div class="form-group">
                                    <label>@lang('site.last_name')</label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}"
                                        class="form-control">
                                </div>

                                {{-- image erea --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('site.select_image')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input image-preview"
                                                id="exampleInputFile">
                                            <label class="custom-file-label"
                                                for="exampleInputFile">@lang('site.select_image')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- show image erae --}}
                                <div class="form-group text-center m-0">
                                    <img src="{{asset('public\images\upload\client\image\default.jpg')}}"
                                        alt="client image" class="img-thumbnail image-area"
                                        style="width: 100px; height:100px">
                                </div>

                                {{-- email --}}
                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                </div>

                                {{-- password --}}
                                <div class="form-group">
                                    <label>@lang('site.password')</label>
                                    <input type="password" name="password" value="{{old('password')}}"
                                        class="form-control">
                                </div>

                                {{-- confirmation password --}}
                                <div class="form-group">
                                    <label>@lang('site.conf_pass')</label>
                                    <input type="password" name="password_confirmation" value="{{old('password')}}"
                                        class="form-control">
                                </div>

                                {{-- enter country --}}
                                <div class="form-group">
                                    <label>@lang('site.select_country')</label>
                                    <br>
                                    <input class="country_selector form-control" name="country" type="text">
                                </div>

                                {{-- city--}}
                                <div class="form-group">
                                    <label>@lang('site.city')</label>
                                    <input type="text" name="city" value="{{old('city')}}" class="form-control">
                                </div>

                                {{-- postal code--}}
                                <div class="form-group">
                                    <label>@lang('site.postal_code')</label>
                                    <input type="number" name="postal_code" value="{{old('postal_code')}}"
                                        class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="#"
                                    class="btn btn-secondary  remove_btn_input float-{{app()->getLocale() == 'en' ? 'right' : 'left'}}">
                                    <i class="fa fa-deaf"></i> @lang('site.cancel')</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i>
                                    @lang('site.create_client')</button>

                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </form>
            </div>
        </div>
    </div>

</div>
@endsection