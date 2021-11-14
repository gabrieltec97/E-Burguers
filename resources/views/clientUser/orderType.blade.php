@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Como deseja pedir?
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Como você deseja pedir?</h1>
                <hr>
            </div>

            <div class="col-12 mt-3">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                            <a href="{{ route('cardapio', $insert = true) }}">
                                <img class="card-img-top tipopedido" src="{{ asset('logo/food.jpg') }}" alt="Card image cap">
                            </a>
                        </div>

                        <div class="col-12 col-lg-6 mb-3" style="cursor: pointer;">
                            <a href="{{ route('comboHamburguer') }}">
                                <img class="card-img-top tipopedido" src="{{ asset('logo/bg.jpg') }}" alt="Card image cap">
                            </a>
                        </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg') == false && session('msg-cancel') == false)
        @if($rated['ordered'] != 0)
            @if(count($itensToEvaluate) != 0)
                    <script>
                        Swal.fire({
                            title: 'Poderia avaliar como foram os outros pedidos por favor?',
                            icon: 'question',
                            showCancelButton: false,
                            showConfirmButton: false,
                            html:
                                '<a href="{{ route('avaliacoes') }}" class="btn btn-success mt-2">Avaliar</a>' +
                                '<button type="button" class="btn btn-danger mt-2 ml-4 fechar">Fechar</button>'
                        })

                        $(".fechar").on('click', function (){
                            Swal.close()
                        })
                    </script>
            @endif
        @endif
    @endif

    @if(session('msg'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Tudo certo!',
                html: 'Seu pedido está na aba <b style="color: blue">pedidos pendentes</b> no menu acima. Fique à vontade para escolher novos itens para seu novo pedido, ok?',
                timer: 20000,
                timerProgressBar: true
            })
        </script>
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

    @if($deliveryStatus[0]->status == 'Fechado')

    @endif

@endsection
