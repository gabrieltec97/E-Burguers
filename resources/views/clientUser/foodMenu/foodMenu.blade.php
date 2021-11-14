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
                                                            <label class="text-danger font-weight-bold">Este item está temporariamente indisponível.</label>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="multiCollapseExample{{$food->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark">
                                                <h5 class="modal-title" style="color: white" id="exampleModalLongTitle">Personalize seu sanduíche</h5>
                                                <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <img class="card-img-top img-personaliza" style="border-radius: 10px;" src="{{ asset($food->picture) }}">
                                                        </div>



                                                        @if($food->extras != null)
                                                            <div class="col-12">
                                                                @if($rate != "Não")
                                                                    @if($food->ratingAmount == 1)
                                                                        <p style="color: black" class="font-weight-bold mt-3 float-right"><i class="fas fa-star text-warning"></i> {{ $food->ratingAmount }} avaliação</p>
                                                                    @elseif($food->ratingAmount > 1)
                                                                        <p style="color: black" class="font-weight-bold mt-3 float-right"><i class="fas fa-star text-warning"></i> {{ $food->ratingAmount }} avaliações</p>
                                                                    @endif
                                                                @endif

                                                            <hr class="mt-5">
                                                            </div>
                                                        @endif

                                                        <div class="col-4">
                                                            @foreach(explode(',', $food->ingredients) as $ing)
                                                                <div>
                                                                    <input class="ml-1 form-check-input" type="checkbox" id="ing" name="ingredients[]" value="{{ $ing }}" checked>
                                                                    <label for="{{ $ing }}" class="ml-4 form-check-label font-weight-bold" style="color: black;">{{ $ing }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="col-7">
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
                                                @if($deliveryStatus[0]->status != 'Fechado')
                                                    @if($food->status == 'Ativo')
                                                        <button type="button" class="btn btn-danger mt-1" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" style="margin-top: 2px;" class="btn btn-success adicionar-bandeja text-white" name="addTray" value="addTray{{ $food->id }}">Adicionar à bandeja</button>
                                                    @else
                                                        <label class="text-danger font-weight-bold">Este item está temporariamente indisponível.</label>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

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
                                <span class="float-right">Valor atual: <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
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
                                            <span class="float-right">Valor atual: R$ <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
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


    @if(session('scroll'))
       <script>
           var scrollar = $(".personalizar-session").val();

           setTimeout(function (){
               $('html, body').animate({
                   scrollTop: $("#"+ scrollar).offset().top
               }, 800);
           }, 250)
       </script>
    @endif
@endsection
