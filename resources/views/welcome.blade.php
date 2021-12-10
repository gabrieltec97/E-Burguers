<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Pizzaria Megatonne</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e656fe6405.js" crossorigin="anonymous"></script>
</head>
<body>

<?php

$close = \Illuminate\Support\Facades\DB::table('working_time')
    ->where('id', '=', '1')
    ->get()->toArray();

$deliveryStatus = DB::table('delivery_status')
    ->where('id', '=', 1)
    ->get()->toArray();

$hour = date('H' . ':' . 'i');

//Fechando delivery
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

<section id="section1" style="background-image: url({{ asset('logo/pi.jpg') }}); background-size: cover;">

    <nav class="navbar navbar-expand-lg nav-start">
        <a href="{{ route('entrar') }}"  class="btn d-lg-none btn-pedMobile" style="background-color: #eebd0f; color: white;">Fazer Pedido</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: whitesmoke"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" onclick="hybridScroll()" style="font-size: 17px; cursor:pointer; color: white;">Cardápio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold" data-toggle="modal" data-target="#modalhowtogo"style="cursor: pointer; font-size: 17px; color: white;">Como chegar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold" onclick="scrollEasy()" style="font-size: 17px; cursor:pointer; color: white;">Facilidades</a>
                </li>
            </ul>
            <span class="navbar-text">
                    <a href="{{ 'entrar' }}" class="btn pedido-desktop" style="background-color: #eebd0f; color: white;">Fazer Pedido</a>
                </span>
        </div>
    </nav>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner carousel-principal">
            <div class="carousel-item">
                <img class="d-block w-100 img-carousel" src="{{ asset('logo/post39.jpg') }}"  alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 img-carousel" src="{{ asset('logo/PIZZA (6).jpg') }}" alt="Third slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block w-100 img-carousel" src="{{ asset('logo/PIZZA (1).jpg') }}">
            </div>
        </div>
    </div>


</section>

<div class="col-12 mt-3 d-flex justify-content-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mybreadcrumb">
            <li class="breadcrumb-item font-weight-bold text-primary complete-all b-items" style="font-size: 16px;cursor: pointer" onclick="completeAll()">Cardápio completo</li>
            <li class="breadcrumb-item just-pizzas b-items" style="font-size: 16px;cursor: pointer" onclick="justPizzas()">Apenas Pizzas</li>
            <li class="breadcrumb-item just-drinks b-items" style="font-size: 16px;cursor: pointer" onclick="justDrinks()">Apenas Bebidas</li>
            <li class="breadcrumb-item just-desserts b-items" style="font-size: 16px;cursor: pointer" onclick="justDesserts()">Apenas Sobremesas</li>
        </ol>
    </nav>
</div>

<section id="section2">

    <div class="col-12">
        <div class="container-fluid">
            <div class="row verifica-card" id="cardapio">
                @foreach($foods as $food)
                    <div class="col-12 mt-lg-3 col-lg-4 div-food" id="addTray{{ $food->id }}">

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
                    </div>
                @endforeach

                @foreach($pizzas as $pizza)
                    <div class="col-12 mt-lg-3 col-lg-4 div-pizzas" id="addPizza{{ $pizza->id }}">

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
                    </div>
                @endforeach

                @foreach($drinks as $drink)
                    <div class="col-12 mt-lg-3 col-lg-4 div-drinks" id="addDrink{{ $drink->id }}">

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
                    </div>
                @endforeach

                @foreach($desserts as $dessert)
                    <div class="col-12 mt-lg-3 col-lg-4 div-desserts" id="addDessert{{ $dessert->id }}">

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

                @if($pizzas == null)
                    <div class="col-12 d-flex justify-content-center">
                        <h3 class="d-none no-pizzas">Sem pizzas cadastradas...</h3>
                    </div>

                    <div class="col-12 d-flex justify-content-center mt-4">
                        <i class="far fa-frown text-info d-none no-pizzas" style="font-size: 128px;"></i>
                    </div>
                @endif
            </div>


        </div>
    </div>

</section>

