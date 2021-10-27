@extends('layouts.extend')

@section('title')
    Edição de anúncio
@endsection

@section('content')
    <div class="container-fluid">
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
                                        <label style="color: black;" class="font-weight-bold">Nome</label>
                                        <input type="text" class="form-control nome-refeicao-edit {{ ($errors->has('mealName') ? 'is-invalid' : '') }}" value="{{ $meal->name }}" title="Nome que identifica a refeição" name="mealName" required>
                                        @if($errors->has('mealName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label style="color: black;" class="font-weight-bold">Valor</label>
                                        <input type="text" class="form-control valorRefeicao-edit {{ ($errors->has('mealValue') ? 'is-invalid' : '') }}" value="{{ $meal->value }}" title="Valor a ser pago pela refeição" name="mealValue" required>
                                        @if($errors->has('mealValue'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealValue') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if($meal->foodType != "Sobremesa")
                                        <div class="col-12 mt-3 mt-md-0 col-md-4">
                                            <label style="color: black;" class="font-weight-bold">Participa do combo?</label><br>
                                            <input type="radio" class="impComboSim" {{ ($meal->combo == 'Sim')?'checked':'' }} title="Ao escolher esta opção, esta refeição participará de um combo promocional." name="combo" value="Sim">
                                            <label class="mr-3 font-weight-bold text-success" title="Ao escolher esta opção, esta refeição participará de um combo promocional.">Sim</label>
                                            <input type="radio" class="impComboNao"  {{ ($meal->combo == 'Não')?'checked':'' }} title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional." name="combo" value="Não">
                                            <label class="font-weight-bold text-danger" title="Ao escolher esta opção, esta refeição NÃO participará de um combo promocional.">Não</label><br>
                                        </div>

                                        <div class="col-12 mt-3 col-md-6">
                                            <label style="color: black;" class="font-weight-bold">Valor no combo</label>
                                            @if($meal->comboValue != 'Esta refeição não participará do combo.')
                                                <input type="text" value="{{$meal->comboValue}}" class="form-control valComboPromo-edit {{ ($errors->has('promoValue') ? 'is-invalid' : '') }}" title="Se a refeição for fazer parte do combo, você deverá inserir um valor menor do que o valor dela fora do combo, assim fazendo um valor promocional." name="promoValue" required>
                                            @else
                                                <input type="text" value="{{$meal->comboValue}}" readonly style="cursor: not-allowed;" class="form-control valComboPromo-edit {{ ($errors->has('promoValue') ? 'is-invalid' : '') }}" title="Esta refeição não participará do combo." name="promoValue" required>
                                            @endif
                                            <label class="text-danger verificaPreco mt-2 font-weight-bold" style="font-size: 13.7px">O valor promocional não pode ser maior ou igual ao valor
                                                normal.</label>
                                            @if($errors->has('promoValue'))
                                                <div class="invalid-feedback">
                                                    <span class="font-weight-bold"> {{ $errors->first('promoValue') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if($meal->foodType != 'Bebida')
                                            <div class="col-12 mt-3 col-md-6">
                                                <label style="color: black;" class="font-weight-bold">Ingredientes</label>
                                                @if($meal->ingredients == '')
                                                    <input type="text" class="form-control ingredientes-edit {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Item sem ingredientes" title="Insira-os separando por vírgula e sem dar espaços." name="ingredients" disabled style="cursor: not-allowed">
                                                @else
                                                    <input type="text" value="{{ $meal->ingredients }}" class="form-control ingredientes-edit {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Exemplo:Cebola,tomate,alface" title="Insira-os separando por vírgula e sem dar espaços." name="ingredients" required>
                                                @endif
                                                <label class="text-danger mt-2 verifica-ingredientes font-weight-bold" style="font-size: 13.7px">Insira-os separando por vírgulas e sem dar espaços.</label>
                                                @if($errors->has('ingredients'))
                                                    <div class="invalid-feedback">
                                                        <span class="font-weight-bold"> {{ $errors->first('ingredients') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="col-12 mt-3 col-md-6">
                                                <label style="color: black;" class="font-weight-bold">Sabores</label>
                                                <input type="text" value="{{ $meal->tastes }}" class="form-control sabores-edit" placeholder="Exemplo:Uva,Morango,Laranja" title="Insira-os separando por vírgula e sem dar espaços." name="sabores" required>
                                                <label class="text-danger mt-2 verifica-ingredientes font-weight-bold" style="font-size: 13.7px">Insira-os com a primeira letra maiúscula, separando por vírgulas e sem dar espaços.</label>
                                                @if($errors->has('tastes'))
                                                    <div class="invalid-feedback">
                                                        <span class="font-weight-bold"> {{ $errors->first('tastes') }}</span>
                                                    </div>
                                                @endif

                                                @if($errors->has('ingredients'))
                                                    <div class="invalid-feedback">
                                                        <span class="font-weight-bold"> {{ $errors->first('ingredients') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endif

{{--                                    <div class="col-12 mt-3 col-md-6">--}}
{{--                                        <label class="text-muted font-weight-bold">Ingredientes</label>--}}
{{--                                        @if($meal->ingredients == '')--}}
{{--                                        <input type="text" class="form-control ingredientes-edit {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Item sem ingredientes" title="Insira-os separando por vírgula e sem dar espaços." name="ingredients" disabled style="cursor: not-allowed">--}}
{{--                                        @else--}}
{{--                                            <input type="text" value="{{ $meal->ingredients }}" class="form-control ingredientes-edit {{ ($errors->has('ingredients') ? 'is-invalid' : '') }}" placeholder="Exemplo:Cebola,tomate,alface" title="Insira-os separando por vírgula e sem dar espaços." name="ingredients" required>--}}
{{--                                        @endif--}}
{{--                                        <label class="text-danger mt-2 verifica-ingredientes font-weight-bold" style="font-size: 13.7px">Insira-os separando por vírgulas e sem dar espaços.</label>--}}
{{--                                        @if($errors->has('ingredients'))--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                <span class="font-weight-bold"> {{ $errors->first('ingredients') }}</span>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}


                                    @if($meal->foodType == 'Hamburguer')
                                        <div class="col-4 mt-3 itr">
                                            <label style="color: black" class="font-weight-bold mb-3">Itens que poderão ser adicionados.</label>
                                            <br>
                                            @if(isset($count))
                                                @foreach($count as $c => $v)
                                                    @if($v == 2)
                                                        <input type="checkbox" class="form-check-input ml-1 cameFromDB" id="{{ $c }}" value="{{ $c }}" checked name="extras[]">
                                                        <label class="form-check-label ml-4" for="{{ $c }}">{{ $c }}</label><br>
                                                    @else
                                                        <input type="checkbox" class="form-check-input ml-1 atual" id="{{ $c }}" value="{{ $c }}" name="extras[]">
                                                        <label class="form-check-label ml-4" for="{{ $c }}">{{ $c }}</label><br>
                                                    @endif
                                                @endforeach
                                            @else
                                                <label class="font-weight-bold text-danger mb-3">Você deverá primeiro cadastrar os itens adicionais antes de cadastrar uma refeição</label>
                                            @endif
                                        </div>
                                    @endif


                                    <div class="col-12 mt-3">
                                        <label style="color: black;" class="font-weight-bold">Descrição</label>
                                        <textarea name="mealDescription" title="Breve texto que informa as características da refeição. O texto deve conter no mínimo 70 e no máximo 96 caracteres." cols="20" rows="5" style="resize: none" class="form-control descricao-edit {{ ($errors->has('mealDescription') ? 'is-invalid' : '') }}" required> {{$meal->description}}</textarea>
                                        <label class="text-primary font-weight-bold mt-2 total-char">Total de caracteres: <span class="contagem font-weight-bolder"></span></label><br>
                                        <label class="text-primary font-weight-bold lbl-alerta">A descrição deve conter no mínimo 70 e no máximo 96 caracteres.</label>
                                        @if($errors->has('mealDescription'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('mealDescription') }}</span>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="col-12 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Foto (Alterar)</label>
                                        <input type="file" name="updPhoto" accept=".png, .jpg, .jpeg, .gif">
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" style="color: black" id="TituloModalCentralizado">Quase lá!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: black">Tem certeza que deseja salvar as alterações? Revise-as antes de salvar.</p>
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


