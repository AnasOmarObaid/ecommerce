@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.stores') | @lang('site.edit_store')</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-store fa-fw"></i> @lang('site.stores')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"
                        style="float: {{app()->getLocale() == 'ar'? 'left !important' : 'none'}}">
                        <li class="breadcrumb-item p-0"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item p-0"><a
                                href="{{route('dashboard.store.index')}}">@lang('site.stores')</a>
                        </li>
                        <li class="breadcrumb-item active p-0">@lang('site.edit_store')</li>
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
                <form action="{{route('dashboard.store.update', $store)}}" method="post" class="allow-delete"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="content">
                        <div class="row">
                            {{-- General info --}}
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3
                                            class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}} ">
                                            @lang('site.general_info_store')
                                        </h3>

                                        <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div> {{-- end tools --}}

                                    </div>

                                    <div class="card-body">

                                        @foreach (config('translatable.locales') as $locale)


                                        {{--  name --}}
                                        <div class="form-group">
                                            {{-- site.ar.name  and site.en.name--}}
                                            <label>@lang('site.' . $locale . '.name')</label>
                                            {{-- ar[name] and en[name] --}}
                                            <input type="text" name="{{$locale}}[name]"
                                                value="{{old($locale . '.name', $store->translate($locale)->name)}}"
                                                class="form-control">
                                        </div>

                                        @endforeach

                                        {{-- rating --}}
                                        <div class="form-group">
                                            <label>@lang('site.rating')</label>
                                            <input type="number" class="form-control" min="0" max="5" name="rating"
                                                value="{{old('rating', $store->rating)}}">
                                        </div>


                                        {{-- category --}}
                                        <div class="form-group">
                                            <label>@lang('site.categories')</label>
                                            <select name="categories[]" multiple class="select2 form-control">
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @foreach ($store->categories as
                                                    $store_category)
                                                    @if ($store_category->id == $category->id)
                                                    selected
                                                    @endif
                                                    @endforeach >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        {{-- image erea --}}
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('site.select_image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image"
                                                        class="custom-file-input image-preview" id="exampleInputFile">
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
                                            <img src="{{$store->getImagePath()}}" alt="store image"
                                                class="img-thumbnail image-area" style="width: 100px; height:100px">
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>


                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="#"
                                    class="btn btn-secondary  remove_btn_input float-{{app()->getLocale() == 'en' ? 'right' : 'left'}}">
                                    <i class="fa fa-deaf"></i> @lang('site.cancel')</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i>
                                    @lang('site.edit_store')</button>

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