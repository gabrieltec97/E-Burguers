<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bs4.pop.css') }}">
    <link href="{{asset('js/jquery-toast-plugin/src/jquery.toast.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>

    <script src="https://kit.fontawesome.com/e656fe6405.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @can('Dashboard')
        <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon rotate-n-75">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Atendimento</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Charts -->
                @can('Dashboard')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="font-weight-bold">Dashboard</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Pedidos (Híbrido)')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('hybridHome') }}">
                            <i class="fas fa-tv"></i>
                            <span class="font-weight-bold">Gerenciamento de pedidos</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Pedidos (Comum)')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-hamburger"></i>
                            <span class="font-weight-bold">Pedidos em andamento</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Em Preparo')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('emPreparo') }}">
                            <i class="fas fa-bread-slice"></i>
                            <span class="font-weight-bold">Para preparo</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Histórico de Pedidos')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('historicoPedidos') }}">
                            <i class="fas fa-history"></i>
                            <span class="font-weight-bold">Histórico de pedidos</span></a>
                    </li>
                @endcan

                {{--        <!-- Nav Item - Charts -->--}}
                {{--        <li class="nav-item">--}}
                {{--            <a class="nav-link" href="{{ route('clientes.index') }}">--}}
                {{--                <i class="fas fa-user"></i>--}}
                {{--                <span class="font-weight-bold">Clientes</span></a>--}}
                {{--        </li>--}}

            <!-- Nav Item - Charts -->
                @can('Cupons')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cupons.index') }}">
                            <i class="fas fa-ticket-alt"></i>
                            <span class="font-weight-bold">Cupons</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Gerenciamento de Usuários')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gerenciamento') }}">
                            <i class="fas fa-users-cog"></i>
                            <span class="font-weight-bold">Gerenciamento de usuários</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Gerenciamento de Refeições')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('refeicoes.index') }}">
                            <i class="fas fa-tasks"></i>
                            <span class="font-weight-bold">Gerenciamento de refeições</span></a>
                    </li>
                @endcan

            <!-- Nav Item - Charts -->
                @can('Informações Financeiras')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('financeiro') }}">
                            <i class="fas fa-chart-bar"></i>
                            <span class="font-weight-bold">Informações Financeiras</span></a>
                    </li>
                @endcan

            <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0 botao-recolher-menu" id="sidebarToggle"></button>
                </div>

                {{--        <!-- Sidebar Toggler (Sidebar) -->--}}
                {{--        <div class="text-center mb-5 d-none d-md-inline custom-control custom-switch">--}}
                {{--           <input type="checkbox" class="custom-control-input" id="customSwitch1">--}}
                {{--           <label class="custom-control-label" for="customSwitch1"</label>--}}
                {{--        </div>--}}





            </ul>
            <!-- End of Sidebar -->
        @endcan

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <?php
                    $total = 0;
                    $comment = \Illuminate\Support\Facades\DB::select("SELECT clientComments from orders WHERE status = 'Em preparo'");
                    $verifica = 0;
                    foreach ($comment as $c){
                        $teste= strlen($c->clientComments);

                        if ($teste == 0){
                            $verifica = 0;
                        }else{
                            $verifica += 1;
                        }
                    }
                    ?>

                    <li>
                        <i class="fas fa-bell dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 27px; color: black">
                            <span class="badge bg-primary text-white">
                               @if($verifica != 0)
                                    1
                                @else
                                   0
                               @endif
                            </span>
                        </i>

                        <div style="margin-right: 125px" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuLink">
                            @if($verifica != 0)
                                <p style="cursor: pointer; margin-bottom: -3px" class="dropdown-item">
                                    <b><span class="text-danger">Atenção! </span>Existem comentários dos clientes nos pedidos.</b>
                                </p>
                            @endif
                        </div>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">

                        <a class="nav-link dropdown-toggle" style="color: black" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            $agora =getdate();
                            $hora = $agora["hours"];
                            $usuario = \Illuminate\Support\Facades\Auth::user()->name;
                            ?>

                            @if($hora >= 5 && $hora < 12)
                                <span class="mr-2 d-none d-lg-inline small font-weight-bold" style="font-size: 15px; color: black">Bom dia, {{ $usuario }}</span>
                            @elseif($hora >= 12 && $hora < 18)
                                <span class="mr-2 d-none d-lg-inline small font-weight-bold" style="font-size: 15px; color: black"> Boa tarde, {{ $usuario }} &nbsp;</span>
                            @else
                                <span class="mr-2 d-none d-lg-inline small font-weight-bold" style="font-size: 15px; color: black">Boa noite, {{ $usuario }}</span>
                            @endif
                            <i class=" mb-2 fas fa-sort-down"></i>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('usuario.index') }}">
                                <i class="fas fa-list fa-sm fa-fw mr-2 font-weight-bold text-gray-400"></i>
                                <span class="font-weight-bold text-secondary">Meus dados</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt font-weight-bold mr-2 text-gray-400"></i>

                            <span class="font-weight-bold font-weight-bold text-secondary">Sair</span></a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up" style="margin-top: 13px"></i>
</a>

</body>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jqueryStyles.js')}}"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="{{asset('js/sidebar.js')}}"></script>
<script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>


</html>
