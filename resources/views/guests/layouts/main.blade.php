<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logosayur.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Sayur Go
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link href="{{ asset('assets/css/material-kit.min.css?v=2.2.1') }}" rel="stylesheet" />

</head>

<body class="blog-posts sidebar-collapse">

    @include('guests.layouts.navbar')
    @if (!Request::is('login'))
        @if (Request::is('posts*'))
            <div class="page-header header-filter header-small" data-parallax="true"
                style="background-image: url('{{ is_null($post['image']) ? $image : $post['image'] }}'); ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">
                                {{ is_null($post['title']) ? 'Sayur Go: Belanja Sayur Online Mudah, Cepat dan Sehatkan Hidupmu!' : $post['title'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="page-header header-filter header-small" data-parallax="true"
                style="background-image: url('{{ asset('images/bg_home.jpg') }}'); ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">Sayur Go: Belanja Sayur Online Mudah, Cepat dan Sehatkan Hidupmu!</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <div class="main ">
        @yield('container')
    </div>
    @include('guests.layouts.footer')

    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/jquery.sharrre.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/jquery.flexisel.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/material-kit.min.js?v=2.2.1') }}" type="text/javascript"></script>
</body>

</html>
