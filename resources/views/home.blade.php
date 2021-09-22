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
                <button type="button" class="mudarStatus3" hidden data-toggle="modal" data-target="#exampleModal3"></button>
                <button type="button" class="mudarStatus4" hidden data-toggle="modal" data-target="#exampleModal4"></button>
                <button type="button" class="mudarStatus5" hidden data-toggle="modal" data-target="#exampleModal5"></button>
                <button type="button" class="mudarStatus6" hidden data-toggle="modal" data-target="#exampleModal6"></button>


                <div class="col-lg-7 col-sm-12 mt-3 mt-md-0">
                    <div class="card card-preparo">
                        <div class="card-header font-weight-bold text-muted" style="font-size: 18px; background: linear-gradient(90deg, rgba(113,231,73,1) 24%, rgba(248,249,252,1) 76%);">
                            <span class="text-white">Em Andamento</span> <span class="badge bg-secondary text-white">{{ count($total) }}</span> </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover table-responsive-lg">
                                <thead>
                                <tr>
                                    <th scope="col">Id do pedido</th>
                                    <th scope="col">Status do pedido</th>
                                    <th scope="col">Informações</th>
                                    <th scope="col">Tratativas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($prepare) != 0)
                                    @foreach($prepare as $prep)
                                        <tr>
                                            <td>#{{ $prep->id }}</td>
                                            <td>{{ $prep->status }}</td>
                                            <td>
                                                @if($prep->deliverWay == 'Retirada no restaurante')
                                                    <b style="color: black">Item a ser retirado no restaurante.</b>
                                                @else
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalSend{{$prep->id}}" title="Informações a serem repassadas ao entregador."><i class="fas fa-info-circle mr-1"></i> Dados</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-2 mr-2">
                                                            @if($prep->status == 'Pronto')
                                                                <form id="sendToClient{{$prep->id}}" action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'prontoretiradaenvio','remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                                    @csrf
                                                                    @if($prep->deliverWay == 'Retirada no restaurante')
                                                                        <i class="fas fa-check-circle text-success pronto-retirar" title="Pronto para entrega" style="font-size: 25px; cursor: pointer; margin-top: 1px" onclick="deliverToClient({{ $prep->id }})"></i>
                                                                    @else
                                                                        <img src="{{ asset('logo/delivery-man.png') }}" title="Enviar ao cliente" style="width: 25px; height: 25px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="Enviar ao cliente" data-toggle="modal" data-target="#modalChooseBoy{{$prep->id}}">
                                                                    @endif

                                                                <!-- Modal -->
                                                                    <div class="modal fade" id="modalChooseBoy{{$prep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <h4 class="mb-3">Deseja enviar o pedido #{{ $prep->id }} ao cliente?</h4>

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
                                                                    <img src="{{ asset('logo/panela.png') }}" title="Enviar para preparo" style="width: 25px; height: 25px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="" onclick="sendToPrepare({{ $prep->id }})">

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
                                                            <img src="{{ asset('logo/cancellation.png') }}" title="Cancelar pedido" style="width: 25px; height: 25px; margin-left: 10px; cursor: pointer; margin-top: 1px" alt="Cancelar pedido" onclick="cancelOrder({{ $prep->id }})">

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
                                                        <p class="text-center" style="color: black; font-size: 18px;">Passe estas informações ao responsável pela entrega.</p>

                                                        <b style="color: black">Pedido:</b> <span style="color: black">{{ $prep->id }}</span> <br>

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

                                                        <b style="color: black">Endereço:</b><span style="color: black">{{ $prep->address }}</span>

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

                    <div class="col-12 d-flex justify-content-center">
                        <span>{{ $prepare->links() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mt-4 mt-lg-0 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: linear-gradient(90deg, rgba(238,8,8,1) 24%, rgba(248,249,252,1) 76%);">
                    <span style="color: white;" class="font-weight-bold">Em rota de entrega</span> <span class="badge bg-secondary">{{count($totalReady)}}</span></div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Hora do pedido</th>
                            <th>Tratativas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($ready) != 0)
                            @foreach($ready as $rd)
                                <tr>
                                    <td>#{{ $rd->id }}</td>
                                    <td>{{ $rd->hour }}</td>
                                    <td>
                                        <div>
                                            <div class="row">
                                                <div class="col-2 mr-2">
                                                    <form id="delivered{{ $rd->id }}" action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Pedido Entregue', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                        @csrf
                                                        <img src="{{ asset('logo/comment.png') }}" title="Pedido entregue" style="width: 25px; height: 25px; margin-left: 5px; cursor: pointer; margin-top: 1px" alt="Pedido entregue" onclick="delivered({{ $rd->id }})">
                                                    </form>
                                                </div>
                                                <div class="col-6">
                                                    <img src="{{ asset('logo/cancellation.png') }}" title="Cancelar pedido" style="width: 25px; height: 25px; margin-left: 10px; cursor: pointer; margin-top: 1px" alt="Cancelar pedido" onclick="cancelOrder({{ $rd->id }})">

                                                    <form id="cancelOrder{{ $rd->id }}" action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Cancelado', 'remetente' => 'atendente', 'idCliente' => 'whatever']) }}" method="post">
                                                    @csrf
                                                    <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{ $rd->id }}cancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    </td>
                                    </form>
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
                    <div class="col-12 d-flex justify-content-center">
                        <span>{{ $ready->links() }}</span>
                    </div>
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



