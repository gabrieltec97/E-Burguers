@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxHibrido.js') }}"></script>

@section('title')
    Pedidos em andamento
@endsection

@section('content')
    <div class="container-fluid">

        <div class="col-12">
            @if(session('msg'))
                <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
                    <strong>Tudo certo!</strong> {{ session('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

                @if(session('msg-venda'))
                    <script>
                        $.toast({
                            text: '<b style="font-size: 14px;">O pedido foi entregue com sucesso. Parabéns a todos pelo empenho!</b>',
                            heading: '<b style="font-size: 17px">Muito bem!</b>',
                            showHideTransition: 'slide',
                            bgColor : '#38C172',
                            position : 'top-right',
                            hideAfter: 9000
                        })
                    </script>
                @endif

            @if(session('msg-2'))
                <div class="alert alert-danger sumir-feedback alert-dismissible fade show" role="alert">
                    <strong>{{ session('msg-2') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        <div class="row">

            <div class="col-12 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: linear-gradient(90deg, rgba(238,8,8,1) 24%, rgba(248,249,252,1) 76%);">
                        <span style="color: white;" class="font-weight-bold">Pedidos em andamento</span> <span class="badge bg-secondary">{{count($count)}}</span></div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Status</th>
                                <th scope="col">Informações</th>
                                <th scope="col">Tratativas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($registered) != 0)
                                @foreach($registered as $reg)
                                    <tr>
                                        <td>#{{ $reg->id }}</td>
                                        <td>{{ $reg->status }}</td>
                                        <td>
                                            @if($reg->deliverWay == 'Retirada no restaurante')
                                                <b style="color: black">Item a ser retirado no restaurante.</b>
                                            @else
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalSend{{$reg->id}}" title="Informações a serem repassadas ao entregador."><i class="fas fa-info-circle mr-1"></i> Informações de entrega</button>
                                            @endif
                                        </td>
                                        <td colspan="2">

                                            <select name="teste" class="menuHibrido form-control" id="{{ $reg->id }}" onchange="muda({{ $reg->id }})">
                                                <option value=""selected disabled>Alterar Status</option>
                                                <option value="Cancelar">Cancelar</option>
                                                <option value="EmPreparo">Em Preparo</option>
                                                @if($reg->deliverWay == 'Retirada no restaurante')
                                                    <option value="Retirar">Pronto para retirar</option>
                                                @else
                                                    <option value="Rota">Em rota de entrega</option>
                                                @endif
                                                <option value="Entregue">Pedido entregue</option>
                                            </select>
                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalChange{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>Tem certeza que deseja mandar o pedido {{ $reg->id }} para preparo?</p>
                                                                    <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Em preparo', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Enviar para preparo</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalSend{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center" style="color: black; font-size: 18px;">Passe estas informações ao responsável pela entrega.</p>

                                                        <b style="color: black">Pedido:</b> <span style="color: black">{{ $reg->id }}</span> <br>

                                                        <b style="color: black">Cliente:</b> <span style="color: black">{{ $reg->clientName }}</span> <br>
                                                        {{--                                           Endereço: {{ $reg-> }} <br>--}}

                                                        @if($reg->detached == '')
                                                            <b style="color: black">Itens: </b> <span style="color: black">{{ $reg->comboItem }},  {{ $reg->fries }}, {{ $reg->drinks }}</span><br><br>
                                                        @else
                                                            <b style="color: black">Itens: </b> <span style="color: black">{{ $reg->detached }}</span><br>
                                                        @endif

                                                        <hr>

                                                        @if($reg->payingMethod == 'Dinheiro')
                                                            <b style="color: black">Valor total:</b> <span style="color: black"> {{ $reg->totalValue }}</span><br>
                                                            <b style="color: black">Troco para: </b> <span style="color: black">{{ $reg->payingValue }}</span><br>
                                                        @else
                                                            <b style="color: black">Pagamento em cartão:</b> <span style="color: black">{{ $reg->payingMethod }}</span><br>
                                                        @endif

                                                        <b style="color: black">Endereço:</b><span style="color: black">{{ $reg->address }}</span>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalSended{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>O pedido {{ $reg->id }} para foi entregue?</p>
                                                                    <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Pedido Entregue', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Voltar</button>
                                                        <button type="submit" class="btn btn-primary">Sim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalChange{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>Tem certeza que deseja mandar o pedido {{ $reg->id }} para preparo?</p>
                                                                    <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Em preparo', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Enviar para preparo</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalCancela{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza que deseja cancelar o pedido {{ $reg->id }}?</p>
                                                        <form action="{{route('alterarStatus', ['id' => $reg->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                        @csrf


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-danger">Cancelar Pedido</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalTake{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Deseja alterar o status do pedido {{ $reg->id }} para "Em rota de envio"?</p>
                                                        <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                        @csrf


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-danger">Enviar Pedido</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    </form>
                    </div>
                </div>

                @endforeach
                @else
                    <tr>
                        <td align="center" colspan="6">Sem registros encontrados.</td>
                    </tr>
                    @endif
                    </tbody>
                    </table>
                        <div class="col-12 offset-1 offset-xl-2">
                            <span>{{ $registered->links() }}</span>
                        </div>
                </div>
            </div>

        </div>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    </div>
    </div>

    <select class="countHybrid" hidden>
        <option value="{{ count($count) }}"></option>
    </select>

    <audio id="newPrepare">
        <source src="{{ asset('audio/kitchen.mp3') }}" type="audio/mp3">
    </audio>

    <script>
        function muda(id){
            var acao = $("#" +id).val();

            if (acao == 'Cancelar'){
                $('#modalCancela' + id).modal();
            }else if (acao == 'EmPreparo'){
                $('#modalChange' + id).modal();
            }else if (acao == 'Retirar' || acao == 'Rota'){
                $('#modalTake' + id).modal();
            }else if (acao == 'Entregue'){
                $('#modalSended' + id).modal();
            }
        }
    </script>
@endsection


