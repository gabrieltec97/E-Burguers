@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
@section('title')
    Avaliações dos clientes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            <div class="card border-left-success shadow h-100 py-2 card-dash2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center" title="A nota máxima para a avaliação é 5. No momento a média de nova está em {{ $data['grade'] }}">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nota total</div>
                            <div class="h5 mt-2 mb-0 font-weight-bold text-gray-800">{{ $data['grade'] }}

                                @if($data['grade'] >= 4)
                                    <i class="fas fa-circle text-success ml-1"></i>
                                @elseif($data['grade'] >= 3 && $data['grade'] < 4)
                                    <i class="fas fa-circle text-warning ml-1"></i>
                                @elseif($data['grade'] < 3)
                                    <i class="fas fa-circle text-danger ml-1"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-question-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            <div class="card border-left-info shadow h-100 py-2 card-dash3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center" title="Este é o total de pessoas que avaliaram o estabelecimento">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de avaliações</div>
                            <div class="h5 mt-2 mb-0 font-weight-bold text-gray-800">{{ $data['count'] }} votantes</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            @if($data['grade'] >= 4)
            <div class="card border-left-success shadow h-100 py-2 card-dash3" title="Parabéns, os clientes em sua maioria estão gostando do atendimento">
            @elseif($data['grade'] >= 3 && $data['grade'] < 4)
            <div class="card border-left-warning shadow h-100 py-2 card-dash3" title="Opa, parece que os clientes podem não estar gostando muito do atendimento ou pedidos. Dê uma olhada na lista de opiniões">
            @elseif($data['grade'] < 3)
            <div class="card border-left-danger shadow h-100 py-2 card-dash3" title="Opa, parece que os clientes podem não estar gostando muito do atendimento ou pedidos. Dê uma olhada na lista de opiniões">
            @endif
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Grau de satisfação</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                @if($data['grade'] >= 4)
                                    <i class="far fa-smile text-success mt-2"></i>
                                @elseif($data['grade'] >= 3 && $data['grade'] < 4)
                                    <i class="far fa-meh text-warning mt-2"></i>
                                @elseif($data['grade'] < 3)
                                    <i class="far fa-frown text-danger mt-2"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: #1fbee1;">Avaliações sobre o estabelecimento</div>
                <div class="card-body first-table">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @livewire('rating')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


