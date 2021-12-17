@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Cardápio
@endsection

@section('content')

    <?php

    $close = \Illuminate\Support\Facades\DB::table('working_time')
        ->where('id', '=', '1')
        ->get()->toArray();

    $deliveryStatus = DB::table('delivery_status')
        ->where('id', '=', 1)
        ->get()->toArray();

    $hour = date('H' . ':' . 'i');

    //    Fechando delivery
    if ($close[0]->closeHour <= $hour){

        if ($deliveryStatus[0]->status == 'Aberto'){
            DB::table('delivery_status')
                ->update(['status' => 'Fechado']);

            DB::table('trays')->truncate();
            DB::table('item_without_extras')->truncate();
        }
    }

    $deliveryStatus = DB::table('delivery_status')
        ->where('id', '=', 1)
        ->get()->toArray();
    ?>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 d-lg-none" style="margin-top: 10px">
                <hr>
            </div>

            <div class="col-12 mt-lg-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-weight-bold text-primary complete-all" style="cursor: pointer" onclick="completeAll()">Cardápio completo</li>
                        <li class="breadcrumb-item just-pizzas" style="cursor: pointer" onclick="justPizzas()">Pizzas Pequenas</li>
                        <li class="breadcrumb-item just-medium" style="cursor: pointer" onclick="justMedium()">Pizzas Médias</li>
                        <li class="breadcrumb-item just-large" style="cursor: pointer" onclick="justLarge()">Pizzas Grandes</li>
                        <li class="breadcrumb-item just-drinks" style="cursor: pointer" onclick="justDrinks()">Bebidas</li>
                        <li class="breadcrumb-item just-desserts" style="cursor: pointer" onclick="justDesserts()">Sobremesas</li>
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

                            @foreach($smallPizzas as $smPizza)
                                <div class="col-12 mt-lg-3 col-lg-4 div-pizzas" id="addPizza{{ $smPizza->id }}">
                                    <form action="{{ route('adicionarItem', $smPizza->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $smPizza->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $smPizza->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($smPizza->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $smPizza->description }}</span>
                                                        </div>

                                                        <div class="col-6 starsrate">
                                                            @if($rate != "Não")
                                                                @if($smPizza->finalGrade == 1)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade > 1 && $smPizza->finalGrade < 2)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade == 2)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade > 2 && $smPizza->finalGrade < 3)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade == 3)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade > 3 && $smPizza->finalGrade < 4)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade == 4)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade > 4 && $smPizza->finalGrade < 5)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($smPizza->finalGrade == 5)
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$smPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($smPizza->status == 'Ativo')
                                                                    @if($smPizza->foodType == 'Pizza')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addPizza" value="addPizza{{ $smPizza->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addPizza" value="addPizza{{ $smPizza->id }}">Adicionar à bandeja</button>
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

                            @foreach($mediumPizzas as $mdPizza)
                                <div class="col-12 mt-lg-3 col-lg-4 div-medium-pizzas" id="addMd{{ $mdPizza->id }}">
                                    <form action="{{ route('adicionarItem', $mdPizza->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $mdPizza->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $mdPizza->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($mdPizza->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $mdPizza->description }}</span>
                                                        </div>

                                                        <div class="col-6 starsrate">
                                                            @if($rate != "Não")
                                                                @if($mdPizza->finalGrade == 1)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade > 1 && $mdPizza->finalGrade < 2)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade == 2)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade > 2 && $mdPizza->finalGrade < 3)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade == 3)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade > 3 && $mdPizza->finalGrade < 4)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade == 4)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade > 4 && $mdPizza->finalGrade < 5)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($mdPizza->finalGrade == 5)
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$mdPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($mdPizza->status == 'Ativo')
                                                                    @if($mdPizza->foodType == 'Pizza')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addPizza" value="addMd{{ $mdPizza->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addPizza" value="addPizza{{ $mdPizza->id }}">Adicionar à bandeja</button>
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

                            @foreach($largePizzas as $lgPizza)
                                <div class="col-12 mt-lg-3 col-lg-4 div-large-pizzas" id="addLg{{ $lgPizza->id }}">
                                    <form action="{{ route('adicionarItem', $lgPizza->id) }}">

                                        <div class="card card-cardapio">
                                            <div class="card-header bg-dark">
                                                <span class="text-white">{{ $lgPizza->name }} -</span>  <span class="text-danger font-weight-bold">R$ {{ $lgPizza->value }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="card-img-top img-item" src="{{ asset($lgPizza->picture) }}">
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="fooddesc">{{ $lgPizza->description }}</span>
                                                        </div>

                                                        <div class="col-6 starsrate">
                                                            @if($rate != "Não")
                                                                @if($lgPizza->finalGrade == 1)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade > 1 && $lgPizza->finalGrade < 2)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade == 2)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade > 2 && $lgPizza->finalGrade < 3)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade == 3)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade > 3 && $lgPizza->finalGrade < 4)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade == 4)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="far fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade > 4 && $lgPizza->finalGrade < 5)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star-half text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @elseif($lgPizza->finalGrade == 5)
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                    <i class="fas fa-star text-warning" title="{{$lgPizza->ratingAmount}} Avaliações" style="cursor: pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-12">
                                                            @if($deliveryStatus[0]->status != 'Fechado')
                                                                @if($lgPizza->status == 'Ativo')
                                                                    @if($lgPizza->foodType == 'Pizza')
                                                                        <button type="button" value="{{ session('scroll') }}" class="personalizar-session" hidden></button>
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addPizza" value="addLg{{ $lgPizza->id }}">Adicionar à bandeja</button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-success adicionar-bandeja text-white" style="margin-left: -22px;" name="addPizza" value="addPizza{{ $lgPizza->id }}">Adicionar à bandeja</button>
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

                                                        <div class="col-12 mt-3">
                                                            @if($drink->foodType == 'Bebida')
                                                                @if($drink->tastes != '')
                                                                    <select name="sabor" class="mb-1 form-control select-sabor" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                                                        @foreach(explode(',', $drink->tastes) as $taste)
                                                                            <option value="{{ $taste }}">{{ $taste }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endif
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
                                <div class="col-12">
                                    <h3 class="d-none no-desserts text-center">Sem sobremesas cadastradas...</h3>
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <i class="far fa-frown text-info d-none no-desserts" style="font-size: 128px;"></i>
                                </div>
                            @endif

                            @if($drinks == null)
                                <div class="col-12 d-flex justify-content-center">
                                    <h3 class="d-none no-drinks">Sem bebidas cadastradas...</h3>
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <i class="far fa-frown text-info d-none no-drinks" style="font-size: 128px;"></i>
                                </div>
                            @endif

                            @if($smallPizzas == null)
                                <div class="col-12 d-flex justify-content-center">
                                    <h3 class="d-none no-pizzas">Sem pizzas cadastradas...</h3>
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <i class="far fa-frown text-info d-none no-pizzas" style="font-size: 128px;"></i>
                                </div>
                            @endif

                            @if($mediumPizzas == null)
                                <div class="col-12 d-flex justify-content-center">
                                    <h3 class="d-none no-mdpizzas">Sem pizzas médias cadastradas...</h3>
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <i class="far fa-frown text-info d-none no-mdpizzas" style="font-size: 128px;"></i>
                                </div>
                            @endif

                            @if($largePizzas == null)
                                <div class="col-12 d-flex justify-content-center">
                                    <h3 class="d-none no-lgpizzas">Sem pizzas grandes cadastradas...</h3>
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <i class="far fa-frown text-info d-none no-lgpizzas" style="font-size: 128px;"></i>
                                </div>
                            @endif
                    </div>


                </div>
            </div>

        <?php
            if (isset($val)){
                if (str_contains($val[0]['totalValue'] , '.')){
                    $totalValue = $val[0]['totalValue'];
                    if ($totalValue > 0){
                        $vals = explode('.', $totalValue);

                        $pieces = strlen($vals[0]);
                        $piecesAfter = strlen($vals[1]);
                    }else{
                        $pieces = 0;
                    }

                    $count2 = strlen($totalValue);

                    if ($count2 == 4 && $totalValue > 10){
                        $price = $totalValue . '0';
                    }elseif ($count2 == 2){
                        $price = $totalValue. '.' . '00';
                    }elseif($count2 == 5 && $pieces == 3){
                        $price = $totalValue. '0';
                    }elseif($count2 == 3){
                        $price = $totalValue . '0';
                    }elseif($pieces == 5  && $count2 >= 6 && $piecesAfter < 2){
                        $price = $totalValue . '0';
                    }elseif($pieces == 4  && $count2 >= 6 && $piecesAfter < 2){
                        $price = $totalValue . '0';
                    }
                    elseif($pieces > 3 && $count2 >= 6){
                        $price = $totalValue;
                    } else{
                        $price = $totalValue;
                    }
                }else{
                    $price = $val[0]['totalValue'] . '.00';
                }
            }else{
                $price = 0;
            }
            ?>

            <div class="col-3">
                <div class="card fixo">
                    <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 22px;"><i class="fas fa-shopping-cart carrinho text-white mr-2"></i> {{ $deliveryStatus[0]->status == 'Fechado' ? 'Delivery fechado' : 'Seu pedido está assim'}}</div>

                    <div class="card-body">
                        @if($deliveryStatus[0]->status == 'Fechado')
                            <p>O delivery está fechado no momento.</p>
                        @else
                        <ol>
                            @if(isset($items))
                                @foreach($items as $item)
                                    <form action="{{ route('removerItem', ['id' => $item->id])}}" method="post">
                                        @csrf
                                    <li>{{$item->item}} <button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></li>

                                    </form>
                                @endforeach
                            @endif
                        </ol>

                        @if(isset($val) && $val[0]['totalValue'] > 0)
                            <hr>
                                @if(count($coupons) > 0)
                                <div class="col-12 mb-2">
                                    <img src="{{ asset('logo/cupom.png') }}" style="width: 17px; height: 17px; margin-bottom: 5px" alt="">
                                    <a href="{{ route('meusCupons') }}" style="text-decoration: none;">Veja nossos cupons disponíveis aqui.</a>
                                </div>
                                @endif
                            <div>
                                <span class="float-right">Valor atual: <span class="text-success">R$ {{ $price }}</span></span>
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
                                    <p>O delivery está fechado no momento.</p>
                                @else
                                    <ol>
                                        @if(isset($items))
                                            @foreach($items as $item)
                                                <form action="{{ route('removerItem', ['id' => $item->id])}}" method="post">
                                                    @csrf
                                                    <li>{{$item->item}} <button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></li>

                                                </form>
                                            @endforeach
                                        @endif
                                    </ol>

                                    @if(isset($val) && $val[0]['totalValue'] > 0)
                                        <hr>
                                        <div>
                                            <span class="float-right">Valor atual: R$ <span class="text-success">R$ {{ $price }}</span></span>
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
                                <a href="{{ route('meusCupons') }}" style="text-decoration: none;">Veja nossos cupons disponíveis aqui</a>
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
        @endif
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
    @if($deliveryStatus[0]->status != 'Fechado')
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
                    title: 'Seu pedido foi cancelado, mas fique à vontade para fazer novos pedidos, ok?'
                })
            </script>
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

        @if($deliveryStatus[0]->status == 'Fechado')
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'O delivery está fechado no momento!',
                    text: '{{ $deliveryStatus[0]->message != null ? $deliveryStatus[0]->message : 'Encerramos nosso horário de funcionamento.'}}',
                    showCancelButton: false,
                    showConfirmButton: true,
                })

                $(".fechar").on('click', function (){
                    Swal.close()
                })
            </script>
        @endif

        @if($insert == 1 && $deliveryStatus[0]->status != 'Fechado')
                <script>
                    Swal.fire({
                        title: 'Bem vindo(a)!',
                        text: 'Preparamos um cardápio especial para você!',
                        imageUrl: 'http://localhost/E-Pedidos/public/logo/cardr.png',
                        imageWidth: 180,
                        imageHeight: 180,
                        imageAlt: 'Custom image',
                        timer: 5000,
                        timerProgressBar: true,
                    })
                </script>
        @endif

        <input type="text" value="{{ count($desserts) }}" class="dest" hidden>
        <input type="text" value="{{ count($smallPizzas) }}" class="pzzs" hidden>
        <input type="text" value="{{ count($largePizzas) }}" class="lgpzzs" hidden>
        <input type="text" value="{{ count($mediumPizzas) }}" class="mdpzzs" hidden>
        <input type="text" value="{{ count($drinks) }}" class="dks" hidden>

    <script>
        function justPizzas(){

            let pizzas = $(".pzzs").val();

            if (pizzas == 0){
                $(".no-pizzas").removeClass('d-none', 'true');
            }

            $(".no-desserts").addClass('d-none', 'true');
            $(".no-drinks").addClass('d-none', 'true');
            $(".no-mdpizzas").addClass('d-none', 'true');
            $(".no-lgpizzas").addClass('d-none', 'true');

            $(".div-food, .div-drinks, .div-desserts, .div-large-pizzas, .div-medium-pizzas").hide('slow');
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
            $(".just-medium").removeClass('font-weight-bold');
            $(".just-medium").removeClass('text-primary');
            $(".just-large").removeClass('font-weight-bold');
            $(".just-large").removeClass('text-primary');
        }

        function justDrinks(){

            let drinks = $(".dks").val();

            if (drinks == 0){
                $(".no-drinks").removeClass('d-none', 'true');
            }

            $(".no-pizzas").addClass('d-none', 'true');
            $(".no-desserts").addClass('d-none', 'true');
            $(".no-lgpizzas").addClass('d-none', 'true');
            $(".no-mdpizzas").addClass('d-none', 'true');

            $(".div-food, .div-pizzas, .div-desserts, .div-medium-pizzas, .div-large-pizzas").hide('slow');
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
            $(".just-medium").removeClass('font-weight-bold');
            $(".just-medium").removeClass('text-primary');
            $(".just-large").removeClass('font-weight-bold');
            $(".just-large").removeClass('text-primary');
        }

        function justDesserts(){

            let desserts = $(".dest").val();

            if (desserts == 0){
                $(".no-desserts").removeClass('d-none', 'true');
            }

            $(".no-pizzas").addClass('d-none', 'true');
            $(".no-drinks").addClass('d-none', 'true');
            $(".no-mdpizzas").addClass('d-none', 'true');
            $(".no-lgpizzas").addClass('d-none', 'true');

            $(".div-food, .div-pizzas, .div-drinks, .div-medium-pizzas, .div-large-pizzas").hide('slow');
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
            $(".just-medium").removeClass('font-weight-bold');
            $(".just-medium").removeClass('text-primary');
            $(".just-large").removeClass('font-weight-bold');
            $(".just-large").removeClass('text-primary');
        }

        function completeAll(){

            $(".no-pizzas").addClass('d-none', 'true');
            $(".no-drinks").addClass('d-none', 'true');
            $(".no-desserts").addClass('d-none', 'true');
            $(".no-mdpizzas").addClass('d-none', 'true');
            $(".no-lgpizzas").addClass('d-none', 'true');

            $(".div-desserts, .div-pizzas, .div-drinks, .div-medium-pizzas, .div-large-pizzas").hide('slow');
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
            $(".just-medium").removeClass('font-weight-bold');
            $(".just-medium").removeClass('text-primary');
            $(".just-large").removeClass('font-weight-bold');
            $(".just-large").removeClass('text-primary');
        }

        function justMedium(){

            $(".no-pizzas").addClass('d-none', 'true');
            $(".no-drinks").addClass('d-none', 'true');
            $(".no-desserts").addClass('d-none', 'true');
            $(".no-lgpizzas").addClass('d-none', 'true');

            let mdpizzas = $(".mdpzzs").val();

            if (mdpizzas == 0){
                $(".no-mdpizzas").removeClass('d-none', 'true');
            }

            $(".div-food, .div-pizzas, .div-drinks, .div-desserts, .div-large-pizzas").hide('slow');
            setTimeout(function (){
                $(".div-medium-pizzas").show('slow');
            },700);

            $(".just-medium").addClass('font-weight-bold');
            $(".just-medium").addClass('text-primary');
            $(".just-desserts").removeClass('font-weight-bold');
            $(".just-desserts").removeClass('text-primary');
            $(".just-pizzas").removeClass('font-weight-bold');
            $(".just-pizzas").removeClass('text-primary');
            $(".just-drinks").removeClass('font-weight-bold');
            $(".just-drinks").removeClass('text-primary');
            $(".complete-all").removeClass('font-weight-bold');
            $(".complete-all").removeClass('text-primary');
            $(".just-large").removeClass('font-weight-bold');
            $(".just-large").removeClass('text-primary');
        }

        function justLarge(){

            $(".no-pizzas").addClass('d-none', 'true');
            $(".no-drinks").addClass('d-none', 'true');
            $(".no-desserts").addClass('d-none', 'true');
            $(".no-mdpizzas").addClass('d-none', 'true');

            let lgpizzas = $(".lgpzzs").val();

            if (lgpizzas == 0){
                $(".no-lgpizzas").removeClass('d-none', 'true');
            }

            $(".div-food, .div-pizzas, .div-drinks, .div-desserts, .div-medium-pizzas").hide('slow');
            setTimeout(function (){
                $(".div-large-pizzas").show('slow');
            },700);

            $(".just-large").addClass('font-weight-bold');
            $(".just-large").addClass('text-primary');
            $(".just-desserts").removeClass('font-weight-bold');
            $(".just-desserts").removeClass('text-primary');
            $(".just-pizzas").removeClass('font-weight-bold');
            $(".just-pizzas").removeClass('text-primary');
            $(".just-drinks").removeClass('font-weight-bold');
            $(".just-drinks").removeClass('text-primary');
            $(".complete-all").removeClass('font-weight-bold');
            $(".complete-all").removeClass('text-primary');
            $(".just-medium").removeClass('font-weight-bold');
            $(".just-medium").removeClass('text-primary');
        }
    </script>

        @if(session('scroll'))
            <script>
                var scrollar = $(".personalizar-session").val();

                console.log(scrollar);

                if (scrollar.includes('addPizza') == true){
                    justPizzas();
                }else if (scrollar.includes('addDrink') == true){
                    justDrinks();
                }else if (scrollar.includes('addDesserts') == true){
                    justDesserts();
                }else if (scrollar.includes('addMd') == true){
                    justMedium();
                }else if (scrollar.includes('addLg') == true){
                    justLarge();
                }

                setTimeout(function (){
                    $('html, body').animate({
                        scrollTop: $("#"+ scrollar).offset().top
                    }, 800);
                }, 1000)
            </script>
    @endif
@endsection
