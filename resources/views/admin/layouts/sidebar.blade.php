        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{route('admin_dashboard')}}">Admin Panel</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{route('admin_dashboard')}}"></a>
                </div>

                <ul class="sidebar-menu">

                    <li class="{{ Request::is('admin/dashboard')  ? 'active': '' }}"><a class="nav-link" href="{{route('admin_dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                  

                    <li class="nav-item dropdown {{ Request::is('admin/product-category*')}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Manage Product</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('admin/product-category*') ? 'active': '' }}"><a class="nav-link" href="{{route('admin_product_category_index')}}"><i class="far fa-folder"></i> Categories</a></li>
                            <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Product</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('admin/user/*')  ? 'active': '' }}"><a class="nav-link" href="{{route('admin_user_index')}}"><i class="fas fa-file"></i> <span>Manage User</span></a></li>
                    

                </ul>
            </aside>
        </div>