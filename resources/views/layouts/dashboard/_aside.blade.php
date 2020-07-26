<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('front.welcome')}}" class="brand-link text-center">
        {{-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light" style="font-family: cursive">engrio</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="    padding-left: .2rem;">
                <img src=" {{auth()->user()->getPathImage()}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="">{{auth()->user()->getFullName()}}</a>
                @foreach (auth()->user()->roles as $role)
                <span class="text-white badge badge-pill badge-success" style="font-size: 10px"> {{$role->name}}</span>
                @endforeach
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
                style="    padding: 3px 1px 2px 4px;">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                {{-- dashboard --}}
                <li class="nav-item">
                    <a href="{{route('dashboard.welcome')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.welcome' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('site.dashboard')
                        </p>
                    </a>

                </li>

                {{-- users --}}
                @if (auth()->user()->isAbleTo('*_users'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.user.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.user.index' || request()->route()->getName() == 'dashboard.user.create' || request()->route()->getName() == 'dashboard.user.edit' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('site.users')
                        </p>
                    </a>

                </li>
                @endif


                {{-- Categories --}}
                @if (auth()->user()->isAbleTo('*_categories'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.category.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.category.index' || request()->route()->getName() == 'dashboard.category.create' || request()->route()->getName() == 'dashboard.category.edit' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-list fa-fw"></i>
                        <p>
                            @lang('site.categories')
                        </p>
                    </a>

                </li>
                @endif


                {{-- products --}}
                @if (auth()->user()->isAbleTo('*_products'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.product.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.product.index' || request()->route()->getName() == 'dashboard.product.create' || request()->route()->getName() == 'dashboard.product.edit' ? 'active' : ''}}">
                        <i class="fab fa-product-hunt fa-fw"></i>
                        <p>
                            @lang('site.products')
                        </p>
                    </a>

                </li>
                @endif

                {{-- stores --}}
                @if (auth()->user()->isAbleTo('*_stores'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.store.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.store.index' || request()->route()->getName() == 'dashboard.store.create' || request()->route()->getName() == 'dashboard.store.edit' ? 'active' : ''}}">
                        <i class="fas fa-store fa-fw"></i>
                        <p>
                            @lang('site.stores')
                        </p>
                    </a>

                </li>
                @endif

                {{-- client --}}
                @if (auth()->user()->isAbleTo('*_users'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.client.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.client.index' || request()->route()->getName() == 'dashboard.client.create' || request()->route()->getName() == 'dashboard.client.edit' || request()->route()->getName() == 'dashboard.client.order.create'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            @lang('site.clients')
                        </p>
                    </a>

                </li>
                @endif

                {{-- orders --}}
                @if (auth()->user()->isAbleTo('*_orders'))
                <li class="nav-item mt-2">
                    <a href="{{route('dashboard.order.index')}}"
                        class="nav-link {{request()->route()->getName() == 'dashboard.order.index' || request()->route()->getName() == 'dashboard.order.create' || request()->route()->getName() == 'dashboard.order.edit'   ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            @lang('site.orders')
                        </p>
                    </a>
                </li>
                @endif

                {{-- logout --}}
                <li class="nav-item mt-2">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            @lang('site.logout')
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>