@extends('layouts.extend-client')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/cliente-acompanhar-ajax.js') }}"></script>

@section('title')
    Em preparo
@endsection

@section('content')
<div class="container-fluid mt-5">
   <div class="row">
       @if(isset($order))
        @if(count($order) == 1)

            <div class="col-12 col-lg-5 mt-lg-4 mt-2 mb-4 d-flex justify-content-center">
                <img src="{{ asset('logo/cook.svg') }}" class="prep-image">
            </div>

               <div class="col-12 col-lg-7 mt-lg-5">
                   <div class="card card-preparing mb-5">
                       <div class="card-header bg-dark text-center text-muted font-weight-bold">
                           <span class="text-white">Hmmm.. Já recebemos seu pedido!</span>
                       </div>
                       <ul class="list-group list-group-flush ul-pedidos">
                           <li class="list-group-item font-weight-bold et1" style="color: black"><i class="fas fa-check mr-1 text-success"></i> Pedido registrado</li>
                           <li class="list-group-item font-weight-bold text-secondary et2"><i class="fas fa-spinner mr-2 iet2"></i> <i class="fas fa-check mr-1 text-success iet2ready" hidden></i> Em preparo</li>
                           <li class="list-group-item font-weight-bold preparing" style="color: black" hidden>
                               <div class="spinner-border spinner-border-sm mr-1 text-success" style="font-size: 15px;" role="status">
                               </div>
                               Em preparo</li>
                           <li class="list-group-item font-weight-bold text-secondary et3"><i class="fas fa-motorcycle mr-2 iet3"></i> <i class="fas fa-check mr-1 text-success iet2ready" hidden></i> Saiu para entrega</li>
                           <li class="list-group-item font-weight-bold text-secondary et5"><i class="fas fa-check-circle mr-2 iet5"></i>Pronto para retirar no restaurante</li>
                           <li class="list-group-item font-weight-bold text-secondary li-cancelamento">
                               <button class="btn btn-danger float-left font-weight-bold cancelarPedido" data-toggle="modal" data-target="#modalCancelamento">Cancelar pedido</button>
                           </li>
                       </ul>

                       <div class="verifica-pedido">
                           <td colspan='4'>
                               <div class="container-fluid">
                                   <div class="d-flex justify-content-center">
                                       <span class="spinner-border text-danger mt-5 mb-3"></span>
                                   </div>

                                   <div class="text-center mb-2">
                                       <span class="text-center font-weight-bold text-primary">Carregando informações...</span>
                                   </div>
                               </div>
                           </td>
                       </div>
                   </div>
               </div>

           @elseif(count($order) > 1)
               <div class="col-12 col-lg-5 mt-lg-2 mb-2 d-flex justify-content-center">
                   <img src="{{ asset('logo/cook.svg') }}" class="prep-image">
               </div>

               <div class="col-12 col-md-6 mt-lg-5 col-lg-7">
                   <div class="card card-preparing mb-5">
                       <div class="card-header bg-primary text-muted font-weight-bold">
                           <span class="text-white">Acompanhe o andamento dos seus pedidos</span>
                       </div>

                       <div>
                            <div class="card">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Número do pedido</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Status atual</th>
                                    </tr>
                                </thead>
                                <tbody class="dados-tab" style="margin-bottom: -15px">
                                <td colspan='4'>
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-center">
                                            <span class="spinner-border text-primary mt-5"></span>
                                        </div>

                                        <div class="text-center">
                                            <span class="text-center font-weight-bold text-primary">Carregando informações...</span>
                                        </div>

                                    </div>
                                </td>
                                </tbody>
                            </table>

                                @if($order[0]->deliverWay == 'Entrega em domicílio' && $order[0]->status != 'Em rota de entrega')
                                <hr class="hr-cancelamentos" style="margin-top: -5px;">
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary mb-2 ml-2 btn-cancelamentos" data-toggle="modal" data-target="#modalCancelamento">Detalhes dos pedidos</button>
                                </div>
                                @elseif($order[0]->deliverWay == 'Retirada no restaurante' && $order[0]->status != 'Pronto para ser retirado no restaurante')
                                    <hr class="hr-cancelamentos" style="margin-top: -5px;">
                                    <div class="d-flex justify-content-start">
                                        <button class="btn btn-primary mb-2 ml-2 btn-cancelamentos" data-toggle="modal" data-target="#modalCancelamento">Detalhes dos pedidos</button>
                                    </div>
                                @endif
                            </div>
                       </div>
                   </div>
               </div>
            @endif
       @else
           <div class="col-12 mt-3 d-flex justify-content-center">
               <img src="{{ asset('logo/undraw_Chef_cu0r.svg') }}" class="img-no-food">
           </div>

           <div class="col-12 mt-2">
               <h1 class="text-center mt-5 titulo-cardapio">Poxa, você não tem pedidos em andamento.
                   <br><a href="/E-Pedidos/public/cardapio/1" class="btn btn-success mt-2"><i class="fas fa-utensils mr-2"></i>Ir ao cardápio</a></h1>
           </div>
       @endif
   </div>
