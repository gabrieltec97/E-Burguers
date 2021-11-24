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
                            <form action="{{ route('refeicoes.update', $meal->id) }}" method="post" class="form-group form-refeicao" enctype="multipart/form-data">
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

                                        @if($meal->foodType == 'Bebida')
                                            <div class="col-12 mt-3 col-md-6">
                                                <label style="color: black;" class="font-weight-bold">Sabores</label>
                                                <input type="text" value="{{ $meal->tastes }}" class="form-control sabores-edit" placeholder="Exemplo:Uva,Morango,Laranja" title="Insira-os separando por vírgula e sem dar espaços." name="sabores">
                                                <label class="text-danger mt-2 verifica-ingredientes font-weight-bold" style="font-size: 13.7px">Insira-os com a primeira letra maiúscula, separando por vírgulas e sem dar espaços.</label>
                                                @if($errors->has('tastes'))
                                                    <div class="invalid-feedback">
                                                        <span class="font-weight-bold"> {{ $errors->first('tastes') }}</span>
                                                    </div>
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

                                    <div class="col-12  col-md-4">
                                        <label class="font-weight-bold" style="color: black">Foto (Alterar)</label>
                                        <input type="file" name="advPhoto" accept=".png, .jpg, .jpeg, .gif">
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header" style="background-color: #343a40">
                                                <h5 class="modal-title font-weight-bold" style="color: white;" id="TituloModalCentralizado">Quase lá!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: black">Tem certeza que deseja salvar as alterações? Revise-as antes de salvar.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success close-here" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-primary salvar-agora">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end">
                            <button type="button" class="mr-3 btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter2"><i class="fas fa-trash-alt mr-2"></i>Deletar anúncio</button>
                            <button type="button" class="btn-alterar-refeicao btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado"><i class="fas fa-plus mr-2"></i>Salvar alterações</button>
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


