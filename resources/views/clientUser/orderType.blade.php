@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Como deseja pedir?
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Hmmm, como será seu pedido hoje?</h1>
                <hr>
            </div>

            <div class="col-12 mt-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6" style="cursor: pointer;">
                            <a href="{{ route('comboHamburguer') }}">
                                <div class="card">
                                    <img class="card-img-top" src="{{ asset('logo/bg.jpg') }}" style="height: 350px;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Combo</h5>
                                        <p class="card-text">Hambúrguer, porção de batata ou onion rings e bebida.</p>
                                        <a href="#" class="btn btn-primary">Quero este</a>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <a href="{{ route('cardapio', $insert = true) }}">
                                <div class="card" style="">
                                    <img class="card-img-top" src="{{ asset('logo/food.jpg') }}" style="height: 350px" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Pedido avulso</h5>
                                        <p class="card-text">Peça qualquer refeição livremente sem um valor promocional de um combo</p>
                                        <a href="#" class="btn btn-primary">Quero este!</a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg'))
        <script>
            $.toast({
                text: '<b>Seu pedido foi feito e ESTÁ NA ABA PEDIDOS PENDENTES. Você pode escolher novos itens para seu novo pedido.</b>',
                heading: '<b>Atenção aqui!</b>',
                showHideTransition: 'slide',
                bgColor : '38C172',
                position : 'top-right',
                hideAfter: 15000
            })
        </script>
    @endif


    @if(session('msg-cancel'))
        <script>
            $.toast({
                text: '<b>Seu pedido foi cancelado, mas fique à vontade para fazer um novo pedido, ok?</b>',
                heading: '<b>Poxa!</b>',
                showHideTransition: 'slide',
                bgColor : 'red',
                position : 'top-right',
                hideAfter: 15000
            })
        </script>
    @endif

@endsection
