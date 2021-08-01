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
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-4">
                                <form action="{{ route('adicionarItem', $food->id) }}">
                                    @if($food->foodType == 'Hamburguer')
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star-half text-warning"></i>

                                                <p class="card-text"> {{ $food->description }}
                                                    <br><br>
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span></p>
                                                <a class="btn btn-primary adicionar-bandeja text-white" data-toggle="modal" data-target="#multiCollapseExample{{$food->id}}">Personalizar</a>
                                                <button type="submit" class="btn btn-success adicionar-bandeja text-white">Adicionar à bandeja</button>

                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="multiCollapseExample{{$food->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Personalização de item</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <img class="card-img-top" src="{{ asset($food->picture) }}">
                                                                    </div>

                                                                    <div class="col-6">
                                                                        @foreach(explode(',', $food->ingredients) as $ing)
                                                                            <div>
                                                                                <input class="ml-1 form-check-input" type="checkbox" id="ing" name="ingredients[]" value="{{ $ing }}" checked>
                                                                                <span class="text-muted ml-4 form-check-label font-weight-bold">{{ $ing }}</span>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>

                                                                    @if($food->ratingAmount == 1)
                                                                        <p>{{ $food->ratingAmount }} avaliação</p>
                                                                    @elseif($food->ratingAmount > 1)
                                                                        <p>{{ $food->ratingAmount }} avaliação</p>
                                                                    @endif

                                                                    @if($food->extras != null)
                                                                    <div class="col-12">
                                                                        <hr class="mt-4">
                                                                    </div>
                                                                    @endif

                                                                    <div class="col-12">
                                                                        @if($food->extras != null)
                                                                            @foreach($food->extras as $e)
                                                                                <div>
                                                                                    <input class="ml-1 form-check-input" type="checkbox" id="{{ $e }}" name="extras[]" value="{{ $e }}">
                                                                                    <label for="{{ $e }}" class="ml-4 form-check-label font-weight-bold">{{ $e }}</label>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger mt-1" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" style="margin-top: 2px;" class="btn btn-success adicionar-bandeja text-white">Adicionar à bandeja</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <article>
                                        <div class="card cardapio-card mb-4">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
                                                @if($food->foodType == 'Bebida')
                                                    @if($food->tastes != '')
                                                        <select name="sabor" class="mb-3" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                                            @foreach(explode(',', $food->tastes) as $taste)
                                                                <option value="{{ $taste }}">{{ $taste }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                @endif
                                                <p class="card-text"> {{ $food->description }}</p>
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span><br>
                                                <button type="submit" class="btn btn-success adicionar-bandeja">Adicionar à bandeja</button>
                                            </div>
                                        </div>
                                    </article>
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card fixo">
                    <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 22px;"><i class="fas fa-shopping-cart carrinho text-white mr-2"></i> Seu pedido está assim</div>

                    <div class="card-body">
                        <ol>
                            @if(isset($items))
                                @foreach($items as $item)
                                    <form action="{{ route('removerItem', ['id' => $item->id])}}" method="post">
                                        @csrf
                                    <li>{{$item->itemName}} <button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></li>

                                    </form>
                                @endforeach
                            @endif

                            @if(isset($itemWExtras))
                                    @foreach($itemWExtras as $item2)
                                        <form action="{{ route('removerPersonalizado', $item2['id']) }}" method="post">
                                            @csrf
                                        <li><span class="text-success">{{$item2['name']}}<button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></span></li>
                                        </form>
                                    @endforeach
                            @endif
                        </ol>

                        @if(isset($val))
                            <span class="float-right">Valor atual: <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
                        @else
                            bandeja vazia, escolhe aí..
                        @endif
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
