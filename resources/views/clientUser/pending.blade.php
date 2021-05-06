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

                                                <ul>
                                                @if(isset($ord->hamburguer))
                                                        <li><span class="font-weight-bold text-primary"> {{ $ord->hamburguer }}</span></li>
                                                    @endif

                                                    @if(isset($ord->fries))
                                                        <li><span class="font-weight-bold text-primary"> {{ $ord->fries }}</span></li>
                                                    @endif

                                                    @if(isset($ord->drinks))
                                                        <li><span class="font-weight-bold text-primary"> {{ $ord->drinks }}</span></li>
                                                    @endif
                                                </ul>

                                                    <div class="container-fluid">
                                                        <div class="row">
                                                        <form action="{{ route('deletaPendente', $id= $ord->id) }}">
                                                            <div class="col-12"><button class="btn btn-danger float-right">Deletar pedido</button></div>
                                                        </form>

                                                        <form action="{{ route('confirmaPendente', $id= $ord->id) }}">

                                                            <div class="col-12"><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success float-left">Confirmar pedido</button></div>


                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p style="font-size: 15px">Ao confirmar pedido, ele será cadastrado e começará a ser preparado. Deseja prosseguir?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">Sair</button>
                                                                            <button type="submit" class="btn btn-primary font-weight-bold">Confirmar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    </div>

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

        @if(session('msg-rem'))
            <button hidden class="disparo-removePendente"></button>
        @endif
@endsection