</div>
@if(isset($order))
<div class="col-12 d-flex justify-content-end">
    <div class="footertake">
        <div class="page-wrapper" hidden>
            <div class="circle-wrapper">
                <div class="success circle"></div>
                <div class="icon">
                    <img src="{{ asset('logo/alertas.png') }}" class="takeNow" id="takeThere" data-toggle="modal" data-target="#{{ count($order) > 1 ? 'modalCancelamento' : 'exampleModalCenter'}}" style="cursor: pointer;" hidden>
                    <img src="{{ asset('logo/motorcycle.png') }}" class="takeNow" id="delivery" data-toggle="modal" data-target="#{{ count($order) > 1 ? 'modalCancelamento' : 'exampleModalCenter'}}" style="cursor: pointer;" hidden>
                </div>
            </div>
    </div>
@endif
       @if(isset($order))
            @if(count($order) <= 1)
                <div class="col-12 d-flex justify-content-end">
                    <div class="footerinfo">
                        <span class="badge badge-dark footer-info" style="cursor:pointer;" data-toggle="modal" data-target="#modalDeItens">Informações <br>do pedido</span>
                        <img src="{{ asset('logo/informacoes.png') }}" style="width: 60px; height: 60px; cursor: pointer" title="Informações do pedido" class="footer-info" data-toggle="modal" data-target="#exampleModalCenter">
                    </div>
                </div>
            @endif
       @endif
</div>


@if(isset($order))

    <?php
    $count = strlen($order[0]->totalValue);

    if ($count == 4 && $order[0]->totalValue > 10){
        $price = $order[0]->totalValue . '0';
    }elseif ($count == 2){
        $price = $order[0]->totalValue. '.' . '00';
    }
    else{
        $price = $order[0]->totalValue;
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Informações do pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 rotaEntrega" hidden>
                                <img src="{{ asset('logo/undraw_Mobile_pay_re_sjb8.svg') }}" style="width: 100px; height: 100px">
                            </div>

                            <div class="col-9 rotaEntrega" hidden>
                                <h4 class="text-center font-weight-bold title-take"></h4>
                                <span class="message-take"></span>
                            </div>

                            <div class="col-12 rotaEntrega" hidden>
                                <hr>
                            </div>

                            <div class="col-12 mt-1">
                                <span style="font-size: 15px; font-weight: bold">Pedido nº:</span><span> #{{ $order[0]->id }}</span> <br>
                                <span style="font-size: 15px; font-weight: bold">Itens:</span><span> {{ $order[0]->detached }}</span> <br>
                                <span style="font-size: 15px; font-weight: bold">Método de pagamento:</span><span> {{ $order[0]->payingMethod }}</span><br>
                                <span style="font-size: 15px; font-weight: bold">Forma de entrega:</span><span> {{ $order[0]->deliverWay }}</span><br>
                                <span style="font-size: 15px; font-weight: bold">Data:</span><span> {{ $order[0]->day }} - {{ $order[0]->hour }}</span><br>
                                <span style="font-size: 15px; font-weight: bold">Valor: R$ </span><span class="text-primary"> {{ $price }}</span><br>
                                @if($order[0]->deliverWay != 'Retirada no restaurante')
                                    <span style="font-size: 15px; font-weight: bold">Entregar em:</span> <span> {{ $order[0]->address }} - {{ $order[0]->district }}</span><br>
                                @endif
                                @if($order[0]->comments != null)
                                    <span style="font-size: 15px; font-weight: bold">Comentários:</span> <span> {{ $order[0]->comments }}</span><br>
                                @endif
                                @if($order[0]->usedCoupon != null)
                                    <span style="font-size: 15px; font-weight: bold">Cupom:</span> <span> {{ $order[0]->usedCoupon }}</span><br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success routegps" style="color: white; font-size: 15px" hidden>Abrir rota no GPS</button>
                    <button type="button" class="btn btn-success closedelivery" data-dismiss="modal" style="color: white; font-size: 15px" hidden>Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endif

    @if(isset($order))
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Detalhes do pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset('logo/undraw_Chef_cu0r.svg') }}" style="width: 100px; height: 100px" alt="">
                            </div>

                            <div class="col-9">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(isset($orderStatus))
    <input type="text" class="status" hidden value="{{ $orderStatus }}">
    <input type="text" class="deliverWay" hidden value="{{ $orderDeliver }}">
