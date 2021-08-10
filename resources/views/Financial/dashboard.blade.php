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
                <div class="card shadow" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">
                        <h4 class="m-0 font-weight-bold text-white">Estatísticas das vendas</h4></div>

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
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">
                        <h5 class="m-0 font-weight-bold text-white">Itens mais vendidos</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pb-2">
                            {!! $chart2->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                    <div class="card shadow">
                        <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">
                            <h4 class="m-0 font-weight-bold text-white">Itens vendidos</h4></div>

                        <div class="card-body financial-table">

                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th style="color: black;" scope="col">#id</th>
                                    <th style="color: black;" scope="col">Item</th>
                                    <th style="color: black;" scope="col">Quantidade vendida este mês</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($sale as $s)
                                    <tr>
                                        <th style="color: black; cursor: pointer;" title="{{ $s[1] }} Itens vendidos" scope="row">{{ $s[2] }}</th>
                                        <td style="color: black; cursor: pointer;" title="{{ $s[1] }} Itens vendidos">{{ $s[0] }}</td>
                                        <td style="color: black; cursor: pointer;" title="{{ $s[1] }} Itens vendidos">{{ $s[1] }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


   @if(isset($FinalSale))
       @if($FinalSale != '')
           <button class="lbl1" hidden value="{{ $FinalSale[0]['item'] }}"></button>
           <button class="lbl2" hidden value="{{ $FinalSale[1]['item'] }}"></button>
           <button class="lbl3" hidden value="{{ $FinalSale[2]['item'] }}"></button>
       @if(isset($FinalSale[3]['item']))
           <button class="lbl4" hidden value="{{ $FinalSale[3]['item'] }}"></button>
       @endif

           <button class="valor1" hidden value="{{ $FinalSale[0]['quantidade'] }}"></button>
           <button class="valor2" hidden value="{{ $FinalSale[1]['quantidade'] }}"></button>
           <button class="valor3" hidden value="{{ $FinalSale[2]['quantidade'] }}"></button>
       @if(isset($FinalSale[3]['item']))
           <button class="valor4" hidden value="{{ $FinalSale[3]['quantidade'] }}"></button>
       @endif
       @endif
@endif
@endsection
