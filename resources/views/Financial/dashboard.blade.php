@extends('layouts.extend')

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
                                    Vendas hoje</div>
                                @if($countDayNow == 1)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countDayNow }} venda</div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countDayNow }} vendas</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="far fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-success shadow h-100 py-2 card-dash2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total arrecadado hoje</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R${{$totalValueToday}}</div>
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
                                    Vendas este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countMonth }} vendas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mt-lg-0 col-lg-3">
                <div class="card border-left-primary shadow h-100 py-2 card-dash4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total arrecadado este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R${{ $totalValue }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 my-5">
                <div class="card" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;"> <h4 class="m-0 font-weight-bold text-primary">Estatísticas das vendas</h4></div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart->container() !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 my-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Itens de combo mais vendidos</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            @if($detached != '')
                                <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i>{{ $detached[0]['item'] }}
                                        </span>
                                <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i>{{ $detached[1]['item'] }}
                                        </span>
                                <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i>{{ $detached[2]['item'] }}
                                        </span>
                                <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i>{{ $detached[3]['item'] }}
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


    @if($detached != '')
        <button class="lbl1" hidden value="{{ $detached[0]['item'] }}"></button>
        <button class="lbl2" hidden value="{{ $detached[1]['item'] }}"></button>
        <button class="lbl3" hidden value="{{ $detached[2]['item'] }}"></button>
        <button class="lbl4" hidden value="{{ $detached[3]['item'] }}"></button>

        <button class="valor1" hidden value="{{ $detached[0]['quantidade'] }}"></button>
        <button class="valor2" hidden value="{{ $detached[1]['quantidade'] }}"></button>
        <button class="valor3" hidden value="{{ $detached[2]['quantidade'] }}"></button>
        <button class="valor4" hidden value="{{ $detached[3]['quantidade'] }}"></button>
@endif
@endsection
