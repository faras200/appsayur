<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100"
    id="sectionsNav">
    <div class="container-fluid ml-4 mr-4">
        <div class="navbar-translate">
            <a href="/">
                <img src="{{ asset('images/logosayur.png') }}" width="80" height="40"
                    class="d-inline-block align-center" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class=" nav-item ">
                    <a class="navbar-brand" href="/">
                        SAYUR GO</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class=" nav-item">
                    <a href="/" class=" nav-link">
                        <i class="material-icons">house</i> Home
                    </a>

                </li>
                <li class=" nav-item">
                    <a href="/posts" class=" nav-link">
                        <i class="material-icons">apps</i> All Produk
                    </a>

                </li>
                <li class=" nav-item">
                    <a href="/posts?category=sayuran" class=" nav-link">
                        <i class="material-icons">newspaper</i> Sayuran
                    </a>

                </li>
                <li class=" nav-item">
                    <a href="/posts?category=buah-buahan" class=" nav-link">
                        <i class="material-icons">view_day</i> Buah-buahan
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="/lapak" class=" nav-link">
                        <i class="material-icons">storefront</i> Lapak
                    </a>
                </li>
                {{-- <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="material-icons">view_carousel</i> Examples
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="examples/about-us.html" class="dropdown-item">
                            <i class="material-icons">account_balance</i> About Us
                        </a>
                    </div>
                </li> --}}

                @if (Auth::guard('admin')->user() || Auth::guard('user')->user())
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="material-icons">view_carousel</i> Dashboard
                        </a>
                    </li>
                @else
                    <li class="button-container nav-item iframe-extern">
                        <a style="font-weight: 600 !important; padding: 12px 25px !important;"
                            href="/login"class="btn  btn-info  btn-round btn-block">
                            <i class="material-icons">login </i> Login
                        </a>
                    </li>
                @endif




            </ul>
        </div>
    </div>
</nav>
