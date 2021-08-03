@extends('layouts.extend')

@section('title')
    Visualização de anúncio
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <div class="alert alert-success alerta-sucesso-ref alert-dismissible fade show" role="alert">
                        <span class="text-muted font-weight-bold">{{ session('msg') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">{{ $meal->name }}</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                    <img src="{{ asset($meal->picture) }}" style="margin-top: 30px" class="img-fluid" alt="">
                                </div>

                                <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                                    <label class="text-muted font-weight-bold mt-3"><span style="font-size: 16px" class="text-muted font-weight-bold">Nome:</span><span class="text-primary"> {{ $meal->name }} </span></label><br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Valor:</span><span class="text-primary"> {{ $meal->value }}</span></label>
                                    <br>
                                    @if($meal->foodType != 'Bebida')
                                        @if($meal->ingredients != null)
                                            <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Ingredientes:</span><span class="text-primary"> {{$meal->ingredients}} </span></label>
                                        @endif
                                        @if($meal->extras != null)
                                            <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Adicionais:</span><span class="text-primary"> {{$meal->extras}} </span></label>
                                        @endif
                                    @else
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Sabores:</span><span class="text-primary"> {{$meal->tastes}} </span></label>
                                    @endif
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Participa do combo:</span><span class="text-primary"> {{ $meal->combo }} </span></label>
                                    <br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Valor no combo:</span><span class="text-primary"> {{ $meal->comboValue }} </span></label>
                                    <br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Descrição:</span><span class="text-primary"> {{ $meal->description }} </span></label>
                                    <br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Criado em:</span><span class="text-primary"> {{ $meal->created_at }}</span></label>
                                    <br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Última modificação:</span><span class="text-primary"> {{ $meal->updated_at }} </span></label>
                                    <br>
                                    <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Nota de avaliação:</span><span class="text-primary"> {{ round($meal->finalGrade, 1) }}</span></label>

                                    <a href="{{ route('refeicoes.edit', $meal->id) }}" class="btn btn-primary mt-5 float-right"><i class="fas fa-edit mr-2"></i>Editar dados cadastrais</a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


