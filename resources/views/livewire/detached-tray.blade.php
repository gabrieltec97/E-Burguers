<div>
    <div class="row">
    @foreach($foods as $food)
        <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-4">
            <form method="get" wire:submit.prevent="insertItem({{ $food->id }})">
                @if($food->foodType == 'Hamburguer')
                    <div class="card cardapio-card">
                        <img class="card-img-top img-card" src="{{ asset($food->picture) }}">
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
                            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#multiCollapseExample{{$food->id}}">Personalizar</a>
                            <button type="submit" class="btn btn-success adicionar-bandeja text-white">Adicionar à bandeja</button>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="multiCollapseExample{{$food->id}}" wire:ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <img class="card-img-top" src="{{ asset($food->picture) }}">
                                                </div>

                                                <div class="col-6">
                                                    @foreach(explode(',', $food->ingredients) as $ing)
                                                        <div>
                                                            <input class="ml-1 form-check-input" type="checkbox" id="ing" name="ingredients[]" value="{{ $ing }}" checked>
                                                            <span class="text-muted ml-4 form-check-label font-weight-bold">{{ $ing }}</span>
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
                                                                <input class="ml-1 form-check-input aditionals" type="checkbox" id="{{ $e }}" wire:model="extras" value="{{ $e }}">
                                                                <label for="{{ $e }}" class="ml-4 form-check-label font-weight-bold">{{ $e }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger mt-1 cancela-personalizar" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" style="margin-top: 2px;" class="btn btn-success adicionar-bandeja text-white">Adicionar à bandeja</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <article>
                        <div class="card cardapio-card mb-4">
                            <img class="card-img-top img-card" src="{{ asset($food->picture) }}" alt="Card image cap">
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
                                        <select name="sabor" class="mb-3" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                            @foreach(explode(',', $food->tastes) as $taste)
                                                <option value="{{ $taste }}">{{ $taste }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                @endif
                                <p class="card-text"> {{ $food->description }}</p>
                                <span class="text-danger font-weight-bold">R$ {{ $food->value }}</span><br>
                                <button type="submit" class="btn btn-success adicionar-bandeja">Adicionar à bandeja</button>
                            </div>
                        </div>
                    </article>
                @endif
            </form>
        </div>
    @endforeach

        <div class="col-3">
            <div class="card fixo">
                <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 22px;"><i class="fas fa-shopping-cart carrinho text-white mr-2"></i> Seu pedido está assim</div>

                <div class="card-body">
                    <ol>
                        @if(isset($query))
                            @foreach($query as $item)
                                <form method="get" wire:submit.prevent="removeItem({{ $item->id }})">
                                    @csrf
                                    <li>{{$item->item}} <span class="text-success">{{ $item->nameExtra != '' ? '+ ' . $item->nameExtra:  ''}}</span> <button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></li>
                                </form>
                            @endforeach
                        @endif
                    </ol>

                    @if(isset($val))
                        @if($val[0]['totalValue'] != 0)
                            <span class="float-right">Valor atual: <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
                        @else
                            bandeja vazia, escolhe aí..
                        @endif
                    @else
                        bandeja vazia, escolhe aí..
                    @endif
                </div>
            </div>
        </div>
</div>
</div>
