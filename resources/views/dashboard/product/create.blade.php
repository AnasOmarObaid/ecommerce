@extends('layouts.dashboard.app')

@section('title')
<title>@lang('site.dashboard') | @lang('site.products') | @lang('site.add_Product')</title>
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
                        <li class="breadcrumb-item p-0"><a href="{{route('dashboard.welcome')}}">@lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item p-0"><a
                                href="{{route('dashboard.product.index')}}">@lang('site.products')</a>
                        </li>
                        <li class="breadcrumb-item active p-0">@lang('site.add_Product')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="container">
        <div class="row">
            {{-- no categories found --}}
            @if ($categories->count() == 0)
            <div class="col-md-12">
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">@lang('site.no_cat_found')</h4>
                        <p>@lang('site.no_category_info') <a class="badge badge-primary" style="text-decoration: none"
                                href="{{route('dashboard.category.create')}}">@lang('site.click_me')</a>
                        </p>
                        <hr>
                        <p class="mb-0">@lang('site.advice')</p>
                    </div>
                </div>
            </div>
            @else
            {{-- content --}}
            <div class="col-12">
                @include('layouts.dashboard.partetions.errors')
                <form action="{{route('dashboard.product.store')}}" method="post" class="allow-delete"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <section class="content">
                        <div class="row">
                            {{-- General info --}}
                            <div class="col-md-6">
                                <input type="hidden" name="type" value="user">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3
                                            class="card-title  float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}} ">
                                            @lang('site.general_info_product')
                                        </h3>

                                        <div class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div> {{-- end tools --}}

                                    </div>

                                    <div class="card-body">

                                        {{-- category select --}}
                                        <div class="form-group">
                                            <label>@lang('site.category')</label>
                                            <select name="category_id" class="form-control select2">
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{--  name product--}}
                                        @foreach (config('translatable.locales') as $locale)

                                        <div class="form-group">
                                            {{-- site.ar.name  and site.en.name--}}
                                            <label>@lang('site.' . $locale . '.name')</label>
                                            {{-- ar[name] and en[name] --}}
                                            <input type="text" name="{{$locale}}[name]"
                                                value="{{old($locale . '.name')}}" class="form-control">
                                        </div>

                                        @endforeach

                                        {{--  description product--}}
                                        @foreach (config('translatable.locales') as $locale)

                                        <div class="form-group">
                                            {{-- site.ar.desc  and site.en.desc--}}
                                            <label>@lang('site.' . $locale . '.desc')</label>
                                            {{-- ar[name] and en[name] --}}
                                            <textarea name="{{$locale}}[description]" cols="50" class="form-control"
                                                rows="5">{{old($locale . '.description')}}</textarea>
                                        </div>

                                        @endforeach

                                        {{-- poster erea --}}
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('site.poster')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="poster"
                                                        class="custom-file-input image-preview" id="exampleInputFile">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">@lang('site.poster')</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="">Upload</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- show image area --}}
                                        <div class="form-group text-center m-0">
                                            <img src="" alt="poster image" class="img-thumbnail image-area"
                                                style="width: 100px; height:100px">
                                        </div>


                                        {{-- image area --}}
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('site.images')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="images[]" multiple
                                                        class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">@lang('site.image')</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="">Upload</span>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- stoke --}}
                                        <div class="form-group">
                                            <label>@lang('site.stoke')</label>
                                            <input type="number" min="1" max="10000000" name="stoke" name="stoke"
                                                value="{{old('stoke')}}" class="form-control">
                                        </div>

                                        {{-- curent sale price --}}
                                        <div class="form-group">
                                            <label>@lang('site.current_sale_price')</label>
                                            <input type="number" min="1" max="1000000" name="curet_sale_price"
                                                value="{{old('curet_sale_price')}}" class="form-control">
                                        </div>

                                        {{-- new sale price --}}
                                        <div class="form-group">
                                            <label>@lang('site.new_sale_price')</label>
                                            <input type="number" min="1" max="1000000" name="new_sale_price"
                                                value="{{old('new_sale_price')}}" value="{{old('new_sale_price')}}"
                                                class="form-control">
                                            <small>@lang('site.optional')</small>
                                        </div>

                                        {{-- 'purchase price --}}
                                        <div class="form-group">
                                            <label>@lang('site.purchase_price')</label>
                                            <input type="number" min="1" max="1000000" name="purchase_price"
                                                value="{{old('purchase_price')}}" class="form-control">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                            {{-- style and details --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3
                                                    class="card-title float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                                                    @lang('site.style_and_details')</h3>

                                                <div
                                                    class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse" data-toggle="tooltip"
                                                        title="Collapse">
                                                        <i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>

                                            <div class="card-body">

                                                {{-- gender --}}
                                                <div class="form-group">
                                                    <label>@lang('site.gender') (@lang('site.gender_desc'))</label>
                                                    <select name="gender" class="select2 form-control">
                                                        <option value=""></option>
                                                        <option value="1" {{old('gender') == 1 ? 'selected' : ''}}>
                                                            @lang('site.male')</option>
                                                        <option value="0" @if (request('gender'))
                                                            {{old('gender') == 0 ? 'selected' : ''}} @endif>
                                                            @lang('site.female')</option>
                                                    </select>
                                                    <small>@lang('site.optional')</small>
                                                </div>

                                                {{-- sizes --}}
                                                <div class="form-group">
                                                    <label>@lang('site.sizes') (@lang('site.size_desc'))</label>
                                                    <select name="sizes[]" class="form-control select2" multiple>
                                                        @foreach ($sizes as $size)
                                                        <option value="{{$size->id}}">
                                                            {{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>@lang('site.optional')</small>
                                                </div>

                                                {{-- raw --}}
                                                @foreach (config('translatable.locales') as $locale)
                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale .'.raw')</label>
                                                    <input type="text" name="{{$locale}}[raw]" class="form-control"
                                                        value="{{old($locale . '.raw')}}">
                                                    <small>@lang('site.optional')</small>
                                                </div>
                                                @endforeach

                                                {{-- colors select --}}
                                                <div class="form-group">
                                                    <label>@lang('site.colors_available')</label>
                                                    <select name="colors[]" class="form-control select2" multiple>
                                                        @foreach ($colors as $color)
                                                        <option value="{{$color->id}}">{{$color->color}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>@lang('site.optional')</small>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                    {{--  desc and uses--}}
                                    <div class="col-md-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3
                                                    class="card-title float-{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                                                    @lang('site.desc_use')</h3>

                                                <div
                                                    class="card-tools float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse" data-toggle="tooltip"
                                                        title="Collapse">
                                                        <i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                {{-- tages --}}
                                                @foreach (config('translatable.locales') as $locale)
                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale . '.tags')</label>
                                                    <input name="{{$locale}}[tag]" class="custom_tag form-control"
                                                        value="{{old($locale . '.tag')}}">
                                                    <small>@lang('site.optional')</small>
                                                </div>
                                                @endforeach


                                                {{-- styles --}}
                                                @foreach (config('translatable.locales') as $locale)
                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale . '.style')</label>
                                                    <input name="{{$locale}}[style]" class="custom_tag form-control"
                                                        value="{{old($locale . '.style')}}">
                                                    <small>اضغط على , لانشاء كلمة جديدة</small>
                                                </div>
                                                @endforeach


                                                {{-- pro_ins --}}
                                                @foreach (config('translatable.locales') as $locale)
                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale . '.Protection_instructions')</label>
                                                    <input name="{{$locale}}[pro_ins]" class="custom_tag form-control"
                                                        value="{{old($locale . '.pro_ins')}}">
                                                    <small>اضغط على , لانشاء كلمة جديدة</small>
                                                </div>
                                                @endforeach
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="{{route('dashboard.product.index')}}"
                                    class="btn btn-secondary float-{{app()->getLocale() == 'en' ? 'right' : 'left'}}">
                                    <i class="fa fa-deaf"></i> @lang('site.cancel')</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i>
                                    @lang('site.create_product')</button>

                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </form>
            </div>
            @endif

        </div>
    </div>

</div>
@endsection