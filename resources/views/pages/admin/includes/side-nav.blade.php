<div class="sidebar">
    <div class="user-panel mt-3   d-flex">
        <a href="javascript:;" class="brand-link">
            <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}"
                    class="nav-link {{ request()->is('admin/home') || request()->is('admin/home/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-dashboard"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-header"
                style="font-size: .7rem;
            padding: 0.5rem 0.75rem;background-color: inherit;
    color: #d0d4db;box-sizing: border-box;display: list-item;
    text-align: -webkit-match-parent;">
                Management</li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}"
                    class="nav-link {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-box"></i>
                    <p>{{ __('Categories') }}</p>
                </a>
            </li>
        <li class="nav-item">
            <a href="{{ route('admin.product.index') }}"
                class="nav-link {{ request()->is('admin/product') || request()->is('admin/product/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>{{ __('Products') }}</p>
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Logout') }}</p>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
