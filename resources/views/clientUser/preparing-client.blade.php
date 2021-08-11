@extends('layouts.extend-client')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/cliente-acompanhar-ajax.js') }}"></script>

@if(!isset($order))
    <script src="{{ asset('js/sendNotification.js') }}"></script>
@endif

@section('title')
    Em preparo
@endsection

@section('content')
<div class="container-fluid mt-5">
   <div class="row">

       @if(isset($order))
        @if(count($order) == 1)
               <div class="col-12 col-md-6 mt-md-5 mt-lg-0 col-lg-5">
                   <img src="{{ asset('logo/undraw_Chef_cu0r.svg') }}" class="img-preparing img-fluid">
               </div>

               <div class="col-12 col-md-6 mt-3 mt-lg-0 col-lg-4">
                   <div class="card card-preparing mb-5">
                       <div class="card-header bg-primary text-center text-muted font-weight-bold">
                           <span class="text-white">Hmmm.. Já recebemos seu pedido!</span>
                       </div>
                       <ul class="list-group list-group-flush ul-pedidos">
                           <li class="list-group-item text-muted font-weight-bold et1"><i class="fas fa-check mr-1"></i> Pedido registrado</li>
                           <li class="list-group-item font-weight-bold text-secondary et2"><i class="fas fa-spinner mr-2"></i>Em preparo</li>
                           <li class="list-group-item font-weight-bold text-secondary preparing" hidden>
                               <div class="spinner-border spinner-border-sm mr-1" style="font-size: 15px;" role="status">
                               </div>
                               Em preparo</li>
                           <li class="list-group-item font-weight-bold text-secondary et3"><i class="fas fa-motorcycle mr-2"></i>Saiu para entrega</li>
                           <li class="list-group-item font-weight-bold text-secondary et5"><i class="fas fa-check-circle mr-2"></i>Pronto para retirar no restaurante</li>
                           <li class="list-group-item font-weight-bold text-secondary li-cancelamento">
                               <button class="btn btn-danger float-right font-weight-bold cancelarPedido" data-toggle="modal" data-target="#modalCancelamento">Cancelar pedido</button>
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
               <div class="col-12 col-md-6 mt-md-5 mt-lg-0 col-lg-5">
                   <img src="{{ asset('logo/undraw_Mobile_pay_re_sjb8.svg') }}" class="img-no-food img-fluid">
                   <h1 class="text-center mt-5 titulo-cardapio">Você tem mais de um pedido em andamento.</h1>
               </div>

               <div class="col-12 col-md-6 mt-3 mt-lg-0 col-lg-4">
                   <div class="card card-preparing mb-5">
                       <div class="card-header bg-primary text-muted font-weight-bold">
                           <span class="text-white">Acompanhe o andamento dos seus pedidos!</span>
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
                                <hr class="hr-cancelamentos">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger mb-2 mr-2 btn-cancelamentos" data-toggle="modal" data-target="#modalCancelamento">Cancelamento de pedidos</button>
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
            @endif
       @else
           <div class="col-12 mt-md-5 mt-lg-0">
               <img src="{{ asset('logo/undraw_Chef_cu0r.svg') }}" class="img-no-food img-fluid">
               <h1 class="text-center mt-5 titulo-cardapio">Poxa, você não tem pedidos em andamento.</h1>
           </div>
       @endif
   </div>
</div>

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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Atenção!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(count($order) == 1)
                    <p class="font-weight-bold">O pedido {{$order[0]->id}} será cancelado e não poderá ser alterado novamente. Deseja prosseguir?</p>

                    <form action="{{ route('clienteAlteraStatus', ['id' => $order[0]->id, 'acao' => 'Cancelado', 'remetente' => 'cliente', 'idCliente' => $idUser]) }}" method="post">
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">Cancelar pedido</button>
                </div>
                </form>
                @elseif(count($order) > 1)
                    <p class="font-weight-bold">Escolha qual pedido será cancelado.</p>

                    @csrf
                        <div class="container">
                            <div class="row">
                                @foreach($order as $ord)
                                    <div class="col-6 my-2">
                                        #{{ $ord->id }} - {{ $ord->hour }} - {{ $ord->totalValue }}
                                    </div>

                                    <div class="col-6 d-flex justify-content-end my-2">
                                        <form action="{{ route('clienteAlteraStatus', ['id' => $ord->id, 'acao' => 'Cancelado', 'remetente' => 'cliente', 'idCliente' => $idUser]) }}" method="post">
                                            @csrf
                                        <button type="submit" class="btn btn-danger">Cancelar</button> <br>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                        </div>
            <div class="modal-footer" style="margin-bottom: -22px">
                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Fechar</button>
            </div>
                @endif
            </div>
        </div>
    </div>
@endif

@if(session('msg-cancel'))
    <script>
        $.toast({
            text: '<b>O pedido foi cancelado. Agora você pode acompanhar seus pedidos atuais por aqui.</b>',
            heading: '<b>Poxa!</b>',
            showHideTransition: 'slide',
            bgColor : 'red',
            position : 'top-right',
            hideAfter: 15000
        })
    </script>
@endif

@if(session('duplicated'))
    <script>
        console.log('duplicdo');
    </script>
@endif



@endsection
