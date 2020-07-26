<!-- Start header Section -->
<sectiom class="header">

    <!-- Start cart headerTop  -->
    <div class="headerTop">
        <div class="container">
            <div class="headerTop-inner">
                <div class="header-logo">
                    <a href="{{route('front.welcome')}}"><img src="{{asset('public/images/logo_new.png')}}"
                            alt="logo"></a>
                </div>
                <div class="language-switch">
                    @if (app()->getLocale() == 'ar')
                    <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">@lang('site.eng')</a>
                    @else
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">{{__('site.ara')}}</a>
                    @endif

                </div>

                @guest

                <div class="logIn">
                    <a href="#" onclick="login_model()"> <i class="fas fa-user"></i>@lang('site.login')</a>
                </div>
                @endguest


                @auth

                {{-- userlogin section --}}
                <div class="userlogIn mx-2">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle " type="button" id="userlogIn-drop" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="user-noti">

                            </span>

                            <span class="user-name">
                                {{auth()->user()->getFullName()}}
                            </span>
                            <span class="user-img">
                                <img src="{{auth()->user()->getPathImage()}}" alt="user icon">
                            </span>
                        </button>
                        <div class="dropdown-menu animated flipInY" aria-labelledby="userlogIn-drop ">

                            <a class="dropdown-item" href="{{route('front.userData')}}">@lang('site.my_account')</a>

                            <a class="dropdown-item" href="{{route('front.order.index')}}">@lang('site.app_log')</a>

                            <a class="dropdown-item" href="{{route('front.alert')}}">@lang('site.alert')</a>

                            @if (auth()->user()->hasRole('admin|super_admin'))
                            <a class="dropdown-item" href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                            @endif

                            <a class="dropdown-item log-out" href="{{route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                @lang('site.logout')</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>


                {{-- cart --}}
                <div class="cart">

                    {{-- cart products --}}
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="cart-drop" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>@lang('site.cart') <span
                                class="cart-noti">{{auth()->user()->products->count()}}</span>
                        </button>
                        <div class="dropdown-menu animated flipInX" aria-labelledby="cart-drop">
                            <div class="cart-pop">
                                <ul class="cart-pop-content">
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach (auth()->user()->products as $product)
                                    <li class="cart-pop-product">
                                        <div class="cart-pop-product-img">
                                            <img src="{{asset('public\images\upload\product\image\productImage\\' . $product->images->first()->image)}}"
                                                alt="cart image">
                                        </div>
                                        <div class="cart-pop-product-text">
                                            <h6>{{$product->name}}

                                            </h6>
                                            <span>{{$product->finalPrice()}}$</span>
                                        </div>
                                    </li>
                                    @php
                                    $total+= $product->finalPrice() * $product->pivot->quantity;
                                    @endphp
                                    @endforeach

                                </ul>
                                <div class="cart-pop-footer">
                                    <h5 class="total"> @lang('site.total') : {{$total}}$

                                    </h5>
                                    <a class="btn goToCart" href="{{route('front.cart.index')}}">
                                        @lang('site.go_cart')


                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endauth
            </div>
        </div>

    </div>
    <!-- End headerTop -->

    <!-- Start navBar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <form class="form-inline my-2 my-lg-0" @if (request()->route()->getName() != 'front.store.index')
                action="{{route('front.product.index')}}"
                @endif>
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>

                <input class="form-control mr-sm-2" type="text" placeholder="{{__('site.search')}}" aria-label="Search"
                    name="search" value="{{request()->search ?? ''}}">
                <span class="animation"></span>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav">
                    <li class=" nav-item {{request()->route()->getName() == 'front.welcome' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('front.welcome')}}">@lang('site.home')</a>
                    </li>
                    <li class="nav-item {{request()->route()->getName() == 'front.product.index' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('front.product.index')}}">@lang('site.products')</a>
                    </li>
                    <li
                        class="nav-item {{request()->route()->getName() == 'front.store.index' || request()->route()->getName() == 'front.store.show' ? 'active' : ''}}">
                        <a class=" nav-link" href="{{route('front.store.index')}}">@lang('site.stores')</a>
                    </li>
                    <li class="nav-item  {{request()->route()->getName() == 'front.merchant' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('front.merchant')}}">@lang('site.be_ta')

                        </a>
                    </li>

                    <li class="nav-item  {{request()->route()->getName() == 'front.contact' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('front.contact')}}">@lang('site.contact_us')</a>
                    </li>


                </ul>

            </div>

        </div>
    </nav>
    <!-- End navBar -->

    <!-- Start login and register models -->
    <!-- Button trigger modal -->


    <!-- logiin -->
    <div class="modal fade" id="login-model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content loginReg login">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('site.login')

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('login') }}">

                        @csrf
                        {{--  email --}}
                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                required value="{{old('password')}}" placeholder="{{__('site.email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" value="{{old('password')}}" required
                                class="form-control  @error('password') is-invalid @enderror"
                                placeholder="{{__('site.password')}}">
                            <button type="button" class="hide"><i class="far fa-eye"></i></button>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-buttons">
                            <button class="btn">@lang('site.login')

                            </button>
                            <a href="#" onclick="forget_model()">@lang('site.forget_pass')

                            </a>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <span> ليس لديك حساب ؟ </span>
                    <button type="button" class="btn" onclick="register_model()">@lang('site.create_account') <i
                            class="fas fa-long-arrow-alt-left"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- register -->
    <div class="modal fade" class="" id="register-model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content loginReg register">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('site.create_account')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="email" class="form-control" placeholder="{{__('site.email')}}">

                        </div>
                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control"
                                placeholder="{{__('site.password')}}">

                        </div>

                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="{{__('site.conf_pass')}}">
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"></label>
                            <span>أوافق على <a href="#">شروط الاستخدام</a> و <a href="">سياسية الخصوصية</a></span>
                        </div>
                        <div class="form-buttons">
                            <button class="btn">@lang('site.create_account')

                            </button>

                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <span> @lang('site.have_account')</span>
                    <button type="button" class="btn">@lang('site.login')<i
                            class="fas fa-long-arrow-alt-left"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- forget -->
    <div class="modal fade" class="" id="forget-model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content loginReg forget">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('site.back_password')
                    </h5>
                    <p>@lang('site.enter_pass')</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <span class="side">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="" class="form-control" placeholder="الايميل">

                        </div>


                        <div class="form-buttons">
                            <button class="btn">@lang('site.create_account')

                            </button>

                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
    <!-- End login and register models -->

</sectiom>