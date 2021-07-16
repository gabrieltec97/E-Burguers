@extends('layouts.extend-client')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


@section('title')
    Cardápio
@endsection

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
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-3">
                                <form action="{{ route('adicionarItem', $food->id) }}">
                                    @if($food->foodType == 'Hamburguer')
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
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

                                                                    <hr class="mt-4">

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
                                    <li>{{$item->itemName}}</li>
                                @endforeach
                            @endif

                            @if(isset($itemWExtras))
                                    @foreach($itemWExtras as $item2)
                                        <li><span class="text-success">{{$item2}}</span></li>
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
        <button hidden class="disparo-avulso-add"></button>
    @endif
    @endif
@endsection
