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
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                </div>
                @endif
            @endif
            <div class="col-12 col-md-9">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-4" id="addTray{{ $food->id }}">
                                <form action="{{ route('adicionarItem', $food->id) }}">
                                    @if($food->foodType == 'Hamburguer')
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}" style="height: 200px; width: 294px">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
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

                                                <p class="card-text"> {{ $food->description }}
                                                    <br><br>
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span></p>
                                                @if($deliveryStatus[0]->status != 'Fechado')
                                                    @if($food->status == 'Ativo')
                                                <button type="button" value="{{ session('scroll') }}" class="btn btn-primary text-white personalizar-session" data-toggle="modal" data-target="#multiCollapseExample{{$food->id}}">Personalizar</button>
                                                <button type="submit" class="btn btn-success adicionar-bandeja text-white" name="addTray" value="addTray{{ $food->id }}">Adicionar à bandeja</button>
                                                    @else
                                                        <label class="text-danger font-weight-bold">Este item está temporariamente indisponível.</label>
                                                    @endif
                                                @endif
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
                                                                        <img class="card-img-top" src="{{ asset($food->picture) }}" style="height: 200px; width: 294px">
                                                                    </div>

                                                                    <div class="col-6">
                                                                        @foreach(explode(',', $food->ingredients) as $ing)
                                                                            <div>
                                                                                <input class="ml-1 form-check-input" type="checkbox" id="ing" name="ingredients[]" value="{{ $ing }}" checked>
                                                                                <label for="{{ $ing }}" class="text-muted ml-4 form-check-label font-weight-bold">{{ $ing }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>

                                                                    @if($rate != "Não")
                                                                        @if($food->ratingAmount == 1)
                                                                            <p>{{ $food->ratingAmount }} avaliação</p>
                                                                        @elseif($food->ratingAmount > 1)
                                                                            <p>{{ $food->ratingAmount }} avaliações</p>
                                                                        @endif
                                                                    @endif

                                                                    @if($food->extras != null)
                                                                    <div class="col-12">
                                                                        <hr class="mt-4">
                                                                    </div>
                                                                    @endif

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
                                    @else
                                    <article>
                                        <div class="card cardapio-card mb-4" id="addTray{{ $food->id }}">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}" alt="Card image cap" style="height: 200px; width: 294px">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
                                                @if($food->foodType != 'Bebida')
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
                                                @endif
                                                @if($food->foodType == 'Bebida')
                                                    @if($food->tastes != '')
                                                        <select name="sabor" class="mb-3 form-control" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                                            @foreach(explode(',', $food->tastes) as $taste)
                                                                <option value="{{ $taste }}">{{ $taste }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                @endif
                                                <p class="card-text"> {{ $food->description }}</p>
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span><br>
                                                @if($deliveryStatus[0]->status != 'Fechado')
                                                    @if($food->status == 'Ativo')
                                                <button type="submit" class="btn btn-success adicionar-bandeja" name="addTray" value="addTray{{ $food->id }}">Adicionar à bandeja</button>
                                                @else
                                                    <label class="text-danger font-weight-bold">Este item está temporariamente indisponível.</label>
                                                @endif
                                                @endif
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
                            <div>
                                <span class="float-right">Valor atual: <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Pagamento</a>
                            </div>

                        @else
                            bandeja vazia, escolhe aí..
                        @endif
                        @endif
                    </div>
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
