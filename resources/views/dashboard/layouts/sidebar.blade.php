<div class="sidebar" data-color="green" data-background-color="black" data-image="/assetsadmin/img/sidebar-3.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="sidebar-wrapper" style="height: 700px !important">
        <div class="user">
            <div class="photo">
                <img src="/assetsadmin/img/faces/admin.jpg" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>
                        {{ auth()->user()->role == 'pembeli' ? 'User' : 'Admin' }} {{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                @can('role', ['pembeli', 'pedagang'])
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/profile">
                                    <i class="material-icons">person</i>
                                    <span class="sidebar-normal"> My Profile </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endcan
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="/home">
                    <i class="material-icons">home</i>
                    <p> Home </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            @can('role', ['administrator'])
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                        <i class="material-icons">group</i>
                        <p> Administrator
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="pagesExamples">
                        <ul class="nav">
                            <li class="nav-item {{ Request::is('dashboard/admin') ? 'active' : '' }}">
                                <a class="nav-link" href="/dashboard/admin">
                                    <i class="material-icons">person</i>
                                    <p> Admin </p>
                                </a>
                            </li>
                            <li class="nav-item  {{ Request::is('dashboard/admin-lapak') ? 'active' : '' }} ">
                                <a class="nav-link" href="/dashboard/admin-lapak">
                                    <i class="material-icons">supervised_user_circle</i>
                                    <p> Admin Lapak</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('dashboard/lapak*') ? 'active' : '' }} ">
                    <a class="nav-link" href="/dashboard/lapak">
                        <i class="material-icons">
                            storefront
                        </i>
                        <p> Lapak </p>
                    </a>
                </li>
            @endcan
            @can('role', ['pembeli', 'pedagang'])
                <li class="nav-item {{ Request::is('dashboard/transaksi') ? 'active' : '' }} ">
                    <a class="nav-link" href="/dashboard/transaksi">
                        <i class="material-icons">payments</i>
                        <p> Transaksi </p>
                    </a>
                </li>
            @endcan
            {{-- <li class="nav-item {{ Request::is('dashboard/pengajuan*') ? 'active' : '' }} ">
                <a class="nav-link" href="/dashboard/pengajuan">
                    <i class="material-icons">post_add</i>
                    <p> Pengajuan </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/ambil-dana*') ? 'active' : '' }} ">
                <a class="nav-link" href="/dashboard/ambil-dana">
                    <i class="material-icons">request_quote</i>
                    <p>Pengambilan Dana </p>
                </a>
            </li> --}}
            @canany('role', ['administrator', 'pedagang'])
                <li class="nav-item {{ Request::is('dashboard/laporan*') ? 'active' : '' }} ">
                    <a class="nav-link" href="/dashboard/laporan">
                        <i class="material-icons">description</i>
                        <p>Laporan Transaksi </p>
                    </a>
                </li>
            @endcanany
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#konten">
                    <i class="material-icons">dashboard_customize</i>
                    <p> Kelola Konten
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="konten">
                    <ul class="nav">
                        @canany('role', ['pedagang'])
                            <li class="nav-item {{ Request::is('dashboard/posts*') ? 'active' : '' }} ">
                                <a class="nav-link" href="/dashboard/posts">
                                    <i class="material-icons">assignment</i>
                                    <p> My Posts </p>
                                </a>
                            </li>
                        @endcanany
                        @canany('role', ['administrator'])
                            <li class="nav-item {{ Request::is('dashboard/categories*') ? 'active' : '' }} ">
                                <a class="nav-link" href="/dashboard/categories">
                                    <i class="material-icons">book</i>
                                    <p> Categories </p>
                                </a>
                            </li>
                        @endcanany
                        <li class="nav-item {{ Request::is('dashboard/media*') ? 'active' : '' }} ">
                            <a class="nav-link" href="/dashboard/media">
                                <i class="material-icons">folder</i>
                                <p> Media </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
