@extends('layouts.extend-client')

@section('title')
    Meu pedido
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <?php

                $count = 0;

                if(isset($detached)){
                    $count = count($detached);
                }

                if(isset($tray[0])){
                    if($tray[0]['hamburguer'] != ''){
                        $count = 1;
                    }

                    if($tray[0]['drinks'] != ''){
                        $count += 1;
                    }

                    if($tray[0]['portion'] != ''){
                        $count += 1;
                    }
                }

                ?>
                @if($count != 0)
                <h1 class="titulo-cardapio text-center my-3">Hmm... Até o momento seu pedido está assim</h1>
                @else
                    <h1 class="titulo-cardapio text-center my-3">Poxa... Sua bandeja está vazia. Vamos <a
                            href="{{ route('tipoPedido') }}">acessar o cardápio</a>.</h1>
                @endif
            </div>
            <div class="container">
                <div class="row">
                    @if($count == 0)
                        <div class="col-12 offset-2 mt-5">
                            <img src="{{ asset('logo/cook.svg') }}" style="width: 300px; height: 300px" class="offset-lg-2" alt="">
                        </div>
                </div>
            </div>
            @endif
                @if($count != 0)
                <div class="container">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                @if(isset($tray[0]))
                                    @if($tray[0]['orderType'] == "Combo")
                                        @if(isset($tray[0]['hamburguer']) && isset($tray[0]['portion']) && isset($tray[0]['drinks']))

                                            <div class="col-12 d-flex justify-content-center" style="">
                                                <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                                            </div>
                                @endif
                                @endif
                                @endif
                                @if(isset($tray[0]))
                                    @if($tray[0]['orderType'] == "Combo")

                                        @if(isset($tray[0]['hamburguer']))

                                            <div class="col-12 col-lg-6 mt-lg-1 my-lg-0 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="{{ route('minhaBandeja.destroy', $food = $tray[0]['hamburguer']) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <img src="{{ asset('logo/hamburguer.jpg') }}" class="pedido-img">
                                                            <span class="text-muted font-weight-bold teste">
                                                          {{ $tray[0]['hamburguer'] }}  <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                        </form>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        @else
                                            <div class="col-12 col-lg-6 my-lg-0">
                                                <div class="card mx-4">
                                                    <div class="card-body">
                                                        <a href="{{ route('comboHamburguer') }}" class="text-primary font-weight-bold" style="text-decoration: none;"><i class="mr-2 fas fa-plus-circle text-primary" style="font-size: 50px; opacity: 0.8"></i>
                                                            <span class=" formata-bandeja" >Escolha um hambúrguer</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        @if(isset($tray[0]['portion']))

                                            <div class="col-12 col-lg-6 mt-lg-1 my-lg-0 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="{{ route('minhaBandeja.destroy', $food = $tray[0]['portion']) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <img src="{{ asset('logo/hamburguer.jpg') }}" class="pedido-img">
                                                            <span class="text-muted font-weight-bold teste">
                                                          {{ $tray[0]['portion'] }}  <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                        </form>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>


                                        @else
                                            <div class="col-12 col-lg-6 my-lg-0 mt-3">
                                                <div class="card mx-4">
                                                    <div class="card-body">
                                                        <a href="{{ route('editarPorcao') }}" class="text-primary font-weight-bold" style="text-decoration: none;"><i class="mr-2 fas fa-plus-circle text-primary" style="font-size: 50px; opacity: 0.8"></i>
                                                            <span class=" formata-bandeja">Escolha uma porção</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        @if(isset($tray[0]['drinks']))

                                            <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="{{ route('minhaBandeja.destroy', $food = $tray[0]['drinks']) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <img src="{{ asset('logo/hamburguer.jpg') }}" class="pedido-img">
                                                            <span class="text-muted font-weight-bold teste">
                                                          {{ $tray[0]['drinks'] }}  <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                        </form>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>


                                        @else
                                            <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                <div class="card mx-4">
                                                    <div class="card-body">
                                                        <a href="{{ route('editarBebida') }}" class="text-primary font-weight-bold" style="text-decoration: none;"><i class="mr-2 fas fa-plus-circle text-primary" style="font-size: 50px; opacity: 0.8"></i>
                                                            <span class="formata-bandeja">Escolha uma bebida</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @elseif($tray[0]['orderType'] == 'Avulso')
                                        @if(($tray[0]['detached']) != '')
                                            <div class="col-12 d-flex justify-content-center" style="">
                                                <a href="{{ route('cardapio', $insert = true) }}" class="btn btn-danger font-weight-bold mr-2"><i class="fas fa-hamburger mr-2"></i>Ir para cardápio</a>
                                                <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                                            </div>
                                            @foreach($detached as $key => $value)

                                                <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="{{ route('removerItem', $key)}}" method="post">
                                                                @csrf
                                                                <img src="{{ asset('logo/hamburguer.jpg') }}" class="pedido-img">
                                                                <span class="text-muted font-weight-bold teste">
                                                          {{ $value }}  <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                            </form>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
                    @endif

    @if(isset($edit) == true)
        <button hidden class="disparo-ham"></button>
    @endif

    @if(session('msg'))
        <button hidden class="disparo-rem"></button>
    @endif
@endsection
