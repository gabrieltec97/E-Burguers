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
                <script>
                    Swal.fire({
                        icon: 'info',
                        title: 'O pedido foi enviado para preparo!',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true
                    })
                </script>
            @endif

                @if(session('msg-prep'))
                    <script>
                        Swal.fire({
                            icon: 'info',
                            title: 'Item pronto para retirada/envio!',
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true
                        })
                    </script>
                @endif

                @if(session('msg-venda'))
                    <script>
                        Swal.fire({
                            title: 'Muito beeeem!',
                            text: 'O pedido foi entregue, parabéns à todos pelo empenho!',
                            imageUrl: 'https://localhost/E-Pedidos/public/logo/congrats.gif',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Parabéns pelo empenho!',
                            showConfirmButton: false,
                            timer: 6000,
                            timerProgressBar: true
                        })
                    </script>
                @endif

            @if(session('msg-2'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pedido cancelado com sucesso!',
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true
                        })
                    </script>
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

                                        <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Em preparo', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                            @csrf
                                        </form>

                                        <form id="finishedOrder{{ $reg->id }}" action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Pedido Entregue', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                            @csrf
                                        </form>

                                        <form id="formPrepare{{ $reg->id }}" action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Em preparo', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                            @csrf
                                        </form>

                                        <form id="formCancel{{ $reg->id }}" action="{{route('alterarStatus', ['id' => $reg->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                            @csrf
                                        </form>

                                        <form id="readyOrder{{ $reg->id }}" action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                            @csrf
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

                Swal.fire({
                    title: 'Deseja cancelar o pedido ' + id + ' ?',
                    icon: 'question',
                    showCancelButton: false,
                    showConfirmButton: false,
                    html:
                    '<button type="button" class="btn btn-danger mt-2 cancelar-pedido">Cancelar Pedido</button>' +
                    '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
                })

                $(".fechar").on('click', function (){
                    Swal.close()
                })

                $(".cancelar-pedido").on('click', function (){
                    $(this).html('<div class="spinner-border text-light" role="status"></div>');
                    $("#formCancel" + id).submit();
                })

            }else if (acao == 'EmPreparo'){

                Swal.fire({
                    title: 'Deseja enviar o pedido ' + id + ' para preparo?',
                    icon: 'question',
                    showCancelButton: false,
                    showConfirmButton: false,
                    html:
                        '<button type="button" class="btn btn-success mt-2 sendPrepare">Enviar para preparo</button>' +
                        '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
                })

                $(".fechar").on('click', function (){
                    Swal.close()
                })

                $(".sendPrepare").on('click', function (){
                    $(this).html('<div class="spinner-border text-light" role="status"></div>');
                    $("#formPrepare" + id).submit();
                })

            }else if (acao == 'Retirar' || acao == 'Rota'){

                if (acao == 'Retirar'){
                    Swal.fire({
                        title: 'Deseja informar que o pedido ' + id + ' está pronto para retirada?',
                        icon: 'question',
                        showCancelButton: false,
                        showConfirmButton: false,
                        html:
                            '<button type="button" class="btn btn-success mt-2 sendOrder">Pedido pronto</button>' +
                            '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
                    })

                    $(".fechar").on('click', function (){
                        Swal.close()
                    })

                    $(".sendOrder").on('click', function (){
                        $(this).html('<div class="spinner-border text-light" role="status"></div>');
                        $("#readyOrder"+ id).submit();
                    })
                }else if (acao == 'Rota'){
                    Swal.fire({
                        title: 'Deseja informar que o pedido ' + id + ' saiu para entrega?',
                        icon: 'question',
                        showCancelButton: false,
                        showConfirmButton: false,
                        html:
                            '<button type="button" class="btn btn-success mt-2 sendOrder">Enviar pedido</button>' +
                            '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
                    })

                    $(".fechar").on('click', function (){
                        Swal.close()
                    })

                    $(".sendOrder").on('click', function (){
                        $(this).html('<div class="spinner-border text-light" role="status"></div>');
                        $("#readyOrder"+ id).submit();
                    })
                }
            }else if (acao == 'Entregue'){

                Swal.fire({
                    title: 'O pedido ' + id + ' foi entregue?',
                    icon: 'question',
                    showCancelButton: false,
                    showConfirmButton: false,
                    html:
                        '<button type="button" class="btn btn-success mt-2 finished">Sim</button>' +
                        '<button type="button" class="btn btn-danger mt-2 ml-4 fechar">Não</button>'
                })

                $(".fechar").on('click', function (){
                    Swal.close()
                })

                $(".finished").on('click', function (){
                    $(this).html('<div class="spinner-border text-light" role="status"></div>');
                    $("#finishedOrder"+ id).submit();
                })
            }
        }
    </script>
@endsection


