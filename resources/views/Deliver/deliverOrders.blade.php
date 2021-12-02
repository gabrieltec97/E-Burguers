@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Pedidos em andamento
@endsection

@section('content')

    <div class="col-12">

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
                <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: #1FBEE1">
                    <span style="color: white;" class="font-weight-bold em-andamento">Pedidos a serem entregues</span>
                    <span class="badge float-lg-right mt-lg-2" style="background: rgba(0,0,0,0.7);">{{count($count)}}</span>
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

                                    <form id="finishedOrder{{ $reg->id }}" action="{{ route('entregadorAlteraStatus', ['id' => $reg->id, 'acao' => 'Pedido Entregue', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                        @csrf
                                    </form>

                                    <form id="formCancel{{ $reg->id }}" action="{{route('entregadorAlteraStatus', ['id' => $reg->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                        @csrf
                                    </form>


                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary envia-lanche{{ $reg->id }}" data-toggle="modal" data-target="#enviarlanche{{$reg->id}}" hidden>
                Launch demo modal
            </button>


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

    <form action="{{ route('send.notification') }}" id="showNotif" method="POST" hidden>
        @csrf
    </form>

    <form action="{{ route('send.deliverNotification') }}" id="showDeliverNotif" method="POST" hidden>
        @csrf
    </form>

    <form action="{{ route('send.cancelnotification') }}" id="showCancelotif" method="POST" hidden>
        @csrf
    </form>

    <script>
        $(document).ready(() => {

            setInterval(function () {

                $.ajax({type: 'GET',
                    url: "{{ route('deliverTaking') }}",
                    dataType: 'json',
                    success: function($deliverData){

                        var valorAnterior = parseInt($(".countHybrid").val());
                        var valorAtual = parseInt($deliverData.length);
                        var tocar3 = document.getElementById("newPrepare");

                        function playAudio3() {
                            tocar3.play();
                        }

                        if (valorAnterior < valorAtual){
                            playAudio3();

                            if (Notification.permission === "granted"){
                                var notification = new Notification("Você tem um novo pedido para entrega!");

                                setTimeout(function (){
                                    $("#showDeliverNotif").submit();
                                }, 1000);

                            }else if(Notification.permission !== 'denied'){
                                Notification.requestPermission().then(permission => {

                                    if (permission === "granted"){
                                        var notification = new Notification("Você tem um novo pedido para entrega!");

                                        setTimeout(function (){
                                            $("#showDeliverNotif").submit();
                                        }, 1000);
                                    }
                                })
                            }

                        }else if (valorAnterior > valorAtual){

                            if (Notification.permission === "granted"){

                                var notification = new Notification("Pedido cancelado!");

                                setTimeout(function (){
                                    $("#showCancelotif").submit();
                                }, 1000);

                            }else if(Notification.permission !== 'denied'){
                                Notification.requestPermission().then(permission => {
                                    if (permission === "granted"){
                                        var notification = new Notification("Pedido cancelado!");

                                        setTimeout(function (){
                                            $("#showCancelotif").submit();
                                        }, 1000);
                                    }
                                })
                            }
                        }
                    },
                    error: function(erro){console.log(erro)}})
            },10000)
        })

    </script>

@endsection


