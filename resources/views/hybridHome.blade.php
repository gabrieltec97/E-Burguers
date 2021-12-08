@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxHibrido.js') }}"></script>

@section('title')
    Pedidos em andamento
@endsection

@section('content')

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

            <div class="col-12 mt-lg-0">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 17px; background: #1FBEE1">
                        <span style="color: white;" class="font-weight-bold em-andamento">Pedidos em andamento</span>
                        <i class="fas fa-bell float-lg-right mt-lg-2" onclick="registered()" style="color: white; cursor: pointer">
                            <span class="badge bg-primary text-white">{{count($registrado)}}</span>
                            <button value="{{ count($registrado) }}" class="totalregistrado" hidden></button>
                        </i>

                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
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
                                                ">{{ $reg->status == 'Pronto para ser retirado no restaurante' ? 'Aguardando retirada' : $reg->status  }}
                                            </button>
                                        </td>
                                        <td>

                                            <select name="teste" class="menuHibrido form-control" style="cursor:pointer;" id="{{ $reg->id }}" onchange="muda({{ $reg->id }})">
                                                <option class="alterStatus" disabled selected>Alterar Status</option>
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

                                    <?php
                                    $count2 = strlen($reg->totalValue);

                                    if ($count2 == 4 && $reg->totalValue > 10){
                                        $price = $reg->totalValue . '0';
                                    }elseif ($count2 == 2){
                                        $price = $reg->totalValue. '.' . '00';
                                    }
                                    else{
                                        $price = $reg->totalValue;
                                    }
                                    ?>

                                    <!-- Modal -->
                                        <div class="modal fade" id="modalSend{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #343A40">
                                                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-bottom: -13px; color:white;">Informações de entrega</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($reg->deliverWay != 'Entrega em domicílio')
                                                            <p class="text-center font-weight-bold" style="color: black; margin-top: -10px; font-size: 18px;">Pedido a ser retirado no restaurante.</p>
                                                        @endif

                                                        <span style="color: black; font-size: 17px">Pedido nº:</span> <span style="color: black; font-size: 16px">{{ $reg->id }}</span>

                                                        <span style="color: black; font-size: 17px" class="ml-2">Hora:</span> <span style="color: black; font-size: 16px">{{ $reg->hour }}</span>

                                                        <span style="color: black; font-size: 16px" class="ml-2 text-success">Valor total:</span> <span style="color: black; font-size: 16px">R$ {{ $price }}</span>

                                                        @if($reg->payingMethod == 'Dinheiro')
                                                            <br><span style="color: black; font-size: 17px; margin-left: 0px;" class="text-success">Troco para: </span> <span style="color: black; font-size: 16px">R$ {{ $reg->payingValue }}</span><br>
                                                        @else
                                                            <br><span style="color: black; margin-top: 20px;; font-size: 17px" class="text-success">Pagamento em: </span><span style="color: black; font-size: 17px">{{ $reg->payingMethod }}</span><br>
                                                        @endif

                                                        <span style="color: black; margin-top: 20px;; font-size: 17px" class="text-primary">Cliente:</span> <span style="color: black; font-size: 16px">{{ $reg->clientName }}</span> <br>

                                                        @if($reg->deliverWay == 'Entrega em domicílio')
                                                            <span style="color: black; font-size: 17px">Endereço: </span><span style="color: black; font-size: 16px">{{ $reg->address }} </span> <br>

                                                            @if($reg->district == null)
                                                                <br>
                                                            @endif
                                                        @endif

                                                        <span style="color: black; font-size: 17px" class="text-primary">Telefone do cliente: </span><span style="color: black; font-size: 16px">{{ $reg->userPhone }} </span> <br>


                                                        @if($reg->deliverMan != null)
                                                            <span class="text-success">Entregador: </span><span style="color: black; font-size: 16px">{{ $reg->deliverMan }}</span>
                                                        @endif
                                                        <hr>

                                                        @if($reg->detached == '')
                                                            <span style="color: black; font-size: 17px">Itens: </span> <span style="color: black; font-size: 17px">{{ $reg->comboItem }},  {{ $reg->fries }}, {{ $reg->drinks }}</span><br><br>
                                                        @else
                                                            @foreach(explode(';', $reg->detached) as $item)
                                                                @if($item != null)
                                                                    <li class="mt-2" style="color: black">{{$item}}.</li>
                                                                @endif
                                                            @endforeach
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

                                <form id="readyOrder{{ $reg->id }}" action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                    @csrf

                                    <label style="margin-top: -25px;color: black" class="font-weight-bold">Selecione o entregador</label>
                                    <select name="deliverMan" class="form-control">
                                        @foreach($deliveryMen as $d => $man)
                                            <option value="{{ $man[0]->name }} {{ $man[0]->surname }}">{{ $man[0]->name }} {{ $man[0]->surname }}</option>
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
                    Swal.close();
                    $(".alterStatus").removeAttr('selected', 'true');
                    $(".alterStatus").attr('selected', 'selected');
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
                    Swal.close();
                    $(".alterStatus").removeAttr('selected', 'true');
                    $(".alterStatus").attr('selected', 'selected');
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
                        Swal.close();
                        $(".alterStatus").removeAttr('selected', 'true');
                        $(".alterStatus").attr('selected', 'selected');
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
                    Swal.close();
                    $(".alterStatus").removeAttr('selected', 'true');
                    $(".alterStatus").attr('selected', 'selected');
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
                Swal.close();
                $(".alterStatus").removeAttr('selected', 'true');
                $(".alterStatus").attr('selected', 'selected');
            })
        </script>
    @endif

    <form action="{{ route('send.notification') }}" id="showNotif" method="POST" hidden>
        @csrf
    </form>

    <form action="{{ route('send.cancelnotification') }}" id="showCancelotif" method="POST" hidden>
        @csrf
    </form>

    <script>

        let total = parseInt($(".totalregistrado").val());

        let retorno = 'a';
        if (total > 1){
            retorno = 'Existem ' + total + ' pedidos registrados aguardando preparo';
        }else if(total == 1){
            retorno = 'Existe ' + total + ' pedido registrado aguardando preparo';
        }else if(total == 0){
            retorno = 'Não existem pedidos registrados aguardando preparo';
        }

        function registered(){

            Swal.fire({
                icon: 'info',
                title: 'Pedidos a preparar',
                text: retorno,
                showCancelButton: false,
                showConfirmButton: true,
                timer: 9000,
                timerProgressBar: true,
            });
        }
    </script>

    <?php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $thisMonth = strftime('%B');
    $thisYear = strftime('%Y');
    $thisDay = strftime('%d');

    $cancelled = \Illuminate\Support\Facades\DB::table('orders')
        ->where('status', '=', 'Cancelado')
        ->where('monthDay', '=', $thisDay)
        ->where('month', '=', $thisMonth)
        ->where('year', '=', $thisYear)
        ->get()->toArray();

    $countCancelled = count($cancelled);

    $sold = \Illuminate\Support\Facades\DB::table('orders')
        ->where('status', '=', 'Pedido Entregue')
        ->where('monthDay', '=', $thisDay)
        ->where('month', '=', $thisMonth)
        ->where('year', '=', $thisYear)
        ->get()->toArray();

    $countSold = count($sold);
    ?>

    <div class="col-12 d-flex justify-content-end">
        <div class="footerinfo" style="margin-right: -5px; position: fixed">
            <span class="badge badge-danger footer-info ml-1" style="cursor:pointer;" data-toggle="modal" data-target="#exampleModalLong">{{ $countCancelled }}</span>
            <img src="{{ asset('logo/informacoes.png') }}" style="width: 60px; height: 60px; cursor: pointer" title="Informações do pedido" class="footer-info" data-toggle="modal" data-target="#exampleModalLong">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #343a40">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Pedidos de hoje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cancelados">
                        <h4 class="text-center mb-3" style="color: black">Cancelamentos hoje:

                            @if($countCancelled == 0)
                                <span class="text-success">{{ $countCancelled }}</span>
                            @else
                                <span class="text-danger">{{ $countCancelled }}</span>
                            @endif
                        </h4>


                            @if($countCancelled == 0)
                            <div class="col-12 d-flex justify-content-center">
                                        <img src="{{ asset('logo/celebrating.png') }}" style="height: 70px; width: 80px" alt="">
                            </div>
                            <div class="mb-4 mt-2">
                                <p style="margin-bottom: -5px;" class="text-center">Nenhum pedido cancelado hoje.</p>
                            </div>
                            @endif

                        @if($countCancelled != 0)
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">#Id</th>
                                <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Itens</th>
                                <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Cliente</th>
                                <th scope="col" style="color: black; font-weight: normal; font-size: 17.5px">Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cancelled as $val)

                                <?php
                                $count = strlen($val->totalValue);

                                if ($count == 4 && $val->totalValue > 10 or $count == 3){
                                    $price = $val->totalValue . '0';
                                }elseif ($count == 2){
                                    $price = $val->totalValue. '.' . '00';
                                }
                                else{
                                    $price = $val->totalValue;
                                }
                                ?>


                                <tr>
                                    <td style="color: black">{{ $val->id }}</td>
                                    <td style="color: black">{{ $val->detached }}</td>
                                    <td style="color: black">{{ $val->clientName }}</td>
                                    <td style="color: black">{{ $price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <div class="vendidos">
                        <h4 class="text-center mb-3" style="color: black">Vendas de hoje:

                            @if($countSold == 0)
                                <span class="text-danger">{{ $countSold }}</span>
                            @else
                                <span class="text-success">{{ $countSold }}</span>
                            @endif

                        </h4>

                        @if($countSold == 0)
                            <div class="col-12 d-flex justify-content-center">
                                <img src="{{ asset('logo/dinner.png') }}" style="height: 90px; width: 80px" alt="">
                            </div>
                            <div class="mb-4 mt-2">
                                <p style="margin-bottom: -5px;" class="text-center">Nenhum pedido entregue hoje.</p>
                            </div>
                        @endif

                        @if($countSold != 0)
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th scope="col" style="color: black">#Id</th>
                                <th scope="col" style="color: black">Itens</th>
                                <th scope="col" style="color: black">Cliente</th>
                                <th scope="col" style="color: black">Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sold as $val)

                                <?php
                                $count = strlen($val->totalValue);

                                if ($count == 4 && $val->totalValue > 10 or $count == 3){
                                    $price = $val->totalValue . '0';
                                }elseif ($count == 2){
                                    $price = $val->totalValue. '.' . '00';
                                }
                                else{
                                    $price = $val->totalValue;
                                }
                                ?>


                                <tr>
                                    <td style="color: black">{{ $val->id }}</td>
                                    <td style="color: black">{{ $val->detached }}</td>
                                    <td style="color: black">{{ $val->clientName }}</td>
                                    <td style="color: black">{{ $price }}</td>
                                </tr>
                            @endforeach

                            @if($countSold == 0)
                                <tr>
                                    <td align="center" colspan="6">Nenhuma venda realizada ainda.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-danger mr-2 pedidos-cancelados" onclick="cancelledToday()">Ver pedidos cancelados</button>
                            </div>

                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-success mt-2 vendas-concluidas" onclick="soldToday()">Ver vendas concluídas</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function soldToday(){
            $(".vendas-concluidas").on('click', function (){
                $(".cancelados").hide('slow');
                $(".vendas-concluidas").hide('slow');
                $(".pedidos-cancelados").show('slow');
                $(".vendidos").show('slow');
            })
        }

        function cancelledToday(){

            $(".pedidos-cancelados").on('click', function (){
                $(".vendidos").hide('slow');
                $(".pedidos-cancelados").hide('slow');
                $(".cancelados").show('slow');
                $(".vendas-concluidas").show('slow');
            })
        }
    </script>
@endsection


