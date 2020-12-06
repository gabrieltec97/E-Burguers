@extends('layouts.extend')

@section('title')
    Dados financeiros
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Vendas hoje</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">22 pedidos</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total arrecadado hoje</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R$213,90</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Vendas este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">235 vendas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total arrecadado este mês</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R$ 1896,45</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>



{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12 col-sm-12 mb-5">--}}
{{--                <div class="card" style="height: 560px">--}}
{{--                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Vendas este mês</div>--}}

{{--                    <div class="card-body financial-table">--}}

{{--                        <div id="app">--}}
{{--                            {!! $chart->container() !!}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-12 col-sm-12 mb-5">--}}
{{--                <div class="card" style="height: 560px">--}}
{{--                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Vendas este ano</div>--}}

{{--                    <div class="card-body financial-table">--}}

{{--                        <div id="app">--}}
{{--                            {!! $chart2->container() !!}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
