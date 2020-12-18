@extends('layouts.extend')

@section('title')
    Dados financeiros
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-5 col-12">
                                Vendas este mês
                            </div>

                            <div class="col-lg-7 col-12 d-flex mt-2 mt-lg-0 justify-content-end mb-2">

                                <select name="month" id="" class="form-control w-50">
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Janeiro">Fevereiro</option>
                                    <option value="Janeiro">Março</option>
                                    <option value="Janeiro">Abril</option>
                                    <option value="Janeiro">Maio</option>
                                    <option value="Janeiro">Junho</option>
                                    <option value="Janeiro">Julho</option>
                                    <option value="Janeiro">Agosto</option>
                                    <option value="Janeiro">Setembro</option>
                                    <option value="Janeiro">Outubro</option>
                                    <option value="Janeiro">Novembro</option>
                                    <option value="Janeiro">Dezembro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart->container() !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Vendas este ano</div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart2->container() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
