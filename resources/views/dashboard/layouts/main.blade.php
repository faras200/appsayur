<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assetsadmin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('images/logosayur.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dashboard Admin
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/assetsadmin/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
    <link href="/assetsadmin/demo/demo.css" rel="stylesheet" />
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-tur6AJLakWBQXGBJ"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  {{-- ck Editor --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script> --}}

</head>

<body class="">
    <div class="wrapper ">
        @include('dashboard.layouts.sidebar')
        <div class="main-panel">
            @include('dashboard.layouts.navbar')

            {{-- Content --}}
            <div class="content" style="padding: 0px 15px !important">
                <div class="container-fluid">
                    @yield('container')
                </div>
            </div>
            {{-- EndContent --}}

            <footer class="footer " style="padding: 0px 0px !important">
                <div class="container-fluid">

                    <div class="copyright float-center">
                        Copyright
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Built by
                        <a href="https://www.instagram.com/faras_aan/" target="_blank">Farras Aldi Alfikri</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="/assetsadmin/js/core/jquery.min.js"></script>
    <script src="/assetsadmin/js/core/popper.min.js"></script>
    <script src="/assetsadmin/js/core/bootstrap-material-design.min.js"></script>
    <script src="/assetsadmin/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="/assetsadmin/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->

    <!-- Forms Validations Plugin -->
    <script src="/assetsadmin/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="/assetsadmin/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="/assetsadmin/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="/assetsadmin/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="/assetsadmin/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="/assetsadmin/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="/assetsadmin/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="/assetsadmin/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="/assetsadmin/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="/assetsadmin/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="/assetsadmin/js/plugins/arrive.min.js"></script>
    <!-- Chartist JS -->
    <script src="/assetsadmin/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/assetsadmin/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assetsadmin/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="/assetsadmin/demo/demo.js"></script>
    <script>
        function confirmationHapusData(url) {
            Swal.fire({
                title: 'Anda Yakin Untuk Menghapus Data Ini ?',
                text: 'Anda Tidak Dapat Melihat Data Ini Lagi!!!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Hapus Saja!!',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
</body>

</html>
