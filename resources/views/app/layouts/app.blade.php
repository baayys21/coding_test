<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Simple Search Form</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">

        @yield('css')

    </head>

    <body class="sidebar-mini" style="height: auto;" data-new-gr-c-s-check-loaded="14.1048.0" data-gr-ext-installed="">
        <div class="wrapper">

            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    {{-- <li class="nav-item d-none d-sm-inline-block">
                        <a href="../../index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> --}}
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="../../index3.html" class="brand-link"> <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Coding_test</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            @if (auth::user()->name)
                                <a href="#" class="d-block">{{ auth::user()->name }}</a>
                            @endif
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p> Kendaraan <i class="right fas fa-angle-left"></i> </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/kendaraan/manajemen/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Manajemen Kendaraan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/kendaraan/rent/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Status Kendaraan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p> Widgets </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper" style="min-height: 100 vh;">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 0.0.1
                </div>
                <strong>Copyright © 2023.
            </footer>
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">


        <div id="sidebar-overlay"></div></div>
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/select2/js/select2.full.min.js"></script>
        <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
        @yield('js')
    </body>
</html>
