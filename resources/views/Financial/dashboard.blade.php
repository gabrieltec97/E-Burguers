@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Dados financeiros
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-danger shadow h-100 py-2 card-dash1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pedidos hoje</div>
                                @if($countDayNow == 1)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countDayNow }} pedido</div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countDayNow }} pedidos</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="far fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            if ($totalValueToday > 0){
                $pieces = explode('.', $totalValueToday);

                $pieces = strlen($pieces[0]);
            }else{
                $pieces = 0;
            }

            $count2 = strlen($totalValueToday);

            if ($count2 == 4 && $totalValueToday > 10){
                $price = $totalValueToday . '0';
            }elseif ($count2 == 2){
                $price = $totalValueToday. '.' . '00';
            }elseif($count2 == 5 && $pieces == 3){
                $price = $totalValueToday. '0';
            }elseif($count2 == 3){
                $price = $totalValueToday . '0';
            }elseif($pieces > 3){
                $price = $totalValueToday . '0';
            }
            else{
                $price = $totalValueToday;
            }
            ?>

            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-success shadow h-100 py-2 card-dash2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total arrecadado hoje</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ $price }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-info shadow h-100 py-2 card-dash3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pedidos este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countMonth }} pedidos</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            if ($totalValue > 0){
                $vals = explode('.', $totalValue);

                $pieces = strlen($vals[0]);
                $piecesAfter = strlen($vals[1]);
            }else{
                $pieces = 0;
            }

            $count2 = strlen($totalValue);

            if ($count2 == 4 && $totalValue > 10){
                $totalPrice = $totalValue . '0';
            }elseif ($count2 == 2){
                $totalPrice = $totalValue. '.' . '00';
            }elseif($count2 == 5 && $pieces == 3){
                $totalPrice = $totalValue. '0';
            }elseif($count2 == 3){
                $totalPrice = $totalValue . '0';
            }elseif($pieces == 5  && $count2 >= 6 && $piecesAfter < 2){
                $totalPrice = $totalValue . '0';
            }elseif($pieces == 4  && $count2 >= 6 && $piecesAfter < 2){
                $totalPrice = $totalValue . '0';
            }
            elseif($pieces > 3 && $count2 >= 6){
                $totalPrice = $totalValue;
            }
            else{
                $totalPrice = $totalValue;
            }
            ?>

            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-primary shadow h-100 py-2 card-dash4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total arrecadado este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ $totalPrice }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 my-4">
                <div class="card shadow" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1eb9da;">
                        <h4 class="m-0 font-weight-bold text-white">Estatísticas das vendas</h4></div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart->container() !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 mt-lg-4 mt-2">
                <div class="card shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #1eb9da;">
                        <h5 class="m-0 font-weight-bold text-white">Itens mais vendidos</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pb-2">
                            @if(isset($chart2))
                                {!! $chart2->container() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5 mt-lg-3">
                    <div class="card shadow">
                        <div class="card-header font-weight-bold text-muted items" style="font-size: 25px; background: #1eb9da;">
                            <h4 class="m-0 font-weight-bold text-white">Itens vendidos</h4></div>

                        <div class="card-body financial-table">

                            @livewire('dashboard')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
