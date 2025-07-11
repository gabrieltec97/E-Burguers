@extends('layouts.extend-client')

@section('title')
    Escolha sua bebida.
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Agora escolha o que irá beber.</h1>
                <hr>
            </div>

            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($foods as $food)
                            <div class="col-12 col-md-4 mt-5 mt-lg-3 col-lg-3">
                                <article>
                                    <form action="{{ route('salvamento', $food->id) }}" method="post" class="form-group">
                                        @csrf
                                        <div class="card cardapio-card">
                                            <img class="card-img-top img-card" src="{{ asset($food->picture ) }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold">{{ $food->name }}</h5>

                                                @if($food->foodType == 'Bebida')
                                                    @if($food->tastes != '')
                                                        <select name="sabor" class="mb-3" title="Selecione um sabor" style="width: 100%;cursor: pointer; ">
                                                            @foreach(explode(',', $food->tastes) as $taste)
                                                                <option value="{{ $taste }}">{{ $taste }}</option>
                                                            @endforeach
                                                        </select>
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
