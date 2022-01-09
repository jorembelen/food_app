     <!-- Header -->
     <header class="main-header sticky">
        <a href="#menu" class="btn-mobile">
            <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6 ml-6">
                    <div id="logos">
                        <h3><a href="/" title="FoodBoard">Joreb Store</a></h3>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <ul id="menuIcons" class="phoneContent">
                        <li><a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a></li>
                    </ul>
                    <!-- Menu -->
                    <nav id="menu" class="main-menu">
                        <ul>
                            @guest
                                <li><span><a href="{{ route('login') }}">Login</a></span></li>
                            @endguest
                            @auth
                            <li><span><a href="/">Home</a></span></li>
                            <li><span><a href="{{ route('orders') }}">My Orders</a></span></li>
                            <li><span>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->f_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   @if (auth()->user()->isAdmin())
                                    <a class="dropdown-item text-center" href="{{ route('admin.dashboard') }}">
                                        Admin Dashboard
                                    </a>
                                   @endif
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="align-middle fa fa-power-off fa-4x"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </span>
                            </li>
                            @endauth
                        </ul>
                    </nav>
                    <!-- Menu End -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->


