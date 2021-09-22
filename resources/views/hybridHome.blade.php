@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxHibrido.js') }}"></script>

@section('title')
    Pedidos em andamento
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0px 0px;">

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
                            icon: 'success',
                            title: '{{ session('msg-prep') }}',
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 10000,
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
                    <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: #28f5ac">
                        <span style="color: #2f2f2f;" class="font-weight-bold">Pedidos em andamento</span> <span class="badge" style="background: #e37750">{{count($count)}}</span></div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col" style="color: #2f2f2f">Id</th>
                                <th scope="col" style="color: #2f2f2f">Status e informações</th>
                                <th scope="col" style="color: #2f2f2f">Tratativas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($registered) != 0)
                                @foreach($registered as $reg)
                                    <tr>
                                        <td>#{{ $reg->id }}</td>
                                        <td><button class="btn font-weight-bold" data-toggle="modal" data-target="#modalSend{{$reg->id}}" title="Informações referentes à este pedido." style="border-radius: 50px; border: none;

                                       {{ $reg->status == 'Em rota de entrega' ? 'background: #22e583; color: #fffcfc' : ''  }}
                                       {{ $reg->status == 'Pedido registrado' ? 'background: #5bc0de; color: #fffcfc' : ''  }}
                                       {{ $reg->status == 'Em preparo' ? 'background: #FFD700; color: black' : ''  }}
                                       {{ $reg->status == 'Pronto para ser retirado no restaurante' ? 'background: #22e583; color: #fffcfc' : ''  }}
                                                ">{{ $reg->status }}</button></td>
                                        <td>

                                            <select name="teste" class="menuHibrido form-control" style="cursor:pointer;" id="{{ $reg->id }}" onchange="muda({{ $reg->id }})">
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
                                                        @if($reg->payingMethod != 'Dinheiro')
                                                            <b style="color: black">Valor total:</b> <span style="color: black"> {{ $reg->totalValue }}</span><br>
                                                        @endif
                                                        @if($reg->deliverWay == 'Retirada no restaurante')
                                                            <b style="color: red">Retirada no restaurante</b>
                                                        @else
                                                        <b style="color: black">Endereço: </b><span style="color: black">{{ $reg->address }}</span>
                                                        @endif

                                                        @if($reg->deliverMan != null)
                                                            <br>
                                                            <b style="color: black">Entregador:</b> <span style="color: black"> {{ $reg->deliverMan }}</span><br>
                                                        @endif
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


                    </div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary envia-lanche{{ $reg->id }}" data-toggle="modal" data-target="#enviarlanche{{$reg->id}}" hidden>
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="enviarLanche{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 style="color: black" class="font-weight-bold mt-1 text-center">O pedido {{ $reg->id }} será enviado ao cliente. Escolha o entregador responsável.</h5><br>
{{--                                <p style="margin-top: -20px; color: black">O cliente será informado que o pedido saiu para entrega.--}}
{{--                                Selecione o entregador responsável pelo envio.</p>--}}

                                <form id="readyOrder{{ $reg->id }}" action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                    @csrf

                                    <label style="margin-top: -25px;color: black" class="font-weight-bold">Selecione o entregador</label>
                                    <select name="deliverMan" class="form-control">
                                        @foreach($deliveryMen as $d => $man)
                                            <option value="{{ $man->name }}">{{ $man->name }}</option>
                                        @endforeach
                                            <option value="Não informado"> -- Não informar --</option>
                                    </select>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                                <button type="button" class="btn btn-success sendOrder">Enviar pedido</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                @else
                    <tr>
                        <td align="center" colspan="6">Nenhum pedido cadastrado ainda.</td>
                    </tr>
                    @endif
                    </tbody>
                    </table>

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

                    $(".envia-lanche"+id).click();

                    $(".sendOrder").on('click', function (){
                        $(this).html('<div class="spinner-border text-light" role="status"></div>');
                        $("#readyOrder"+ id).submit();
                    });
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

    @if($deliveryStatus[0]->status == 'Fechado')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'O delivery está fechado!',
                text: 'Você precisa abri-lo para que possa receber pedidos, ok?',
                showCancelButton: false,
                showConfirmButton: false,
                html:
                    '<p>Você precisa abri-lo para que possa receber pedidos.</p>' +
                    '<button type="button" class="btn btn-primary mt-2 fechar">Ignorar</button>' +
                    '<a href="{{ route('delivery') }}" type="button" class="btn btn-success mt-2 ml-4 ">Abrir delivery</a>'
            })

            $(".fechar").on('click', function (){
                Swal.close()
            })
        </script>
    @endif
@endsection


