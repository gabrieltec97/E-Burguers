<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('logo/icon.png') }}">
    <?php
    //Verificando se o delivery está aberto.
    $deliveryStatus = DB::table('delivery_status')->select('status')->where('id', '=', 1)->get()->toArray();
    ?>

    @if($deliveryStatus[0]->status == 'Aberto')
        <meta name="theme-color" content="#00e676">
    @else
        <meta name="theme-color" content="#e3342f">
    @endif

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
                <span class="font-weight-bold teste-span" style="color: white; font-size: 11px">Dashboard</span></a>
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

        @can('Entregas')
            <li class="nav-item" title="Painel com informações resumidas sobre as vendas">
                <a class="nav-link" href="{{ route('entregas') }}">
                    <img src="{{ asset('logo/scooter.png') }}" style="width: 27px; height: 27px; margin-right: 2px; margin-bottom: 1px;cursor: pointer; margin-top: 1px" alt="Pedido entregue">
                    <span class="font-weight-bold teste-span" style="color: white; font-size: 11px">Entregas</span></a>
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
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    $thisMonth = strftime('%B');
                    $thisYear = strftime('%Y');
                    $thisDay = strftime('%d');

                    $cancelled = \Illuminate\Support\Facades\DB::table('orders')
                            ->where('status', '=', 'Cancelado')
                            ->where('monthDay', '=', $thisDay)
                            ->where('month', '=', $thisMonth)
                            ->where('year', '=', $thisYear)
                            ->get()->toArray();

                    $countCancelled = count($cancelled);

                    $sold = \Illuminate\Support\Facades\DB::table('orders')
                        ->where('status', '=', 'Pedido Entregue')
                        ->where('monthDay', '=', $thisDay)
                        ->where('month', '=', $thisMonth)
                        ->where('year', '=', $thisYear)
                        ->get()->toArray();

                    $countSold = count($sold);
                    ?>

                        @can('Info')
                            <li>
                                <i class="fas fa-info-circle text-primary" data-toggle="modal" data-target="#exampleModalLong" style="margin-top: 25px; color: black; cursor: pointer; font-size: 25px">
                                    <span class="badge bg-danger text-white" style="font-size: 11px">{{ $countCancelled }}</span>
                                </i>
                            </li>
                        @endcan

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

                            <a class="dropdown-item mt-2" href="cardapio/1">
                                <img src="{{ asset('logo/pedir.png') }}" title="Enviar ao cliente" style="width: 18px; height: 18px; cursor: pointer; margin-top: 1px" alt="Enviar ao cliente">
                                <span class="font-weight-bold ml-1">Fazer Pedido</span>
                            </a>

                            <a class="dropdown-item mt-2">
                                <button onclick="initFirebaseMessagingRegistration()" class="font-weight-bold" style="border: none; background: none; margin-left: -5px"><i class="fas fa-bell mr-2"></i>Notificações</button>
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

<form action="{{ route('save-token') }}" id="formNotif" method="POST" hidden>
    @csrf
    <input class="tokenbutton" name="tokenButton">
</form>

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>

    var firebaseConfig = {
        apiKey: "AIzaSyCC8EuiKS7xvy1qRGSrXI2cw20cfpSjsVY",
        authDomain: "push-notification-3fb99.firebaseapp.com",
        projectId: "push-notification-3fb99",
        storageBucket: "push-notification-3fb99.appspot.com",
        messagingSenderId: "122552755097",
        appId: "1:122552755097:web:3b66bc5762a5326a1b6908",
        measurementId: "G-T52QCGV357"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                // console.log(token);
                $(".tokenbutton").val(token);
                $("#formNotif").submit();

            }).catch(function (err) {
            console.log('User Chat Token Error'+ err);
        });
    }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Pedidos de hoje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cancelados">
                    <h4 class="text-center mb-3" style="color: black">Cancelamentos hoje:

                    @if($countCancelled == 0)
                        <span class="text-success">{{ $countCancelled }}</span>
                    @else
                        <span class="text-danger">{{ $countCancelled }}</span>
                    @endif
                    </h4>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">#Id</th>
                            <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Itens</th>
                            <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Cliente</th>
                            <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($cancelled as $val)

                                <?php
                                $count = strlen($val->totalValue);

                                if ($count == 4 && $val->totalValue > 10 or $count == 3){
                                    $price = $val->totalValue . '0';
                                }elseif ($count == 2){
                                    $price = $val->totalValue. '.' . '00';
                                }
                                else{
                                    $price = $val->totalValue;
                                }
                                ?>


                            <tr>
                                <td style="color: black">{{ $val->id }}</td>
                                <td style="color: black">{{ $val->detached }}</td>
                                <td style="color: black">{{ $val->clientName }}</td>
                                <td style="color: black">{{ $price }}</td>
                            </tr>
                            @endforeach

                            @if($countCancelled == 0)
                                <tr>

                                    <td align="center" colspan="6">
                                        <img src="{{ asset('logo/celebrating.png') }}" style="height: 70px; width: 80px" alt="">
                                        <br>
                                        <br>
                                        <p style="margin-bottom: -5px">Nenhum pedido cancelado hoje.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="vendidos">
                    <h4 class="text-center mb-3" style="color: black">Vendas de hoje:

                        @if($countSold == 0)
                            <span class="text-danger">{{ $countSold }}</span>
                        @else
                            <span class="text-success">{{ $countSold }}</span>
                        @endif

                    </h4>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="color: black">#Id</th>
                            <th scope="col" style="color: black">Itens</th>
                            <th scope="col" style="color: black">Cliente</th>
                            <th scope="col" style="color: black">Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sold as $val)

                            <?php
                            $count = strlen($val->totalValue);

                            if ($count == 4 && $val->totalValue > 10 or $count == 3){
                                $price = $val->totalValue . '0';
                            }elseif ($count == 2){
                                $price = $val->totalValue. '.' . '00';
                            }
                            else{
                                $price = $val->totalValue;
                            }
                            ?>


                            <tr>
                                <td style="color: black">{{ $val->id }}</td>
                                <td style="color: black">{{ $val->detached }}</td>
                                <td style="color: black">{{ $val->clientName }}</td>
                                <td style="color: black">{{ $price }}</td>
                            </tr>
                        @endforeach

                        @if($countSold == 0)
                            <tr>
                                <td align="center" colspan="6">Nenhuma venda realizada ainda.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-danger mr-2 pedidos-cancelados" onclick="cancelledToday()">Ver pedidos cancelados</button>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-success mt-2 vendas-concluidas" onclick="soldToday()">Ver vendas concluídas</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function soldToday(){
        $(".vendas-concluidas").on('click', function (){
            $(".cancelados").hide('slow');
            $(".vendas-concluidas").hide('slow');
            $(".pedidos-cancelados").show('slow');
            $(".vendidos").show('slow');
        })
    }

    function cancelledToday(){

        $(".pedidos-cancelados").on('click', function (){
            $(".vendidos").hide('slow');
            $(".pedidos-cancelados").hide('slow');
            $(".cancelados").show('slow');
            $(".vendas-concluidas").show('slow');
        })
    }
</script>
</html>
