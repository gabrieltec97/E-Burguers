@extends('layouts.extend-client')

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
        <button hidden class="disparo-msg"></button>
    @endif
@endsection
