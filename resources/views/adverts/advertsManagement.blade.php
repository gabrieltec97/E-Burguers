@extends('layouts.extend')

@section('title')
    Gerenciamento de anúncios
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                @if(session('msg-2'))
                    <div class="alert alert-success alerta-sucesso-ref alert-dismissible fade show" role="alert">
                        <span class="font-weight-bold">Legal!</span> {{ session('msg-2') }} <a class="text-primary font-weight-bold" href="{{ route('cardapio') }}">cardápio!</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    @if(session('msg'))
                        <div class="alert alert-danger alerta-sucesso-user alert-dismissible fade show" role="alert">
                            <span class="text-muted font-weight-bold">{{ session('msg') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Refeições cadastradas</div>
                    <div class="card-body">
                        <div>
                            <form action="#" class="form-group">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Digite o nome da refeição" name="orderNumber">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 18px; cursor: pointer"><i class="fas fa-search font-weight-bold"></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col" class="text-primary">Nome</th>
                                <th scope="col" class="text-primary">Valor</th>
                                <th scope="col" class="text-primary">Participa do combo</th>
                                <th scope="col" class="text-primary">Descrição</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($meals as $meal)
                                    <tr>
                                        <td class="font-weight-bold"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->name }}</a></td>
                                        <td class="font-weight-bold"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->value }}</a></td>
                                        <td class="w-25 font-weight-bold"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->combo }}</a></td>
                                        <td class="w-50 font-weight-bold"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->description }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mb-2 d-flex justify-content-end">
                        <a href="{{ route('refeicoes.create') }}" class="cadastrar-link">
                            <i class="fas fa-plus"></i>
                            <label class="cadastrar-link" title="Nova refeição">Cadastrar refeição</label>
                        </a>
                    </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
