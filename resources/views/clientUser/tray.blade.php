@extends('layouts.extend-client')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Meu pedido
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <?php

                $count = 0;

                if (isset($pureItems) && isset($items)){
                    $count = count($pureItems) + count($items);
                }elseif(isset($pureItems)){
                    $count = count($pureItems);
                }elseif(isset($items)){
                    $count = count($items);
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

                                            @if(isset($tray[0]['drinks']))

                                                <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="{{ route('minhaBandeja.destroy', $food = $tray[0]['drinks']) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6">
                                                                            <img src="{{ asset($tray[0]['imgDrink']) }}" class="pedido-img" style="border-radius: 3px">
                                                                        </div>

                                                                        <div class="col-12 col-md-4 mt-2 text-center mt-sm-5">
                                                                        <span class="font-weight-bold " style="font-size: 19px">
                                                                        {{ $tray[0]['drinks'] }}</span><button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>

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

                                        @if(isset($tray[0]['hamburguer']))

                                            <div class="col-12 col-lg-6 mt-lg-1 my-lg-0 mt-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="{{ route('minhaBandeja.destroy', $food = $tray[0]['comboItem']) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-6">
                                                                        <img src="{{ asset($tray[0]['imgHamburguer']) }}" class="pedido-img" style="border-radius: 3px">
                                                                    </div>

                                                                    <div class="col-12 col-md-4 mt-2 text-center mt-sm-5">
                                                                        <span class="font-weight-bold " style="font-size: 19px">
                                                                        {{$tray[0]['comboItem']}}</span><button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-6">
                                                                        <img src="{{ asset($tray[0]['imgPortion']) }}" class="pedido-img" style="border-radius: 3px">
                                                                    </div>

                                                                    <div class="col-12 col-md-4 mt-2 text-center mt-sm-5">
                                                                        <span class="font-weight-bold " style="font-size: 19px">
                                                                        {{$tray[0]['portion']}}</span><button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
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

                                    @elseif($tray[0]['orderType'] == 'Avulso')
                                        @if(($pureItems) != '' or $extras != '')
                                            <div class="col-12 d-flex justify-content-center" style="">
                                                <a href="{{ route('cardapio', $insert = true) }}" class="btn btn-danger font-weight-bold mr-2"><i class="fas fa-hamburger mr-2"></i>Ir para cardápio</a>
                                                <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                                            </div>


{{--                                            Itens avulsos sem personalização--}}

                                            @if(isset($pureItems))
                                                    @foreach($pureItems as $key => $value)

                                                        <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form action="{{ route('removerItem', $value->id)}}" method="post">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                @csrf
                                                                                <div class="col-12 col-md-8">
                                                                                    <img src="{{ asset($value->img) }}" class="img-fluid" style="border-radius: 3px">
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mt-2 text-center mt-sm-5">
                                                                                    <span class="font-weight-bold" style="font-size: 30px; margin-top: 30px">{{ $value->itemName }}</span>
                                                                                    <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger" style="font-size: 20px"></i></button>
                                                                                </div>
                                                                    </form>
                                                                                <div class="col-12 mt-4 mb-1">
                                                                                        @if($value->foodType == 'Hamburguer')
                                                                                            @if(isset($addons))
                                                                                                <form action="{{ route('addExtraItem', $value->id) }}" method="post">
                                                                                                    @csrf
                                                                                                    @foreach($addons as $pos => $data)
                                                                                                        <input class="form-check-input" type="checkbox" name="ingredients[]" value="{{ $data['namePrice'] }}">
                                                                                                        <label class="form-check-label font-weight-bold">{{  $data['namePrice']  }}</label>
                                                                                                        <br>
                                                                                                @endforeach

                                                                                            @endif
                                                                                            @endif
                                                                                </div>

                                                                    <div class="col-12 d-flex justify-content-center">
                                                                        <button type="submit" class="btn btn-success font-weight-bold w-75" title="Salvar alterações">Salvar</button>
                                                                        </form>
                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                        @endif
                                    @endif
                                    @endif

{{--                                    Itens avulsos com personalização--}}
                                        @if(isset($extras))
                                            @foreach($extras as $chave => $valor)
                                                <div class="col-12 col-lg-6 mt-lg-4 my-lg-0 mt-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="{{ route('removerPersonalizado', $valor->id) }}" method="post">
                                                                @csrf
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-8">
                                                                            <img src="{{ asset($valor->img) }}" class="img-fluid" style="border-radius: 3px">
                                                                        </div>
                                                                        <div class="col-12 col-md-4 mt-2 text-center mt-sm-5">
                                                                            <span class="font-weight-bold" style="font-size: 30px; margin-top: 30px">{{ $valor->Item }}</span>
                                                                            <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger" style="font-size: 20px"></i></button>
                                                                        </div>
                                                            </form>
{{--                                                            @if(isset($valor->nameExtra))--}}
{{--                                                                        <div class="col-6 mt-4">--}}
{{--                                                                            <form action="{{ route('editarPersonalizado', $valor->id) }}" method="post">--}}
{{--                                                                                @csrf--}}
{{--                                                                            @foreach(explode(',', $valor->nameExtra) as $val)--}}
{{--                                                                                <input class="ml-1 form-check-input" type="checkbox" name="ingredients[]" value="{{ $val }}" checked>--}}
{{--                                                                                <label class="text-muted ml-4 form-check-label font-weight-bold">{{  $val  }}</label>--}}
{{--                                                                                <br>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </div>--}}
{{--                                                            @endif--}}

                                                            @if(isset($addons))
                                                                <div class="col-12 mt-4">
                                                                @foreach($addons as $addon)

                                                                       <form action="{{ route('editarPersonalizado', $valor->id) }}" method="post">
                                                                       @csrf
                                                                       <input class="ml-1 form-check-input" type="checkbox" name="ingredients[]" value="{{ $addon['name'] }}"
                                                                       @foreach(explode(',', $valor->nameExtra) as $val)
                                                                           @if(ltrim($val) == $addon['name'])
                                                                           checked
                                                                           @endif
                                                                       @endforeach
                                                                       >
                                                                           <label class=" ml-4 form-check-label font-weight-bold">{{  $addon['name']  }}</label>

                                                                @endforeach
                                                                </div>
                                                            @endif
                                                            <button type="submit" class="btn btn-success font-weight-bold mt-5 w-75" title="Salvar alterações">Salvar</button>
                                                            </form>
                                                                    </div>
                                                                </div>


                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao alterar sua bebida. Mas você pode alterar por aqui, basta clicar no "X" e escolher qual desejar :)',
            })
        </script>
    @endif

    @if(session('error-2'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao alterar sua porção. Mas você pode alterar por aqui, basta clicar no "X" e escolher qual desejar :)',
            })
        </script>
    @endif

    @if(session('msg-esc'))
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
                title: 'Item adicionado ao pedido. Agora escolha uma bebida!'
            })
        </script>
    @endif


    @if(session('msg'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'warning',
                title: 'Poxa! Item removido do pedido.'
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
                title: 'Desculpe, mas este hambúrguer não está mais disponível.'
            })
        </script>
    @endif
@endsection
