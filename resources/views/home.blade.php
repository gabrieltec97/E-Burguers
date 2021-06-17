@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajax-atualizar.js') }}"></script>

@section('title')
    Gestão de pedidos
@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-12">
                @if(session('msg'))
                    <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
                        <strong>Tudo certo!</strong> {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            @if(session('msg-2'))
                <div class="alert alert-danger sumir-feedback alert-dismissible fade show" role="alert">
                    <strong>{{ session('msg-2') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

                <button type="button" class="mudarStatus3" hidden data-toggle="modal" data-target="#exampleModal3"></button>
                <button type="button" class="mudarStatus4" hidden data-toggle="modal" data-target="#exampleModal4"></button>
                <button type="button" class="mudarStatus5" hidden data-toggle="modal" data-target="#exampleModal5"></button>
                <button type="button" class="mudarStatus6" hidden data-toggle="modal" data-target="#exampleModal6"></button>


                <div class="col-lg-6 col-sm-12 mt-3 mt-md-0">
                    <div class="card card-preparo">
                        <div class="card-header font-weight-bold text-muted" style="font-size: 18px; background: linear-gradient(90deg, rgba(248,249,252,1) 36%, rgba(110,231,69,1) 100%);">Em preparo <i class="fas fa-bread-slice ml-1"></i></div>

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
                                                            <form action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'prontoretiradaenvio']) }}" method="post">
                                                                @csrf
                                                                @if($prep->status == 'Em preparo')
                                                                    <i class="fas fa-check-circle text-success pronto-retirar" data-toggle="modal" data-target="#exampleModal{{$prep->id}}" hidden title="Enviar entrega" style="font-size: 25px; cursor: pointer"></i>
                                                                @else
                                                                    <i class="fas fa-check-circle text-success pronto-retirar" data-toggle="modal" data-target="#exampleModal{{$prep->id}}" title="Enviar entrega" style="font-size: 25px; cursor: pointer"></i>
                                                            @endif

                                                            <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal{{$prep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        </div>
                                                        <div class="col-6">
                                                            <i class="far fa-times-circle text-danger ml-2 cancelarPedido"  data-toggle="modal" data-target="#exampleModal{{ $prep->id }}cancela" title="Cancelar pedido" style="font-size: 25px; cursor: pointer"></i>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $prep->id }}cancela" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <form action="{{ route('alterarStatus', ['id' => $prep->id, 'acao' => 'Cancelado']) }}" method="post">
                                                                            @csrf

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-info cancela-mudanca" data-dismiss="modal">Voltar</button>
                                                                            <button type="submit" class="btn btn-primary confirma-mudanca">Confirmar</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                            <b style="color: black">Itens: </b> <span style="color: black">{{ $prep->detached }}</span><br><br>
                                                        @endif

                                                        @if($prep->payingMethod == 'Dinheiro')
                                                            <b style="color: black">Valor total:</b> <span style="color: black"> {{ $prep->totalValue }}</span><br>
                                                            <b style="color: black">Troco para: </b> <span style="color: black">{{ $prep->payingValue }}</span><br>
                                                        @else
                                                            <b style="color: black">Pagamento em cartão:</b> <span style="color: black">{{ $prep->payingMethod }}</span>
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
                                <td align="center" colspan="3">Sem pedidos em preparo.</td>
                            </tr>
                        @endif
                        </div>

                    </tbody>
                    </table>

                    <div class="col-12 offset-1 offset-xl-2">
                        <span>{{ $prepare->links() }}</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-6 mt-4 mt-lg-0 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold text-white" style="font-size: 18px; background: linear-gradient(90deg, rgba(238,8,8,1) 24%, rgba(248,249,252,1) 76%);"><span style="color: black;" class="font-weight-bold">Em rota de envio</span> <i class="fas fa-motorcycle ml-1"></i></div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th>Id do pedido</th>
                            <th>Status do pedido</th>
                            <th>Tratativas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($ready) != 0)
                            @foreach($ready as $rd)
                                <tr>
                                    <td>#{{ $rd->id }}</td>
                                    <td>{{ $rd->status }}</td>
                                    <td>
                                        <div>
                                            <div class="row">
                                                <div class="col-2 mr-2">
                                                    <form action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Pedido Entregue']) }}" method="post">
                                                        @csrf
                                                        <i class="fas fa-user-check text-success finalizar-ok" data-toggle="modal" data-target="#exampleModal{{ $rd->id }}" title="Pedido entregue com sucesso." style="font-size: 25px; cursor: pointer"></i>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{ $rd->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                </div>
                                                <div class="col-6">
                                                    <i class="far fa-times-circle text-danger ml-2 cancelarPedido" data-toggle="modal" data-target="#exampleModal{{ $rd->id }}cancelar" title="Cancelar pedido" style="font-size: 25px; cursor: pointer"></i>

                                                    <form action="{{ route('alterarStatus', ['id' => $rd->id, 'acao' => 'Cancelado']) }}" method="post">
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
                    <div class="col-12 offset-1 offset-xl-2">
                        <span>{{ $ready->links() }}</span>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>


   <div class="container">
       <div class="row">
           <div class="col-lg-12 mt-4 col-sm-12">
               <div class="card card-cadastrados mb-lg-5">
                   <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);"><span class="text-white">Pedidos cadastrados</span></div>

                   <div class="card-body first-table">
                       <table class="table table-bordered table-hover table-responsive-lg">
                           <thead>
                           <tr>
                               <th scope="col">Id</th>
                               <th scope="col">Hora de registro</th>
                               <th scope="col">Status do pedido</th>
                               <th scope="col">Informações</th>
                               <th scope="col">Tratativas</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($registered) != 0)
                               @foreach($registered as $reg)
                                   <tr>
                                       <td>#{{ $reg->id }}</td>
                                       <td>{{ $reg->hour }}</td>
                                       <td>{{ $reg->status }}</td>
                                       <td>
                                           @if($reg->deliverWay == 'Retirada no restaurante')
                                               <b style="color: black">Item a ser retirado no restaurante.</b>
                                           @else
                                           <button class="btn btn-primary" data-toggle="modal" data-target="#modalSend{{$reg->id}}" title="Informações a serem repassadas ao entregador."><i class="fas fa-info-circle mr-1"></i> Informações de entrega</button>
                                           @endif
                                       </td>
                                       <td>
                                           <div>
                                               <div class="row">
                                                   <div class="col-2 mr-2">
                                                       <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Em preparo']) }}" method="post">
                                                           @csrf
                                                           <i class="fas fa-share text-primary enviarPreparo" data-toggle="modal" data-target="#exampleModal{{$reg->id}}" title="Enviar para preparo" style="font-size: 25px; cursor: pointer"></i>

                                                           <!-- Modal -->
                                                           <div class="modal fade" id="exampleModal{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                           <span class="send"></span>
                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <button type="button" class="btn btn-info cancela-mudanca" data-dismiss="modal">Voltar</button>
                                                                           <button type="submit" class="btn btn-primary">Confirmar</button>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </form>
                                                   </div>
                                                   <div class="col-6">
                                                       <i class="far fa-times-circle text-danger ml-2 cancelarPedido" data-toggle="modal" data-target="#exampleModal{{$reg->id}}cancelarr" title="Cancelar pedido" style="font-size: 25px; cursor: pointer"></i>
                                                       <form action="{{ route('alterarStatus', ['id' => $reg->id, 'acao' => 'Cancelado']) }}" method="post">
                                                       @csrf
                                                       <!-- Modal -->
                                                           <div class="modal fade" id="exampleModal{{$reg->id}}cancelarr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                               <b style="color: black">Itens: </b> <span style="color: black">{{ $reg->detached }}</span><br><br>
                                                           @endif

                                                           @if($reg->payingMethod == 'Dinheiro')
                                                               <b style="color: black">Valor total:</b> <span style="color: black"> {{ $reg->totalValue }}</span><br>
                                                               <b style="color: black">Troco para: </b> <span style="color: black">{{ $reg->payingValue }}</span><br>
                                                           @else
                                                           <b style="color: black">Pagamento em cartão:</b> <span style="color: black">{{ $reg->payingMethod }}</span>
                                                           @endif


                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </tr>
                                   </form>
                   </div>
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
       </div>
   </div>
    </div>
    </div>
       </div>
   </div>

    <button id="mydialog3" hidden></button>

<script>

    $("#mydialog3").on("click", function(e){
        e.preventDefault();

        bs4pop.notice('<i class="fas fa-concierge-bell mr-2"></i><b>Novo pedido registrado.</b>', {
            type: 'success',
            position: 'topright',
            appendType: 'append',
            closeBtn: 'false',
            className: ''
        })
    })
</script>

<select class="count" hidden>
    <option value="{{ count($registered) }}"></option>
</select>

<input class="status-ref" hidden value="@foreach($prepare as $prepa)
{{ $prepa->status }}
@endforeach"
>
@endsection



