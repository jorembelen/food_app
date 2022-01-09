<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">02</span>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(1) == 'products') ? 'mm-active' : '' }}">
                    <a href="{{ route('products.index') }}" class="waves-effect {{ (request()->segment(1) == 'products') ? 'active' : '' }}">
                        <i class="bx bx-store"></i>
                        <span key="t-chat">Products</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(1) == 'admin-orders') ? 'mm-active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="waves-effect {{ (request()->segment(1) == 'admin-orders') ? 'active' : '' }}">
                        <i class="fas fa-cart-plus"></i>
                        <span key="t-chat">Orders</span>
                    </a>
                </li>
                {{-- <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Products</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="{{ route('products.index') }}" key="t-add-product">List</a></li>
                        <li><a href="{{ route('products.create') }}" key="t-add-product">Add Product</a></li>
                    </ul>
                </li> --}}





            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
