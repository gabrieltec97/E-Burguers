@extends('layouts.extend')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

@section('title')
    Cadastro de refeição
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">

               @if(session('msg'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Nova refeição</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('refeicoes.store') }}" method="post" class="form-group form-refeicao" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label style="color: black;" class="font-weight-bold">Tipo de refeição</label>
                                        <select class="form-select tipoRef {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="tipoRef" required>
                                            <option value="" selected hidden>Selecione</option>
{{--                                            <option value="Acompanhamento" {{ old('empOccupation') == 'Administrador' ? 'selected' : '' }}>Porção</option>--}}
                                            <option value="Bebida" {{ old('empOccupation') == 'Atendente' ? 'selected' : '' }}>Bebida</option>
                                            <option value="Pizza" {{ old('empOccupation') == 'Cozinheiro' ? 'selected' : '' }}>Pizza</option>
                                            <option value="Sobremesa" {{ old('empOccupation') == 'Garçom' ? 'selected' : '' }}>Sobremesa</option>
                                        </select>
                                        @if($errors->has('empOccupation'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empOccupation') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-lg-0 col-md-4">
                                        <label style="color: black;" class="font-weight-bold">Nome</label>
                                        <input type="text" name="mealName" class="form-control nome-refeicao {{ ($errors->has('mealName') ? 'is-invalid' : '') }}" title="Nome que identifica a refeição" value="{{ old('mealName') }}" required>
                                        @if($errors->has('mealName'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealName') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label style="color: black;" class="font-weight-bold">Valor</label>
                                        <input type="text" class="form-control valorRefeicao {{ ($errors->has('mealValue') ? 'is-invalid' : '') }}" title="Valor a ser pago pela refeição" name="mealValue" value="{{ old('mealValue') }}" required>
                                        @if($errors->has('mealValue'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealValue') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mt-3 tastes">
                                        <label class="font-weight-bold" style="color: black;">Sabores</label>
                                        <br>
                                        <input type="text" class="form-control ingredientes" placeholder="Uva, Morango, Natural" name="sabores">
                                        <label class="text-primary font-weight-bold mt-2 verifica-ingredientes" style="font-size: 13.7px">Insira-os separando por vírgulas<span class="exemplo"> como no exemplo acima</span>.</label>
                                    </div>

                                    <div class="col-12 col-lg-4 mt-3 sizes">
                                        <label class="font-weight-bold" style="color: black;">Tamanhos</label>
                                        <br>
                                        <input type="checkbox" class="form-check-input ml-1" value="Pequeno" name="extras[]">
                                        <label class="form-check-label ml-4" for="Pequeno">Pequeno</label><br>
                                        <input type="checkbox" class="form-check-input ml-1" value="Médio" name="extras[]">
                                        <label class="form-check-label ml-4" for="Médio">Médio</label><br>
                                        <input type="checkbox" class="form-check-input ml-1" value="Grande" name="extras[]">
                                        <label class="form-check-label ml-4" for="Grande">Grande</label><br>
                                        <input type="checkbox" class="form-check-input ml-1" value="Gigante" name="extras[]">
                                        <label class="form-check-label ml-4" for="Gigante">Gigante</label><br>
                                        <input type="checkbox" class="form-check-input ml-1" value="Familia" name="extras[]">
                                        <label class="form-check-label ml-4" for="Familia">Família</label><br>
                                    </div>



                                    <div class="col-12 mt-3">
                                        <label style="color: black;" class="font-weight-bold">Descrição</label>
                                        <textarea name="mealDescription" title="Breve texto que informa as características da refeição. Mínimo 70 e máximo 96 caracteres." cols="20" rows="5" style="resize: none" class="form-control descricao {{ ($errors->has('mealDescription') ? 'is-invalid' : '') }}">{{ old('mealDescription') }}</textarea>
                                        <label class="text-primary font-weight-bold mt-2 total-char">Total de caracteres: <span class="contagem font-weight-bolder"></span></label><br>
                                        <label class="text-primary font-weight-bold lbl-alerta">A descrição deve conter no mínimo 70 e no máximo 90 caracteres.</label>
                                        @if($errors->has('mealDescription'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealDescription') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12  col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Foto (Opcional)</label>
                                        <input type="file" name="advPhoto" accept=".png, .jpg, .jpeg, .gif">
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #343a40">
                                                <h5 class="modal-title font-weight-bold" id="TituloModalCentralizado" style="color: white">Quase lá!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold text-dark">Por favor, revise os dados da refeição antes de finalizar seu cadastro.</p>

                                                <p style="color: black; font-size: 17.5px">Nome: <span class="nome-refeicao2" style="color: black; font-size: 16px"></span></p>
                                                <p style="color: black; font-size: 17.5px">Valor: <span class="valor-refeicao2" style="color: black; font-size: 16px"></span></p>
                                                <p style="color: black; font-size: 17.5px">Tipo de refeição: <span class="tipoRef2" style="color: black; font-size: 16px"></span></p>
                                                <p style="color: black; font-size: 17.5px">Descrição: <span class="descricao2" style="color: black; font-size: 16px"></span></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success close-here" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-primary cadastrar-ref">Cadastrar refeição</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end">
                            <button type="button" class="btn-cadastrar-refeicao btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado"><i class="fas fa-plus mr-2"></i>Cadastrar refeição</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


