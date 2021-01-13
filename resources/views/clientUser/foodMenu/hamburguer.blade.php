@extends('layouts.extend-client')

@section('title')
    Escolha seu hambúrguer
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Escolha um hambúrguer bem gostoso!</h1>
                <hr>
            </div>

            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-3">
                                <article>
                                    <form action="{{ route('acompanhamento', $food->id) }}" class="form-group">
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ $food->picture }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>
                                                <p class="card-text"> {{ $food->description }}
                                                    <br><br>
                                                    <span class="text-danger font-weight-bold">R$ {{ $food->comboValue }}</span></p>
                                                <a class="btn btn-primary adicionar-bandeja text-white" data-toggle="collapse" href="#multiCollapseExample{{$food->id}}" role="button" aria-expanded="false">Personalizar</a>
                                                <button type="submit" class="btn btn-success adicionar-bandeja text-white">Adicionar à bandeja</button>

                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse" id="multiCollapseExample{{$food->id}}">
                                                        <div class="card card-body">
                                                            <a class="btn btn-primary text-white mb-2" style="position: relative;" data-toggle="collapse" href="#multiCollapseExample{{$food->id}}" role="button" aria-expanded="false">Fechar</a>

                                                            @foreach(explode(',', $food->ingredients) as $ing)
                                                                <div>
                                                                    <input class="mr-1" type="checkbox" id="ing" name="ingredients[]" value="{{ $ing }}" checked>
                                                                    <span class="text-muted font-weight-bold">{{ $ing }}</span>
                                                                </div>
                                                            @endforeach

                                                            <hr>

                                                            @foreach(explode(',', $food->extras) as $ext)
                                                                <div>
                                                                    <input class="mr-1" type="checkbox" id="ing" name="ingredients[]" value="{{ $ext }}">
                                                                    <span class="text-muted font-weight-bold">{{ $ext }}</span>
                                                                    <span class="text-danger font-weight-bold">  + 2.99</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
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
@endsection
