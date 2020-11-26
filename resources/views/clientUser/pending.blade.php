@extends('layouts.extend-client')

@section('title')
    Meu pedido
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">

            @if(count($order) > 0)
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center my-3">Seus pedidos pendentes</h1>
            </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4 text-center">

                                        @if(count($order) == 1)
                                            <a class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-check-circle mr-2"></i>Confirmar pedido</a>
                                        @else
                                            <a class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-check-circle mr-2"></i>Confirmar pedidos</a>
                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Ei! Atenção aqui.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(count($order) == 1)
                                                            <span class="font-weight-bold">Tem certeza que deseja confirmar este pedido? Ele ficará disponível
                                                        para a equipe do restaurante preparar.</span>
                                                        @else
                                                            <span class="font-weight-bold">Tem certeza que deseja confirmar estes pedidos? Eles ficarão disponíveis
                                                        para a equipe do restaurante preparar.</span>
                                                        @endif

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                        <a type="button" href="{{ route('confirmarPedido') }}" class="btn btn-primary">Confirmar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                @foreach($order as $ord)
                                    <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="font-weight-bold">Pedido #{{$ord->id}}</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center font-weight-bold text-muted">Itens do pedido</h5>
                                                @if(isset($ord->detached))
                                                    <span class="font-weight-bold text-primary"> {{ $ord->detached }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-12 mt-4 col-sm-12">
                    <h1 class="titulo-cardapio text-center my-3">Você não tem pedidos pendentes</h1>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </div>
            @endif
@endsection