<section id="4" style="background-color: #49e183">
    <div class="container pb-4">
        <div class="row">
            <div class="col-12 mb-lg-4">
                <p class="sec4 text-center mt-2 text-white" id="scrollEasy">Receba seu pedido com conforto</p>
            </div>

            <div class="col-12 col-lg-4 mb-lg-0">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Formas de Retirada</h3>
                        <p class="card-subtitle mb-2 text-muted text-center" style="font-size: 15px; margin-top: -13px">Como receber seu pedido</p>
                        <p class="card-text" style="font-size: 15px;">Você pode pedir e receber sua pizza no conforto de sua residência, ou se preferir, vir buscar conosco.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 my-3 my-lg-0">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h3 class="text-center card-title">Como pagar</h3>
                        <p class="card-subtitle mb-2 text-center text-muted" style="font-size: 15px; margin-top: -13px">Direto com o entregador</p>
                        <p class="card-text" style="font-size: 15px;">Você poderá pagar ao entregador no dinheiro ou cartão de crédito/débito: MasterCard, Elo, Visa.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 my-1 my-lg-0">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h3 class="text-center card-title">Tempo de entrega</h3>
                        <p class="card-subtitle mb-2 text-center text-muted" style="font-size: 15px; margin-top: -13px">De acordo com o bairro</p>
                        <p class="card-text" style="font-size: 15px;">O tempo médio de entrega é de 30 min, podendo chegar até 1 hora em bairros mais distantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="section3" style="background-color: #1f2029">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <p class="text-white text-center desktopRotulo" style="font-size: 15px"><a href="#">Sistema E-Pedidos Delivery</a></p>
            </div>

            <div class="col-12 mt-lg-3 d-flex justify-content-center">
                <?php
                $today = getdate();
                ?>
                <p class="text-white copyRights" style="margin-top: -15px; font-size: 15px">{{ $today['year'] }} Todos os direitos reservados <i class="far fa-copyright ml-1"></i></p>
            </div>
        </div>
    </div>
</section>

<script>
    function scrollPedir(){
        $('html, body').animate({
            scrollTop: $("#pedir").offset().top
        }, 700);
    }
</script>

<script>
    function hybridScroll(){
        if ($("#pedirMobile").is(':hidden') == true){
            scrollPedir();
        }else{
            scrollMobile();
        }
    }
</script>


<!-- Modal -->
<div class="modal fade" id="modalhowtogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Como chegar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-12">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.545328821416!2d-43.703330085404374!3d-22.745134937840113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x995688b1bd9abb%3A0x283073f79234598c!2sAv.%20Min.%20Fernando%20Costa%20-%20Boa%20Esperan%C3%A7a%2C%20Serop%C3%A9dica%20-%20RJ%2C%2023890-000!5e0!3m2!1spt-BR!2sbr!4v1636850225910!5m2!1spt-BR!2sbr" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                       </div>

{{--                       <div class="col-12">--}}
{{--                           <hr>--}}
{{--                       </div>--}}

                       <div class="col-12 mt-2 number-modal d-flex justify-content-center">
                            <a href="tel:(21)997582608" style="font-size: 16px">(21) 99758-2608 (ligar)</a>
                       </div>
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fab fa-whatsapp mr-2"></i>Mensagem WhatsApp</button>
                <button type="button" class="btn btn-primary"><i class="fas fa-map-marker-alt mr-2"></i> Abrir no GPS</button>
            </div>
        </div>
    </div>
</div>



@if($deliveryStatus[0]->status == 'Fechado')
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'O delivery está fechado no momento!',
            text: '{{ $deliveryStatus[0]->message != null ? $deliveryStatus[0]->message : 'Abriremos em breve para receber seu pedido.'}}',
            showCancelButton: false,
            showConfirmButton: true,
        })

        $(".fechar").on('click', function (){
            Swal.close()
        })
    </script>
@endif

<input type="text" value="{{ count($desserts) }}" class="dest" hidden>
<input type="text" value="{{ count($pizzas) }}" class="pzzs" hidden>
<input type="text" value="{{ count($drinks) }}" class="dks" hidden>

<script>
    function justPizzas(){

        let pizzas = $(".pzzs").val();

        if (pizzas == 0){
            $(".no-pizzas").removeClass('d-none', 'true');
        }

        $(".no-desserts").addClass('d-none', 'true');
        $(".no-drinks").addClass('d-none', 'true');

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

        let drinks = $(".dks").val();

        if (drinks == 0){
            $(".no-drinks").removeClass('d-none', 'true');
        }

        $(".no-pizzas").addClass('d-none', 'true');
        $(".no-desserts").addClass('d-none', 'true');

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

        let desserts = $(".dest").val();

        if (desserts == 0){
            $(".no-desserts").removeClass('d-none', 'true');
        }

        $(".no-pizzas").addClass('d-none', 'true');
        $(".no-drinks").addClass('d-none', 'true');

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

        $(".no-pizzas").addClass('d-none', 'true');
        $(".no-drinks").addClass('d-none', 'true');
        $(".no-desserts").addClass('d-none', 'true');

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

<script>
    function scrollMobile(){
        $('html, body').animate({
            scrollTop: $("#cardapio").offset().top
        }, 700);
    }

    function scrollEasy(){
        $('html, body').animate({
            scrollTop: $("#scrollEasy").offset().top
        }, 700);
    }
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</body>
</html>
