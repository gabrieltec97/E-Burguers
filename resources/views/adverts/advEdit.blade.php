@extends('layouts.extend')

@section('title')
    Edição de anúncio
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">

                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Edição de anúncio</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('refeicoes.update', $meal->id) }}" method="post" class="form-group form-refeicao">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="text-muted font-weight-bold">Nome</label>
                                        <input type="text" class="form-control nome-refeicao-edit {{ ($errors->has('mealName') ? 'is-invalid' : '') }}" value="{{ $meal->name }}" title="Nome que identifica a refeição" name="mealName" required>
                                        @if($errors->has('mealName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Valor</label>
                                        <input type="text" class="form-control valorRefeicao-edit {{ ($errors->has('mealValue') ? 'is-invalid' : '') }}" value="{{ $meal->value }}" title="Valor a ser pago pela refeição" name="mealValue" required>
                                        @if($errors->has('mealValue'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealValue') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Participa do combo?</label><br>
                                        <input type="radio" class="impComboSim" {{ ($meal->combo == 'Sim')?'checked':'' }} title="Ao escolher esta opção, esta refeição participará de um combo promocional." name="combo" value="Sim">
                                        <label class="mr-3 font-weight-bold text-success" title="Ao escolher esta opção, esta refeição participará de um combo promocional.">Sim</label>
                                        <input type="radio" class="impComboNao"  {{ ($meal->combo == 'Não')?'checked':'' }} title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional." name="combo" value="Não">
                                        <label class="font-weight-bold text-danger" title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional.">Não</label><br>
                                    </div>

                                    <div class="col-12 mt-3 col-md-6">
                                        <label class="text-muted font-weight-bold">Valor no combo</label>
                                        <input type="text" value="{{ $meal->comboValue }}" class="form-control valComboPromo-edit {{ ($errors->has('promoValue') ? 'is-invalid' : '') }}" title="Se a refeição for fazer parte do combo, você deverá inserir um valor menor do que o valor dela fora do combo, assim fazendo um valor promocional." name="promoValue" required>
                                        <label class="text-danger verificaPreco mt-2 font-weight-bold" style="font-size: 13.7px">O valor promocional não pode ser maior ou igual ao valor
                                            normal.</label>
                                        @if($errors->has('promoValue'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('promoValue') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-6">
                                        <label class="text-muted font-weight-bold">Ingredientes</label>
                                        <input type="text" value="{{ $meal->ingredients }}" class="form-control ingredientes-edit {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Exemplo:Cebola,tomate,alface" title="Insira-os separando por vírgula e sem dar espaços." name="ingredients" required>
                                        <label class="text-danger mt-2 verifica-ingredientes font-weight-bold" style="font-size: 13.7px">Insira-os separando por vírgulas e sem dar espaços.</label>
                                        @if($errors->has('ingredients'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('ingredients') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="text-muted font-weight-bold">Descrição</label>
                                        <textarea name="mealDescription" title="Breve texto que informa as características da refeição. O texto deve conter no mínimo 70 e no máximo 96 caracteres." cols="20" rows="5" style="resize: none" class="form-control descricao-edit {{ ($errors->has('mealDescription') ? 'is-invalid' : '') }}" required> {{$meal->description}}</textarea>
                                        <label class="text-primary font-weight-bold mt-2 total-char">Total de caracteres: <span class="contagem font-weight-bolder"></span></label><br>
                                        <label class="text-primary font-weight-bold lbl-alerta">A descrição deve conter no mínimo 70 e no máximo 96 caracteres.</label>
                                        @if($errors->has('mealDescription'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealDescription') }}</span>
                                            </div>
                                        @endif
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
                                                <p class="font-weight-bold text-muted text-center a-mudancas"></p>

                                                <img src="{{ asset('logo/cara.svg') }}" class="imagem-alteracao" style="width: 100px; margin-left: 40%; height: 100px" hidden>

                                               <div class="row">
                                                   <div class="col-6 div-nome-ant" hidden>
                                                       <p class="text-muted font-weight-bold">Nome anterior: <span class="text-success">{{ $meal->name }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-nome-2" hidden>Novo nome: <span class="nome-refeicao2-edit text-danger"></span></p>
                                                   </div>

                                                   <div class="col-6 div-valor-ant" hidden>
                                                       <p class="text-muted font-weight-bold ">Valor anterior: <span class="text-success">{{ $meal->value }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-valor-2" hidden>Novo valor: <span class="valor-refeicao2-edit text-danger"></span></p>

                                                   </div>

                                                   <div class="col-6 div-partCombo-ant">
                                                       <p class="text-muted font-weight-bold partCombo" hidden>Participa do combo</p>
                                                       <p class="text-muted font-weight-bold">Valor anterior: <span class="text-success">{{ $meal->combo }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-partCombo-2" hidden>Novo valor: <span class="partCombo-refeicao2-edit text-danger"></span></p>

                                                   </div>

                                                   <div class="col-6 div-valorPromo-ant">
                                                       <p class="text-muted font-weight-bold">Valor promocional anterior: <span class="text-success">{{ $meal->comboValue }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-valorPromo-2" hidden>Novo valor promocional: <span class="valorPromo-refeicao2-edit text-danger"></span></p>

                                                   </div>

                                                   <div class="col-12 div-ingrediente-ant">
                                                       <p class="text-muted font-weight-bold">Ingredientes Anteriormente: <span class="text-success">{{ $meal->ingredients }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-ingrediente-2" hidden>Ingredientes Agora: <span class="ingrediente-refeicao2-edit text-danger"></span></p>

                                                   </div>

                                                   <div class="col-12 div-descricao-ant">
                                                       <p class="text-muted font-weight-bold">Descrição anterior: <span class="text-success">{{ $meal->description }}</span></p>
                                                       <p class="text-muted font-weight-bold div-novo-descricao-2" hidden>Novadescricao descrição: <span class="descricao-refeicao2-edit text-danger"></span></p>
                                                   </div>
                                               </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-primary salvar-agora">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end">
                            <button type="button" class="mr-3 btn btn-danger font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter2"><i class="fas fa-trash-alt mr-2"></i>Deletar anúncio</button>
                            <button type="button" class="btn-alterar-refeicao btn btn-primary font-weight-bold" data-toggle="modal" data-target="#ExemploModalCentralizado"><i class="fas fa-plus mr-2"></i>Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('refeicoes.destroy', $meal->id) }}" method="post">
    @csrf
    @method('DELETE')
    <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Atenção!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <span class="text-danger font-weight-bold">
                        Você está deletando este anúncio, com isso ele não ficará mais disponível no cardápio e também não
                          poderá ser recuperado. Tem certeza que deseja prosseguir?
                      </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger font-weight-bold">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection


