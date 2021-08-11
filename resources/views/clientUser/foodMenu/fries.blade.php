@extends('layouts.extend-client')

@section('title')
    Escolha seu acompanhamento.
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Agora escolha um acompanhamento.</h1>
                <hr>
            </div>

            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-3">
                                <article>
                                    <form action="{{ route('bebida',  $food->id ) }}" method="post" class="form-group">
                                        @csrf
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture )}}" alt="Card image cap">
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
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->comboValue }}</span></p>
                                                <button type="submit" class="btn btn-primary adicionar-bandeja">Adicionar à bandeja</button>
                                            </div>
                                        </div>
                                    </form>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($edit) == false)
        <button hidden class="disparo-ham"></button>
    @endif
@endsection
