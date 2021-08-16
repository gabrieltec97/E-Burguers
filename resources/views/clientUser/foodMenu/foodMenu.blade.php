@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Cardápio
@endsection

<?php

?>

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Preparamos um cardápio especial para você!</h1>
                <hr>
            </div>

            @if(isset($tray))
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                </div>
            @endif
            <div class="col-12 col-md-9">
                <div class="container-fluid">
                    @livewire('detached-tray')
                </div>
            </div>

            <div class="col-3">
                <div class="card fixo">
                    <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 22px;"><i class="fas fa-shopping-cart carrinho text-white mr-2"></i> Seu pedido está assim</div>

                    <div class="card-body">
                        @livewire('live-detached-tray')
                    </div>
            </div>
        </div>
    </div>

    @if(isset($insert))
        @if($insert == 'added')

        @if(session('msg'))
         <script>
            $.toast({
                text: '<b>Item removido do pedido!</b>',
                heading: '<b>Poxa!</b>',
                showHideTransition: 'slide',
                bgColor : 'red',
                position : 'top-right',
                hideAfter: 5000
            })
         </script>
    @else
    <script>
        $.toast({
            text: '<b>Item adicionado ao pedido!</b>',
            heading: '<b>Legal!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 5000
        })
    </script>
        @endif
        @endif
    @endif
@endsection
