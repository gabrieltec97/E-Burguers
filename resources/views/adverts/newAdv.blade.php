@extends('layouts.extend')

@section('title')
    Cadastro de refeição
@endsection

@section('content')
    <div class="container">
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
                                        <label class="text-muted font-weight-bold">Nome</label>
                                        <input type="text" class="form-control nome-refeicao {{ ($errors->has('mealName') ? 'is-invalid' : '') }}" title="Nome que identifica a refeição" name="mealName" value="{{ old('mealName') }}" required>
                                        @if($errors->has('mealName'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealName') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Valor</label>
                                        <input type="text" class="form-control valorRefeicao {{ ($errors->has('mealValue') ? 'is-invalid' : '') }}" title="Valor a ser pago pela refeição" name="mealValue" value="{{ old('mealValue') }}" required>
                                        @if($errors->has('mealValue'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealValue') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="text-muted font-weight-bold">Tipo de refeição</label>
                                        <select class="form-control tipoRef {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="tipoRef" required>
                                            <option value="" selected hidden>Selecione</option>
                                            <option value="Porção" {{ old('empOccupation') == 'Administrador' ? 'selected' : '' }}>Porção</option>
                                            <option value="Bebida" {{ old('empOccupation') == 'Atendente' ? 'selected' : '' }}>Bebida</option>
                                            <option value="Hamburguer" {{ old('empOccupation') == 'Cozinheiro' ? 'selected' : '' }}>Hambúrguer</option>
                                            <option value="Sobremesa" {{ old('empOccupation') == 'Garçom' ? 'selected' : '' }}>Sobremesa</option>
                                        </select>
                                        @if($errors->has('empOccupation'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empOccupation') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-4 col-md-4">
                                        <label class="text-muted font-weight-bold">Participa do combo?</label><br>
                                        <input type="radio" class="impComboSim" {{ old('combo') == "Sim" ? 'checked' : ''}} title="Ao escolher esta opção, esta refeição participará de um combo promocional." name="combo" value="Sim">
                                        <label class="mr-3 font-weight-bold text-success" title="Ao escolher esta opção, esta refeição participará de um combo promocional.">Sim</label>
                                        <input type="radio" class="impComboNao" {{ old('combo') == "Não" ? 'checked' : ''}} title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional." name="combo" value="Não">
                                        <label class="font-weight-bold text-danger" title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional.">Não</label><br>
                                    </div>

                                    <div class="col-12 mt-3 col-md-4 comb">
                                        <label class="text-muted font-weight-bold">Valor no combo</label>
                                        <input type="text" class="form-control valComboPromo {{ ($errors->has('promoValue') ? 'is-invalid' : '') }}" title="Se a refeição for fazer parte do combo, você deverá inserir um valor menor do que o valor dela fora do combo, assim fazendo um valor promocional." name="promoValue" value="{{ old('promoValue') }}" required>
                                        <label class="text-danger verificaPreco mt-2" style="font-size: 13.7px">O valor promocional não pode ser maior ou igual ao valor
                                            normal.</label>
                                        @if($errors->has('promoValue'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('promoValue') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4 igr">
                                        <label class="text-muted font-weight-bold">Ingredientes</label>
                                        <input type="text" class="form-control ingredientes {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Exemplo:Cebola,Tomate,Alface" name="ingredients" value="{{ old('ingredients') }}" required>
                                        <label class="text-primary font-weight-bold mt-2 verifica-ingredientes" style="font-size: 13.7px">Insira-os separando por vírgulas<span class="exemplo"> como no exemplo acima</span>.</label>
                                        @if($errors->has('ingredients'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('ingredients') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="text-muted font-weight-bold">Descrição</label>
                                        <textarea name="mealDescription" title="Breve texto que informa as características da refeição. Mínimo 70 e máximo 96 caracteres." cols="20" rows="5" style="resize: none" class="form-control descricao {{ ($errors->has('mealDescription') ? 'is-invalid' : '') }}">{{ old('mealDescription') }}</textarea>
                                        <label class="text-primary font-weight-bold mt-2 total-char">Total de caracteres: <span class="contagem font-weight-bolder"></span></label><br>
                                        <label class="text-primary font-weight-bold lbl-alerta">A descrição deve conter no mínimo 70 e no máximo 96 caracteres.</label>
                                        @if($errors->has('mealDescription'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('mealDescription') }}</span>
                                       </div>
                                        @endif
                                    </div>

                                    <div class="col-12  col-md-4">
                                        <label class="text-muted font-weight-bold">Foto (Opcional)</label>
                                        <input type="file" name="userPhoto">
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="TituloModalCentralizado">Quase lá!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold text-primary">Por favor, revise os dados da refeição antes de finalizar seu cadastro.</p>

                                                <p class="text-muted font-weight-bold">Nome: <span class="nome-refeicao2 text-success"></span></p>
                                                <p class="text-muted font-weight-bold">Valor: <span class="valor-refeicao2 text-success"></span></p>
                                                <p class="text-muted font-weight-bold">Tipo de refeição: <span class="tipoRef2 text-success"></span></p>
                                                <p class="text-muted font-weight-bold">Ingredientes: <span class="ingredientes2 text-success"></span></p>
                                                <p class="text-muted font-weight-bold">Participa do combo: <span class="part-combo2"></span></p>
                                                <p class="text-muted font-weight-bold p-valor-combo-2">Valor no combo: <span class="valor-combo2 text-success"></span></p>
                                                <p class="text-muted font-weight-bold">Descrição: <span class="descricao2 text-success"></span></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-primary">Cadastrar refeição</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end">
                            <button type="button" class="btn-cadastrar-refeicao btn btn-primary font-weight-bold" data-toggle="modal" data-target="#ExemploModalCentralizado"><i class="fas fa-plus mr-2"></i>Cadastrar refeição</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


