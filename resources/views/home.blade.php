@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajax-atualizar.js') }}"></script>

@section('title')
    Gestão de pedidos
@endsection

@section('content')

<div class="container">
    @if(session('msg'))
        <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
            <strong>Tudo certo!</strong> {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
        <button type="button" class="mudarStatus3" hidden data-toggle="modal" data-target="#exampleModal3"></button>
        <button type="button" class="mudarStatus4" hidden data-toggle="modal" data-target="#exampleModal4"></button>
        <button type="button" class="mudarStatus5" hidden data-toggle="modal" data-target="#exampleModal5"></button>
        <button type="button" class="mudarStatus6" hidden data-toggle="modal" data-target="#exampleModal6"></button>
        <div class="col-lg-8 col-sm-12">
            <div class="card card-cadastrados">
                <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedidos cadastrados</div>

                <div class="card-body first-table">
                    <table class="table table-bordered table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Hora de registro</th>
                            <th scope="col">Status do pedido</th>
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
                                    </form>
                </div>
            </div>
        </div>

        </tr>
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

        <div class="col-lg-4 col-sm-12 mt-3 mt-md-0">
            <div class="card card-preparo">
                <div class="card-header font-weight-bold text-muted bg-warning" style="font-size: 18px">Em preparo <i class="fas fa-bread-slice ml-1"></i></div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id do pedido</th>
                            <th scope="col">Status do pedido</th>
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
                                               </div>
                                                   </td>
                               </tr>
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

        <div class="col-lg-4 col-sm-12 offset-md-8 offset-sm-0 rota-envio">
            <div class="card third-table">
                <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 18px">Em rota de envio <i class="fas fa-motorcycle ml-1"></i></div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id do pedido</th>
                            <th scope="col">Status do pedido</th>
                            <th scope="col">Tratativas</th>
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
                        <td align="center" colspan="3">Sem pedidos à serem entregues</td>
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



