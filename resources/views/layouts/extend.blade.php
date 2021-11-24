<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
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
    @livewireStyles
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

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
        <li class="nav-item" title="Painel com informações resumidas sobre as vendas">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <img src="{{ asset('logo/teste.png') }}" style="width: 27px; height: 27px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedido entregue">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Dashboard</span></a>
        </li>
        @endcan

        <!-- Nav Item - Charts -->
        @can('Pedidos (Híbrido)')
        <li class="nav-item" title="Gerencie completamente os de pedidos">
            <a class="nav-link" href="{{ route('hybridHome') }}">
                <img src="{{ asset('logo/order.png') }}" style="width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedido entregue">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Gerenciamento de pedidos</span></a>
        </li>
        @endcan

        <!-- Nav Item - Charts -->
        @can('Histórico de Pedidos')
        <li class="nav-item" title="Veja detalhadamente cada pedido cadastrado">
            <a class="nav-link" href="{{ route('historicoPedidos') }}">
                <img src="{{ asset('logo/time.png') }}" style="width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Histórico de pedidos</span></a>
        </li>
        @endcan

        @can('Cupons')
        <li class="nav-item" title="Gerencie os cupons para atrair a clientela">
            <a class="nav-link" href="{{ route('cupons.index') }}">
                <img src="{{ asset('logo/4032869.png') }}" style="background: white; border-radius: 20px; width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Cupons</span></a>
        </li>
        @endcan

        <!-- Nav Item - Charts -->
        @can('Gerenciamento de Usuários')
        <li class="nav-item" title="Gerencie os funcionários que tem acesso ao sistema">
            <a class="nav-link" href="{{ route('gerenciamento') }}">
                <img src="{{ asset('logo/time-management.png') }}" style="width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Gerenciamento de usuários</span></a>
        </li>
        @endcan

        <!-- Nav Item - Charts -->
        @can('Gerenciamento de Refeições')
        <li class="nav-item" title="Gerencie os itens do cardápio e seus adicionais">
            <a class="nav-link" href="{{ route('refeicoes.index') }}">
                <img src="{{ asset('logo/food.png') }}" style="width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Gerenciamento de refeições</span></a>
        </li>
        @endcan

    <!-- Nav Item - Charts -->
        @can('Avaliações')
            <li class="nav-item" title="Avaliações dos clientes para o estabelecimento e itens do cardápio.">
                <a class="nav-link" href="{{ route('avaliacoesClientes') }}">
                    <img src="{{ asset('logo/heart-rate.png') }}" style="width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                    <span class="font-weight-bold" style="color: white; font-size: 11px">Avaliações</span></a>
            </li>
        @endcan

        <!-- Nav Item - Charts -->
        @can('Informações Financeiras')
        <li class="nav-item" title="Veja detalhadamente as informações financeiras e vendas">
            <a class="nav-link" href="{{ route('financeiro') }}">
                <img src="{{ asset('logo/money-bag.png') }}" style="background: white; border-radius: 20px;width: 29px; height: 29px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedidos para preparo">
                <span class="font-weight-bold" style="color: white; font-size: 11px">Informações Financeiras</span></a>
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
                    $registrado = \Illuminate\Support\Facades\DB::select("SELECT COUNT(*) as retorno from orders WHERE status = 'Pedido registrado'");
                    $registrado = $registrado[0]->retorno;

                    $pronto = \Illuminate\Support\Facades\DB::select("SELECT COUNT(*) as pronto from orders WHERE status = 'Pronto'");
                    $pronto = $pronto[0]->pronto;

                    if ($registrado != 0){
                        $total = 10;
                    }

                    if($pronto != 0){
                        $total = 20;
                    }

                    if($pronto != 0 && $registrado != 0){
                        $total = 30;
                    }

                    if($pronto == 0 && $registrado == 0){
                        $total = 0;
                    }


                    ?>

                    <li>
                        <i class="fas fa-bell dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 27px; color: black">
                            <span class="badge bg-primary text-white">
                               @if($total == 10 or $total == 20)
                                   1
                               @elseif($total == 30)
                                2
                                @elseif($total == 0)
                                   0
                               @endif
                            </span>
                        </i>

                        <div style="margin-right: 125px" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuLink">
                            @if($total == 30 or $total == 10)
                            <p style="cursor: pointer;
                            @if($total == 30)
                                margin-top: 10px;
                            @else
                                margin:auto;
                            @endif
                                " class="dropdown-item">
                               <b>Existem pedidos registrados aguardando serem <span class="text-danger">preparados</span>.</b>
                            </p>
                            @endif
                                @if($total == 30)
                                    <hr>
                                @endif
                            @if($total == 30 or $total == 20)
                            <p style="cursor: pointer;
                            @if($total == 30)
                                margin-top: 10px;
                            @else
                                margin:auto;
                            @endif    " class="dropdown-item">
                              <b>Existem pedidos prontos aguardando serem <span class="text-info">enviados</span>.</b>
                            </p>
                            @endif

                            @if($total == 0)
                                    <p style="cursor: pointer; margin:auto;" class="dropdown-item"><b><span class="text-success">Ok</span>, nenhum pedido para preparo ou envio.</b></p>
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

                            @can('Áreas de entrega')
                            <a class="dropdown-item mt-2" href="{{ route('locaisDeEntrega.index') }}">
                                <i class="fas fa-shipping-fast mr-2"></i>
                                <span class="font-weight-bold">Locais de entrega</span>
                            </a>
                            @endcan

                            <?php
                                $delivery = \Illuminate\Support\Facades\DB::table('delivery_status')
                                    ->select('status')
                                    ->get()->toArray();

                                if (isset($delivery[0])){
                                    $delivery = $delivery[0]->status;
                                }else{
                                    \Illuminate\Support\Facades\DB::table('delivery_status')
                                    ->insert(['status' => 'Fechado', 'id' => 1]);
                                    $delivery = 'Fechado';
                                }
                            ?>

                            @can('Delivery')
                                <a class="dropdown-item mt-2" href="{{ route('delivery') }}">
                                    <i class="fas fa-mobile-alt mr-2"></i>
                                    <span class="font-weight-bold">{{ $delivery == 'Fechado' ? 'Abrir' : 'Fechar' }} Delivery</span>
                                </a>
                            @endcan

                            @can('Entregadores')
                            <a class="dropdown-item mt-2" href="{{ route('entregadores.index') }}">
                                <img src="{{ asset('logo/delivery-man.png') }}" title="Enviar ao cliente" style="width: 18px; height: 18px; cursor: pointer; margin-top: 1px" alt="Enviar ao cliente">
                                <span class="font-weight-bold ml-1">Entregadores</span>
                            </a>
                            @endcan
                            <a class="dropdown-item mt-2" href="cardapio/1">
                                <img src="{{ asset('logo/pedir.png') }}" title="Enviar ao cliente" style="width: 18px; height: 18px; cursor: pointer; margin-top: 1px" alt="Enviar ao cliente">
                                <span class="font-weight-bold ml-1">Fazer Pedido</span>
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt font-weight-bold mr-2"></i>

                            <span class="font-weight-bold font-weight-bold">Sair</span></a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->


        @yield('content')
            <!-- Begin Page Content -->

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
@livewireScripts
</body>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bs4.pop.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jqueryStyles.js')}}"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="{{asset('js/sidebar.js')}}"></script>
<script src="{{asset('js/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
<script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>

@if(isset($chart))
    <script src="https://unpkg.com/vue"></script>
    <script>
        var app = new Vue({
            el: '#app',
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}

    @if(isset($chart2))
        {!! $chart2->script() !!}
    @endif
@endif

</html>
