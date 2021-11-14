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
        <button onclick="scrollMobile()" class="btn d-lg-none btn-pedMobile" style="background-color: #eebd0f; color: white;">Fazer Pedido</button>
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
                    <a class="nav-link font-weight-bold" href="{{ route('entrar') }}" style="font-size: 17px; color: white;">Pedir Online</a>
                </li>
            </ul>
            <span class="navbar-text">
                    <button onclick="scrollPedir()" class="btn pedido-desktop" style="background-color: #eebd0f; color: white;">Fazer Pedido</button>
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

    <div class="container d-flex justify-content-center">
        <span class="cardapio-mble text-center">Confira o nosso cardápio!</span>
    </div>
</section>

<section id="section2">

    <div class="desktopCardapio">
        <div class="container d-flex justify-content-center">
            <span style="font-size: 48px;" class="cardapio-dsk">Confira o nosso cardápio!</span>
        </div>
        <div class="container d-flex justify-content-center">
            <div id="pedir" class="slider owl-carousel mt-4">
                @foreach($foods as $food)
                    <div class="card">
                            <div class="">
                                <img src="{{asset($food->picture)}}" class="img-card">
                            </div>
                            <div class="content mt-2">
                                <div class="title text-center"><h4>{{ $food->name }}</h4></div>
                                <div class="sub-title text-danger text-center">R$ {{ $food->value }}</div>
                                <div class="container">
                                    <p>{{ $food->description }}</p>
                                    <div class="btn d-flex justify-content-center">
                                        <a href="{{ route('entrar') }}" class="adtray">Pedir Agora</a>
                                    </div>
                                </div>
                            </div>
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
                            <div class="title text-center"><h4>{{ $drink->name }}</h4></div>
                            <div class="sub-title text-danger text-center">R$ {{ $drink->value }}</div>
                            <div class="container">
                                <p>{{ $drink->description }}</p>
                                <div class="btn d-flex justify-content-center">
                                    <a href="{{ route('entrar') }}" class="adtray">Pedir Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="pedirMobile" class="mobile-cardapio">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('logo/PIZZA (1).jpg') }}" alt="First slide">
                </div>
                @foreach($foods2 as $food)
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset($food->picture) }}" style="height: 350px" alt="Second slide">

                    <div class="bg-white">
                        <h5 class="bg-white pt-2 text-center font-weight-bold" style="color: black">{{ $food->name }}</h5>
                        <p class="text-danger font-weight-bold text-center">R$ {{ $food->value }}</p>
                        <br>
                        <div class="container d-flex justify-content-center" style="margin-top: -35px">
                            <a href="{{ route('entrar') }}" class="btn btn-danger mb-2 mt-2">Pedir Agora</a>
                        </div>
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

<section id="4" style="background-color: #6dd5e7">
    <div class="container pb-4">
        <div class="row">
            <div class="col-12 mb-lg-4">
                <p class="sec4 text-center mt-2 text-white">Receba seu pedido com conforto</p>
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
    $(".slider").owlCarousel({
        loop:true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverpause: true,
    })
</script>

<script>
    function scrollPedir(){
        $('html, body').animate({
            scrollTop: $("#pedir").offset().top
        }, 700);
    }
</script>

<script>
    function scrollMobile(){
        $('html, body').animate({
            scrollTop: $("#pedirMobile").offset().top
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
            text: '{{ $deliveryStatus[0]->message != null ? $deliveryStatus[0]->message : 'Encerramos nosso horário de funcionamento.'}}',
            showCancelButton: false,
            showConfirmButton: true,
        })

        $(".fechar").on('click', function (){
            Swal.close()
        })
    </script>
@endif


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</body>
</html>
