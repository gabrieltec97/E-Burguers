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
                                <tbody class="dados-tab">
                                <td colspan='4'>
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-center">
                                            <span class="spinner-border text-primary mt-5 mb-3"></span>
                                        </div>

                                        <div class="text-center">
                                            <span class="text-center font-weight-bold text-primary">Carregando informações...</span>
                                        </div>
                                    </div>
                                </td>
                                </tbody>
                            </table>
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
    <button hidden class="disparo-ok-one"></button>
@endif
@endif


@endsection
