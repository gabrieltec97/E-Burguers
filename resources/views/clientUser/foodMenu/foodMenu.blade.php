@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

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

            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-weight-bold text-primary complete-all" style="cursor: pointer" onclick="completeAll()">Cardápio completo</li>
                        <li class="breadcrumb-item just-pizzas" style="cursor: pointer" onclick="justPizzas()">Apenas Pizzas</li>
                        <li class="breadcrumb-item just-drinks" style="cursor: pointer" onclick="justDrinks()">Apenas Bebidas</li>
                        <li class="breadcrumb-item just-desserts" style="cursor: pointer" onclick="justDesserts()">Apenas Sobremesas</li>
                    </ol>
                </nav>
            </div>

            @if(isset($tray))
                @if(isset($val) && $val[0]['totalValue'] > 0)
                <div class="col-12 d-flex justify-content-center mb-3 mb-sm-0">
                    <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                </div>
                @endif
            @endif
            <div class="col-12 col-lg-9">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 mt-lg-3 col-lg-4 div-food" id="addTray{{ $food->id }}">
                            <form action="{{ route('adicionarItem', $food->id) }}">

                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="text-white">{{ $food->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img class="card-img-top img-item" src="{{ asset($food->picture) }}">
                                                </div>

                                                <div class="col-8">
                                                    <span class="fooddesc">{{ $food->description }}</span>
                                                </div>

                                                <div class="col-6 starsrate">
                                                    @if($rate != "Não")
                                                        @if($food->finalGrade == 1)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade > 1 && $food->finalGrade < 2)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star-half text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade == 2)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade > 2 && $food->finalGrade < 3)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star-half text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade == 3)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade > 3 && $food->finalGrade < 4)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star-half text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade == 4)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="far fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade > 4 && $food->finalGrade < 5)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star-half text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @elseif($food->finalGrade == 5)
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                            <i class="fas fa-star text-warning" title="{{$food->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="col-12">
                                                    @if($food->foodType == 'Bebida')
                                                        @if($food->tastes != '')
                                                            <select name="sabor" class="mb-1 form-control select-sabor" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                                                @foreach(explode(',', $food->tastes) as $taste)
                                                                    <option value="{{ $taste }}">{{ $taste }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="col-12">
                                                    @if($deliveryStatus[0]->status != 'Fechado')
                                                        @if($food->status == 'Ativo')
                                                            @if($food->foodType == 'Pizza')
                                                            <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                            <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addTray" value="addTray{{ $food->id }}">Adicionar à bandeja</button>
                                                            @else
                                                                <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addTray" value="addTray{{ $food->id }}">Adicionar à bandeja</button>
                                                            @endif

                                                        @else
                                                            <label class="text-danger font-weight-bold mt-2" style="margin-left: -20px">Este item está temporariamente indisponível.</label>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        @endforeach

                            @foreach($pizzas as $pizza)
                                <div class="col-12 mt-lg-3 col-lg-4 div-pizzas" id="addPizza{{ $pizza->id }}">
                                    <form action="{{ route('adicionarItem', $pizza->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $pizza->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $pizza->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($pizza->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $pizza->description }}</span>
                                                        </div>

                                                        <div class="col-6 starsrate">
                                                            @if($rate != "Não")
                                                                @if($pizza->finalGrade == 1)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade > 1 && $pizza->finalGrade < 2)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade == 2)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade > 2 && $pizza->finalGrade < 3)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade == 3)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade > 3 && $pizza->finalGrade < 4)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade == 4)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade > 4 && $pizza->finalGrade < 5)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($pizza->finalGrade == 5)
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$pizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($pizza->status == 'Ativo')
                                                                    @if($pizza->foodType == 'Pizza')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addPizza" value="addPizza{{ $pizza->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addPizza" value="addPizza{{ $pizza->id }}">Adicionar à bandeja</button>
                                                                    @endif

                                                                @else
                                                                    <label class="text-danger font-weight-bold mt-2" style="margin-left: -20px">Este item está temporariamente indisponível.</label>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach

                            @foreach($drinks as $drink)
                                <div class="col-12 mt-lg-3 col-lg-4 div-drinks" id="addDrink{{ $drink->id }}">
                                    <form action="{{ route('adicionarItem', $drink->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $drink->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $drink->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($drink->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $drink->description }}</span>
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($drink->status == 'Ativo')
                                                                    @if($drink->foodType == 'Bebida')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addDrink" value="addDrink{{ $drink->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addDrink" value="addDrink{{ $drink->id }}">Adicionar à bandeja</button>
                                                                    @endif

                                                                @else
                                                                    <label class="text-danger font-weight-bold mt-2" style="margin-left: -20px">Este item está temporariamente indisponível.</label>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach

                        @if($drinks == null)
                            <div class="col-12 d-flex justify-content-center">
                                <h3>Sem bebidas cadastradas</h3>
                            </div>
                        @endif

                            @foreach($desserts as $dessert)
                                <div class="col-12 mt-lg-3 col-lg-4 div-desserts" id="addDessert{{ $dessert->id }}">
                                    <form action="{{ route('adicionarItem', $dessert->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $dessert->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $dessert->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($dessert->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $dessert->description }}</span>
                                                        </div>

                                                        <div class="col-6 starsrate">
                                                            @if($rate != "Não")
                                                                @if($dessert->finalGrade == 1)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade > 1 && $dessert->finalGrade < 2)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade == 2)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade > 2 && $dessert->finalGrade < 3)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade == 3)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade > 3 && $dessert->finalGrade < 4)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade == 4)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade > 4 && $dessert->finalGrade < 5)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($dessert->finalGrade == 5)
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$dessert->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($dessert->status == 'Ativo')
                                                                    @if($dessert->foodType == 'Sobremesa')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addDessert" value="addDessert{{ $dessert->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addDessert" value="addDessert{{ $dessert->id }}">Adicionar à bandeja</button>
                                                                    @endif

                                                                @else
                                                                    <label class="text-danger font-weight-bold mt-2" style="margin-left: -20px">Este item está temporariamente indisponível.</label>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach

                            @if($desserts == null)
                                <div class="col-12 d-flex justify-content-center">
                                    <h3 class="d-none no-desserts">Sem sobremesas cadastradas</h3>
                                </div>
                            @endif
                    </div>


                </div>
            </div>

            <?php
            if (isset($val)){
                $count = strlen($val[0]['totalValue']);

                if ($count == 4 && $val[0]['totalValue'] > 10){
                    $price = $val[0]['totalValue'] . '0';
                }elseif ($count == 2){
                    $price = $val[0]['totalValue']. '.' . '00';
                }
                else{
                    $price = $val[0]['totalValue'];
                }
            }else{
                $price = 0;
            }
            ?>

            <div class="col-3">
                <div class="card fixo">
                    <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 22px;"><i class="fas fa-shopping-cart carrinho text-white mr-2"></i> {{ $deliveryStatus[0]->status == 'Fechado' ? 'Delivery fechado :(' : 'Seu pedido está assim'}}</div>

                    <div class="card-body">
                        @if($deliveryStatus[0]->status == 'Fechado')
                            inserir imagem de delivery fechado
                        @else
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

                        @if(isset($val) && $val[0]['totalValue'] > 0)
                            <hr>
                                @if(count($coupons) > 0)
                                <div class="col-12 mb-2">
                                    <img src="{{ asset('logo/cupom.png') }}" style="width: 17px; height: 17px; margin-bottom: 5px" alt="">
                                    <a href="{{ route('meusCupons') }}" style="text-decoration: none;">Você pode inserir um cupom (Ver)</a>
                                </div>
                                @endif
                            <div>
                                <span class="float-right">Valor atual: <span class="text-success">{{ $price }}</span></span>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Pagamento</a>
                            </div>

                        @else
                            <div class="col-12 d-flex justify-content-center">
                                <img src="{{ asset('logo/pizza.png') }}" style="width: 100px; height: 100px;">
                            </div>

                            <div class="col-12 mt-4 d-flex justify-content-center" style="margin-bottom: -15px">
                                <h5>Bandeja vazia no momento</h5>
                            </div>
                        @endif
                        @endif
                    </div>
            </div>
        </div>

            <div class="modal fade" id="modalDeItens" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Meus itens da bandeja.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">

                            @if($deliveryStatus[0]->status == 'Fechado')
                                    inserir imagem de delivery fechado
                                @else
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

                                    @if(isset($val) && $val[0]['totalValue'] > 0)
                                        <hr>
                                        <div>
                                            <span class="float-right">Valor atual: R$ <span class="text-success">{{ $price }}</span></span>
                                        </div>

                                        <div class="mt-3">
                                            <a href="{{ route('fimCompra') }}" class="btn btn-primary"><i class="fas fa-dollar-sign mr-2"></i>Ir para Pagamento</a>
                                        </div>

                                    @else
                                        <div class="col-12 d-flex justify-content-center">
                                            <img src="{{ asset('logo/pizza.png') }}" style="width: 100px; height: 100px;">
                                        </div>

                                        <div class="col-12 mt-4 d-flex justify-content-center" style="margin-bottom: -15px">
                                            <h5>Bandeja vazia no momento</h5>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        @if(count($coupons) > 0)
                            <div class="col-12 mb-2 ml-3">
                                <img src="{{ asset('logo/cupom.png') }}" style="width: 17px; height: 17px; margin-bottom: 5px" alt="">
                                <a href="{{ route('meusCupons') }}" style="text-decoration: none;">Você pode inserir um cupom (Ver cupom)</a>
                            </div>
                        @endif

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <div class="footertray">
                    <span class="badge badge-success" style="cursor:pointer;" data-toggle="modal" data-target="#modalDeItens">R$ {{ $price }} <br> <?= $price  ? 'Pagar agora' : '' ?></span>
                    <img src="{{ asset('logo/bandeja-de-comida.png') }}" style="width: 60px; height: 60px; cursor: pointer" title="Minha bandeja" data-toggle="modal" data-target="#modalDeItens">
                </div>
            </div>

    </div>


    @if(isset($insert))
        @if($insert == 'added')

        @if(session('msg'))
         <script>
             const Toast = Swal.mixin({
                 toast: true,
                 position: 'top-end',
                 showConfirmButton: false,
                 timer: 5000,
                 timerProgressBar: true,
             });

             Toast.fire({
                 icon: 'error',
                 title: 'Item removido do pedido!'
             })
         </script>
    @else
       @if(session('msg-dstv'))
           <script>
               const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 12000,
                   timerProgressBar: true,
               })

               Toast.fire({
                   icon: 'error',
                   title: 'Desculpe, mas o item {{ session('msg-dstv') }} não está mais disponível.'
               })
           </script>
       @else

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'success',
            title: 'Item adicionado ao pedido!'
        })
    </script>
        @endif
        @endif
        @endif
    @endif

        @if(session('msg-dstv'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 8000,
                    timerProgressBar: true,
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Desculpe, mas o item {{ session('msg-dstv') }} não está mais disponível.'
                })
            </script>
        @endif

    <script>
        function justPizzas(){
            $(".div-food, .div-drinks, .div-desserts").hide('slow');
            setTimeout(function (){
                $(".div-pizzas").show('slow');
            },700);

            $(".just-pizzas").addClass('font-weight-bold');
            $(".just-pizzas").addClass('text-primary');
            $(".complete-all").removeClass('font-weight-bold');
            $(".complete-all").removeClass('text-primary');
            $(".just-drinks").removeClass('font-weight-bold');
            $(".just-drinks").removeClass('text-primary');
            $(".just-desserts").removeClass('font-weight-bold');
            $(".just-desserts").removeClass('text-primary');
        }

        function justDrinks(){
            $(".div-food, .div-pizzas, .div-desserts").hide('slow');
            setTimeout(function (){
                $(".div-drinks").show('slow');
            },700);

            $(".just-drinks").addClass('font-weight-bold');
            $(".just-drinks").addClass('text-primary');
            $(".complete-all").removeClass('font-weight-bold');
            $(".complete-all").removeClass('text-primary');
            $(".just-pizzas").removeClass('font-weight-bold');
            $(".just-pizzas").removeClass('text-primary');
            $(".just-desserts").removeClass('font-weight-bold');
            $(".just-desserts").removeClass('text-primary');
        }

        function justDesserts(){
            $(".div-food, .div-pizzas, .div-drinks").hide('slow');
            setTimeout(function (){
                $(".div-desserts").show('slow');
            },700);

            $(".just-desserts").addClass('font-weight-bold');
            $(".just-desserts").addClass('text-primary');
            $(".complete-all").removeClass('font-weight-bold');
            $(".complete-all").removeClass('text-primary');
            $(".just-pizzas").removeClass('font-weight-bold');
            $(".just-pizzas").removeClass('text-primary');
            $(".just-drinks").removeClass('font-weight-bold');
            $(".just-drinks").removeClass('text-primary');
        }

        function completeAll(){
            $(".div-desserts, .div-pizzas, .div-drinks").hide('slow');
            setTimeout(function (){
                $(".div-food").show('slow');
            },700);

            $(".complete-all").addClass('font-weight-bold');
            $(".complete-all").addClass('text-primary');
            $(".just-desserts").removeClass('font-weight-bold');
            $(".just-desserts").removeClass('text-primary');
            $(".just-pizzas").removeClass('font-weight-bold');
            $(".just-pizzas").removeClass('text-primary');
            $(".just-drinks").removeClass('font-weight-bold');
            $(".just-drinks").removeClass('text-primary');
        }
    </script>

        @if(session('scroll'))
            <script>
                var scrollar = $(".personalizar-session").val();

                if (scrollar.includes('addPizza') == true){
                    justPizzas();
                }else if (scrollar.includes('addDrink') == true){
                    justDrinks();
                }else if (scrollar.includes('addDesserts') == true){
                    justDesserts();
                }

                setTimeout(function (){
                    $('html, body').animate({
                        scrollTop: $("#"+ scrollar).offset().top
                    }, 800);
                }, 1000)
            </script>
    @endif
@endsection
