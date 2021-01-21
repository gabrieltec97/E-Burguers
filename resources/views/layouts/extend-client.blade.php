<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('js/jquery-toast-plugin/src/jquery.toast.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>
    <script src="https://kit.fontawesome.com/e656fe6405.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



</head>
<body>

<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<nav class="navbar navbar-expand-lg navbar-sup fixed-top bg-danger">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white hamburger-menu"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="{{ route('tipoPedido') }}" class="nav-item nav-link menu-items">Novo Pedido</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('preparo.index') }}" class="nav-item nav-link menu-items">Pedidos em andamento</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('meusPedidos') }}" class="nav-item nav-link menu-items">Histórico de pedidos</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pedidosPendentes') }}" class="nav-item nav-link menu-items">Pedidos pendentes</a>
            </li>
        </ul>

        <span class="navbar-text area-carrinho">
        <?php

            $user = \Illuminate\Support\Facades\Auth::user();
            $tray = $user->userOrderTray()->select('hamburguer', 'portion', 'drinks')->get()->toArray();
            $freeTray = $user->userOrderTray()->select('id','detached')->get()->toArray();

            if (isset($freeTray[0]['id'])){
                $extras = DB::table('auxiliar_detacheds')->select('Item')
                    ->where('idOrder', '=', $freeTray[0]['id'])
                    ->get()->toArray();

                //Formatando arrays
                $items = [];
                foreach ($extras as $key => $value){
                    array_push($items, $value->Item);
                }
            }

            $count = 0;

            if (isset($freeTray[0]) && isset($items)){
                $cart = explode(',', $freeTray[0]['detached']);
                $count = count($cart) + count($items);

            }elseif(isset($freeTray[0])){
                $cart = explode(',', $freeTray[0]['detached']);
                $count = count($cart);

            }elseif(isset($items)){
                $count = count($items);
            }


            if(isset($tray[0])){
                if($tray[0]['hamburguer'] != ''){
                    $count = 1;
                }

                if($tray[0]['drinks'] != ''){
                    $count += 1;
                }

                if($tray[0]['portion'] != ''){
                    $count += 1;
                }
            }

         ?>
                <a href="{{ route('minhaBandeja.index') }}"><i class="fas fa-shopping-cart carrinho text-white">
                <span class="badge badge-secondary"><span class="text-white valor-carrinho"><?= $count ?></span></span></i></a>
        </span>

        <div class="navbar-text nav-saudacao">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle alinhamento-menu" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $agora =getdate();
                    $hora = $agora["hours"];
                    $usuario = \Illuminate\Support\Facades\Auth::user()->name;
                    ?>

                    @if($hora >= 5 && $hora < 12)
                        <span class="font-weight-bold saudacao">Bom dia, {{ $usuario }}</span>
                    @elseif($hora >= 12 && $hora < 18)
                        <span class="font-weight-bold saudacao" style="font-size: 17px"> Boa tarde, {{ $usuario }} &nbsp;</span>
                    @else
                        <span class="font-weight-bold saudacao">Boa noite, {{ $usuario }}</span>
                    @endif
                </a>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('meusDados') }}"><span class="font-weight-bold text-secondary">Meus dados</span></a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <span class="font-weight-bold text-secondary">Sair</span></a>
                </div>
            </div>
        </div>
    </div>
    <span class="navbar-text area-carrinho-hide-big">
        <a href="{{ route('minhaBandeja.index') }}"><i class="fas fa-shopping-cart carrinho text-white">
        <span class="badge badge-secondary"><span class="text-white valor-carrinho"><?= $count ?></span></span></i></a>
    </span>
</nav>


@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jqueryStyles.js')}}"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>
</body>
</html>