@endif



@if(isset($order))
@if(count($order) >= 2)
    <button hidden class="disparo-ok"></button>
@elseif(count($order) == 1)
    @if(session('msg-cancel') == false)
    <button hidden class="disparo-ok-one"></button>
@endif
@endif
@endif

@if(isset($order))
    <!-- Modal -->
    <div class="modal fade" id="modalCancelamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white;">Detalhes dos pedidos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(count($order) == 1)
                    <p style="font-size: 16px">O pedido <span class="text-primary font-weight-bold">{{$order[0]->id}}</span> será cancelado e não poderá ser alterado novamente. Deseja prosseguir?</p>

                    <form action="{{ route('clienteAlteraStatus', ['id' => $order[0]->id, 'acao' => 'Cancelado', 'remetente' => 'cliente', 'idCliente' => $idUser]) }}" method="post">
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger font-weight-bold cancelar-pedido">Cancelar pedido</button>
                </div>
                </form>
                @elseif(count($order) > 1)

                    @csrf
                        <div class="container">
                            <div class="row">
                                @foreach($order as $ord)

                                    <?php
                                    $count = strlen($ord->totalValue);

                                    if ($count == 4 && $ord->totalValue > 10){
                                        $price = $ord->totalValue . '0';
                                    }elseif ($count == 2){
                                        $price = $ord->totalValue. '.' . '00';
                                    }
                                    else{
                                        $price = $ord->totalValue;
                                    }
                                    ?>


                                    <div class="col-12 col-alot">
                                        <span class="text-danger" style="font-size: 15px; font-weight: bold">Pedido nº: #{{ $ord->id }}</span><span> - {{ $ord->day }} - {{ $ord->hour }} - <span class="text-primary">R$ {{ $price}}</span></span><br>
                                        <span style="font-size: 15px; font-weight: bold">Itens:</span> <span> {{ $ord->detached }}</span><br>
                                        <span style="font-size: 15px; font-weight: bold">Forma de entrega:</span> <span> {{ $ord->deliverWay }}</span><br>
                                        @if($ord->deliverWay != 'Retirada no restaurante')
                                            <span style="font-size: 15px; font-weight: bold">Entregar em:</span> {{ $order[0]->address }}, {{ $order[0]->district }}</span><br>
                                        @endif
                                    </div>

                                    @if($order[0]->deliverWay == 'Entrega em domicílio' && $order[0]->status != 'Em rota de entrega')
                                    <div class="col-12 d-flex justify-content-start my-2">
                                            <form action="{{ route('clienteAlteraStatus', ['id' => $ord->id, 'acao' => 'Cancelado', 'remetente' => 'cliente', 'idCliente' => $idUser]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger cancel-alot">Cancelar</button> <br>
                                            </form>
                                    </div>
                                    @elseif($order[0]->deliverWay == 'Retirada no restaurante' && $order[0]->status != 'Pronto para ser retirado no restaurante')
                                        <div class="col-12 d-flex justify-content-start my-2">
                                            <form action="{{ route('clienteAlteraStatus', ['id' => $ord->id, 'acao' => 'Cancelado', 'remetente' => 'cliente', 'idCliente' => $idUser]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger cancel-alot">Cancelar</button> <br>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="col-12" style="margin-top: -10px">
                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endif

@if(session('msg-cancel'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 12000,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'warning',
            title: 'Pedido cancelado. Acompanhe seus pedidos atuais nesta tela.'
        })

    </script>
@endif



@if(session('duplicated'))
    <script>
        console.log('duplicdo');
    </script>
@endif


@if(session('msg-cancel'))
@else
    @if(isset($order))
        @if(count($order) == 1)
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pedido cadastrado!',
                    text: 'Agora basta acompanhar o andamento por aqui. A tela será atualizada automaticamente.',
                    timer: 15000,
                    timerProgressBar: true
                })
            </script>
        @else
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pedidos cadastrados!',
                    text: 'Agora basta acompanhar o andamento por aqui. A tela será atualizada automaticamente.',
                    timer: 15000,
                    timerProgressBar: true
                })
            </script>
        @endif
    @endif
    @endif
@endsection
