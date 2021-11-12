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

<section id="section1" style="background-image: url({{ asset('logo/pi.jpg') }}); height: 530px; background-size: cover;">

    <nav class="navbar navbar-expand-lg nav-start">
        <button class="btn d-lg-none" style="background-color: #eebd0f; color: white;">Fazer Pedido</button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: whitesmoke"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="#" style="font-size: 17px; color: white;">Página Inicial <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="#" style="font-size: 17px; color: white;">Cardápio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="#" style="font-size: 17px; color: white;">Como chegar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="#" style="font-size: 17px; color: white;">Pedir Online</a>
                </li>
            </ul>
            <span class="navbar-text">
                    <button class="btn pedido-desktop" style="background-color: #eebd0f; color: white;">Fazer Pedido</button>
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

    <span class="cardapio-mble">Confira o nosso cardápio!</span>
</section>

<section id="section2">

    <div class="desktopCardapio">
        <span style="font-size: 48px;" class="cardapio-dsk">Confira o nosso cardápio!</span>
        <div class="container d-flex justify-content-center">
            <div class="slider owl-carousel mt-4">
                @foreach($foods as $food)
                    <div class="card">
                        <form action="{{ route('adicionarItem', $food->id) }}">
                            <div class="">
                                <img src="{{asset($food->picture)}}" class="img-card">
                            </div>

                            <div class="content mt-2">
                                <div class="title"><h4>{{ $food->name }}</h4></div>
                                <div class="sub-title text-danger">R$ {{ $food->value }}</div>
                                <div class="container">
                                    <p>{{ $food->description }}</p>
                                    <div class="btn d-flex justify-content-center">
                                        <button class="adtray">Pedir Agora</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container d-flex justify-content-center">
            <div class="slider owl-carousel mt-5">
                @foreach($drinks as $drink)
                    <div class="card">
                        <div class="">
                            <img src="{{asset($drink->picture)}}" class="img-card">
                        </div>

                        <div class="content mt-2">
                            <div class="title"><h4>{{ $drink->name }}</h4></div>
                            <div class="sub-title text-danger">R$ {{ $drink->value }}</div>
                            <div class="container">
                                <p>{{ $drink->description }}</p>
                                <div class="btn d-flex justify-content-center">
                                    <button class="adtray">Pedir Agora</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mobile-cardapio">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('logo/PIZZA (1).jpg') }}" alt="First slide">
                </div>
                @foreach($foods2 as $food)
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset($food->picture) }}" alt="Second slide">

                    <div class="bg-white">
                        <h5 class="bg-white pt-2 text-center font-weight-bold" style="color: black">{{ $food->name }}</h5>
                        <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span>
                        <br>
                        <button class="btn btn-danger mb-2 mt-2">Pedir Agora</button>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<section id="4">
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-12">
                <h2>Receba seu pedido com conforto</h2>
            </div>
            
            <div class="col-12 col-lg-4 mb-1 mb-lg-0">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h3 class="card-title">Formas de Retirada</h3>
                        <p class="card-subtitle mb-2 text-muted" style="font-size: 15px; margin-top: -13px">Como receber seu pedido</p>
                        <p class="card-text" style="font-size: 15px;">Você pode pedir e receber sua pizza no conforto de sua residência, ou se preferir, vir buscar conosco.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 my-3 my-lg-0">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h3 class="card-title">Como pagar</h3>
                        <p class="card-subtitle mb-2 text-muted" style="font-size: 15px; margin-top: -13px">Direto com o entregador</p>
                        <p class="card-text" style="font-size: 15px;">Você poderá pagar ao entregador no dinheiro ou cartão de crédito/débito: MasterCard, Elo, Visa.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 my-1 my-lg-0">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h3 class="card-title">Tempo de entrega</h3>
                        <p class="card-subtitle mb-2 text-muted" style="font-size: 15px; margin-top: -13px">De acordo com o bairro</p>
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
            <div class="col-12 col-lg-4 mt-2 mt-lg-0">
                <p class="text-white addressPlace">Av. Ministro Fernando Costa, 28.</p>
            </div>

            <div class="col-12 col-lg-4">
                <p class="text-white wppNumber"><i class="fab fa-whatsapp text-success mr-2" style="font-size: 22px;"></i> (21) 99798-4597</p>
            </div>

            <div class="col-12 col-lg-4">
                <?php
                   $today = getdate();
                ?>
                <p class="text-white deliveryName" style="font-size: 15px"><a href="#">Sistema E-Pedidos Delivery</a></p>
            </div>

            <div class="col-12 mt-lg-3">
                <p class="text-white copyRights" style="margin-top: -15px; font-size: 15px">{{ $today['year'] }} Todos os direitos reservados <i class="far fa-copyright ml-1"></i></p>
            </div>
        </div>
    </div>
</section>


<script>
    $(".slider").owlCarousel({
        loop:true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverpause: true,
    })
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</body>
</html>
