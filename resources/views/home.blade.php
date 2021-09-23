@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajax-atualizar.js') }}"></script>

@section('title')
    Gestão de pedidos
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
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

                    @if(session('msg-prep'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '{{ session('msg-prep') }}',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 7000,
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

            </div>
{{--                <button type="button" class="mudarStatus3" hidden data-toggle="modal" data-target="#exampleModal3"></button>--}}
{{--                <button type="button" class="mudarStatus4" hidden data-toggle="modal" data-target="#exampleModal4"></button>--}}
{{--                <button type="button" class="mudarStatus5" hidden data-toggle="modal" data-target="#exampleModal5"></button>--}}
{{--                <button type="button" class="mudarStatus6" hidden data-toggle="modal" data-target="#exampleModal6"></button>--}}


                <div class="col-lg-7 col-sm-12 mt-3 mt-md-0">
                    <div class="card card-preparo">
                        <div class="card-header font-weight-bold text-muted" style="font-size: 18px; background: #394751">
                            <span class="text-white">Em Andamento</span> <span class="badge bg-white" style="color: black;">{{ count($prepare) }}</span> </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover table-responsive-lg">
                                <thead>
                                <tr>
                                    <th scope="col" style="color: black">Id do pedido</th>
                                    <th scope="col" style="color: black">Status e Informações</th>
                                    <th scope="col" style="color: black">Tratativas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($prepare) != 0)
                                    @foreach($prepare as $prep)
                                        <tr>
                                            <td style="color: black">#{{ $prep->id }}</td>
                                            <td style="color: black">
                                                    <button class="btn font-weight-bold" data-toggle="modal" data-target="#modalSend{{$prep->id}}" title="Informações referentes à este pedido." style="border-radius: 50px; border: none;

                                                    {{ $prep->status == 'Em rota de entrega' ? 'background: #22e583; color: #fffcfc' : ''  }}
                                                    {{ $prep->status == 'Pedido registrado' ? 'background: #5bc0de; color: #fffcfc' : ''  }}
                                                    {{ $prep->status == 'Pronto' ? 'background: #FFD700; color: black' : ''  }}
                                                    {{ $prep->status == 'Em preparo' ? 'background: #FFD700; color: black' : ''  }}
                                                    {{ $prep->status == 'Pronto para ser retirado no restaurante' ? 'background: #22e583; color: #fffcfc' : ''  }}
                                                        ">{{ $prep->status }}
                                                        @if($prep->status == 'Pronto')
                                                            <span class="spinner-grow spinner-grow-sm mb-1 text-danger" role="status" aria-hidden="true"></span>
                                                        @endif
                                                    </button>
                                            </td>
                                            <td style="color: black">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-2 mr-2">
                                                            @if($prep->status == 'Pronto')
                                                                <form id="sendToClient{{$prep->id}}" action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf
                                                                    @if($prep->deliverWay == 'Retirada no restaurante')
                                                                        <img src="{{ asset('logo/comment.png') }}" title="Pedido entregue" style="width: 30px; height: 30px; margin-left: 5px; cursor: pointer; margin-top: 5px" alt="Pedido entregue" onclick="deliverToClient({{ $prep->id }})">
                                                                    @else
                                                                        <img src="{{ asset('logo/delivery-man.png') }}" title="Enviar ao cliente" style="width: 30px; height: 30px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="Enviar ao cliente" data-toggle="modal" data-target="#modalChooseBoy{{$prep->id}}">
                                                                    @endif

                                                                <!-- Modal -->
                                                                    <div class="modal fade" id="modalChooseBoy{{$prep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <h4 class="mb-3">Deseja ao cliente que ele(a) já pode buscar o pedido {{ $prep->id }}?</h4>

                                                                                    <label>Selecione o entregador responsável</label>
                                                                                    <select name="deliverMan" class="form-control">
                                                                                        @foreach($deliverMen as $key => $value)
                                                                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                                                                        @endforeach
                                                                                        <option value="Não informado"> -- Não informar --</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                                                                                    <button type="button" class="btn btn-success sendOrder" onclick="deliverToClient2({{ $prep->id }})">Enviar ao cliente</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            @elseif($prep->status == 'Pedido registrado')
                                                                <form id="sendKitchen{{ $prep->id }}" action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'Em preparo','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf
                                                                    <img src="{{ asset('logo/panela.png') }}" title="Enviar para preparo" style="width: 31px; height: 31px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="" onclick="sendToPrepare({{ $prep->id }})">

                                                                <!-- Modal -->
                                                                    <div class="modal fade" id="exampleModalcw{{$prep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel"><i class="fas fa-exclamation-triangle mr-1"></i> Um momento..</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <span class="font-weight-bold texto-mudar-status"></span>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-info cancela-mudanca" data-dismiss="modal">Voltar</button>
                                                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @endif

                                                        </div>
                                                        <div class="col-6">
                                                            <img src="{{ asset('logo/1008927.png') }}" title="Cancelar pedido" style="width: 30px; height: 30px; margin-left: 15px; cursor: pointer; margin-top: 5px" alt="Cancelar pedido" onclick="cancelOrder({{ $prep->id }})">

                                                            <form id="cancelOrder{{ $prep->id }}" action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                            @csrf
                                                            </form>
                                            </td>

                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalSend{{$prep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($prep->deliverWay == 'Entrega em domicílio')
                                                            <p class="text-center" style="color: black; font-size: 18px;">Passe estas informações ao responsável pela entrega.</p>
                                                        @else
                                                            <p class="text-center" style="color: black; font-size: 18px;">Pedido a ser retirado no restaurante.</p>
                                                        @endif

                                                        <b style="color: black">Pedido:</b> <span style="color: black">{{ $prep->id }}</span> <br>

                                                        <b style="color: black">Hora:</b> <span style="color: black">{{ $prep->hour }}</span> <br>

                                                        <b style="color: black">Cliente:</b> <span style="color: black">{{ $prep->clientName }}</span> <br>
                                                        {{--                                           Endereço: {{ $reg-> }} <br>--}}

                                                        @if($prep->detached == '')
                                                            <b style="color: black">Itens: </b> <span style="color: black">{{ $prep->comboItem }},  {{ $prep->fries }}, {{ $prep->drinks }}</span><br><br>
                                                        @else
                                                            <b style="color: black">Itens: </b> <span style="color: black">{{ $prep->detached }}</span><br>
                                                        @endif

                                                        <hr>

                                                        @if($prep->payingMethod == 'Dinheiro')
                                                            <b style="color: black">Valor total:</b> <span style="color: black"> {{ $prep->totalValue }}</span><br>
                                                            <b style="color: black">Troco para: </b> <span style="color: black">{{ $prep->payingValue }}</span><br>
                                                        @else
                                                            <b style="color: black">Pagamento em cartão:</b> <span style="color: black">{{ $prep->payingMethod }}</span><br>
                                                        @endif

                                                        @if($prep->deliverWay == 'Entrega em domicílio')
                                                            <b style="color: black">Endereço:</b><span style="color: black">{{ $prep->address }}</span>
                                                        @else
                                                            <span class="text-danger font-weight-bold">Pedido a ser retirado no restaurante.</span>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @else
                            <tr>
                                <td align="center" colspan="5">Sem pedidos em preparo.</td>
                            </tr>
                        @endif
                        </div>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mt-4 mt-lg-0 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: #17B3DF">
                    <span style="color: white;" class="font-weight-bold">Em rota de entrega</span> <span class="badge" style="background: #e14308">{{count($totalReady)}}</span></div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th style="color: black">Id</th>
                            <th style="color: black">Hora do pedido</th>
                            <th style="color: black">Tratativas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($ready) != 0)
                            @foreach($ready as $rd)
                                <tr>
                                    <td style="color: black">#{{ $rd->id }}</td>
                                    <td style="color: black"><button class="btn btn-primary" data-toggle="modal" data-target="#modalFinal{{$rd->id}}"><i class="fas fa-info-circle mr-2"></i>Dados do pedido</button></td>
                                    <td style="color: black">
                                        <div>
                                            <div class="row">
                                                <div class="col-2 mr-2">
                                                    <form id="delivered{{ $rd->id }}" action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Pedido Entregue', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                        @csrf
                                                        <img src="{{ asset('logo/comment.png') }}" title="Pedido entregue" style="width: 30px; height: 30px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="Pedido entregue" onclick="delivered({{ $rd->id }})">
                                                    </form>
                                                </div>
                                                <div class="col-6">
                                                    <img src="{{ asset('logo/1008927.png') }}" title="Cancelar pedido" style="width: 30px; height: 30px; margin-left: 15px; cursor: pointer; margin-top: 1px" alt="Cancelar pedido" onclick="cancelOrder({{ $rd->id }})">

                                                    <form id="cancelOrder{{ $rd->id }}" action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                    @csrf

                                                </td>
                                                </form>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalFinal{{$rd->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Informações de entrega.</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <b style="color: black">Pedido: </b> <span style="color: black">{{ $rd->id }}</span> <br>

                                                    <b style="color: black">Hora:</b> <span style="color: black">{{ $rd->hour }}</span> <br>

                                                    <b style="color: black">Cliente: </b> <span style="color: black">{{ $rd->clientName }}</span> <br>
                                                    {{--                                           Endereço: {{ $reg-> }} <br>--}}

                                                    @if($rd->detached == '')
                                                        <b style="color: black">Itens: </b> <span style="color: black">{{ $rd->comboItem }},  {{ $rd->fries }}, {{ $rd->drinks }}</span><br><br>
                                                    @else
                                                        <b style="color: black">Itens: </b> <span style="color: black">{{ $rd->detached }}</span><br>
                                                    @endif

                                                    <hr>

                                                    @if($rd->payingMethod == 'Dinheiro')
                                                        <b style="color: black">Valor total: </b> <span style="color: black"> {{ $rd->totalValue }}</span><br>
                                                        <b style="color: black">Troco para: </b> <span style="color: black">{{ $rd->payingValue }}</span><br>
                                                    @else
                                                        <b style="color: black">Pagamento em cartão:</b> <span style="color: black">{{ $rd->payingMethod }}</span><br>
                                                    @endif

                                                    @if($rd->deliverWay == 'Entrega em domicílio')
                                                        <b style="color: black">Endereço: </b><span style="color: black">{{ $rd->address }}</span>
                                                    @else
                                                        <span class="text-danger font-weight-bold">Pedido a ser retirado no restaurante.</span>
                                                    @endif
                                                    <br>
                                                    <b style="color: black">Entregador: </b><span style="color: black">{{ $rd->deliverMan }}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
                </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td align="center" colspan="5">Sem pedidos à serem entregues</td>
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

    <audio id="newOne">
        <source src="{{ asset('audio/newOne.mp3') }}" type="audio/mp3">
    </audio>

    <audio id="readyOne">
        <source src="{{ asset('audio/ready.mp3') }}" type="audio/mp3">
    </audio>

    <select class="count" hidden>
        <option value="{{ count($registered) }}"></option>
    </select>

    <select class="status-ref" hidden>
        <option value="{{ count($prepareCount) }}"></option>
    </select>

    <script>
        function sendToPrepare(id){
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
                $("#sendKitchen" + id).submit();
            })
        }

        function deliverToClient(id){
            Swal.fire({
                title: 'Deseja enviar o pedido ' + id + ' para o cliente?',
                icon: 'question',
                showCancelButton: false,
                showConfirmButton: false,
                html:
                    '<button type="button" class="btn btn-success mt-2 sendPrepare">Enviar para entrega</button>' +
                    '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
            })

            $(".fechar").on('click', function (){
                Swal.close()
            })

            $(".sendPrepare").on('click', function (){
                $(this).html('<div class="spinner-border text-light" role="status"></div>');
                $("#sendToClient" + id).submit();
            })
        }

        function deliverToClient2(id){
            $(".sendOrder").html('<div class="spinner-border text-light" role="status"></div>');
            $("#sendToClient" + id).submit()
        }

        function cancelOrder(id){
            Swal.fire({
                title: 'Deseja cancelar o pedido ' + id + '?',
                icon: 'question',
                showCancelButton: false,
                showConfirmButton: false,
                html:
                    '<button type="button" class="btn btn-danger mt-2 sendPrepare">Cancelar pedido</button>' +
                    '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
            })

            $(".fechar").on('click', function (){
                Swal.close()
            })

            $(".sendPrepare").on('click', function (){
                $(this).html('<div class="spinner-border text-light" role="status"></div>');
                $("#cancelOrder" + id).submit();
            })
        }

        function delivered(id){
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
                $("#delivered"+ id).submit();
            })
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



