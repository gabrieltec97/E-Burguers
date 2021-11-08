@extends('layouts.extend')

@section('title')
    Edição de dados cadastrais
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">Edição dos dados do funcionário</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('usuario.update', $user->id) }}" method="post" class="form-group">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Nome</label>
                                        <input type="text" class="form-control nome-funcionario {{ ($errors->has('empName') ? 'is-invalid' : '') }}" name="empName" value="{{ $user->name }}" required>
                                        @if($errors->has('empName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Sobrenome(s)</label>
                                        <input type="text" class="form-control sobrenome-funcionario {{ ($errors->has('empSurname') ? 'is-invalid' : '') }}" value="{{ $user->surname }}" name="empSurname" required>
                                        @if($errors->has('empSurname'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empSurname') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Telefone</label>
                                        <input type="tel" class="form-control telFuncionario {{ ($errors->has('empPhone') ? 'is-invalid' : '') }}" value="{{ $user->phone }}" name="empPhone" required>
                                        @if($errors->has('empPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Telefone fixo (Opcional)</label>
                                        <input type="tel" class="form-control fixoFuncionario {{ ($errors->has('empFixedPhone') ? 'is-invalid' : '') }}" value="{{ $user->fixedPhone }}" name="empFixedPhone">
                                        @if($errors->has('empFixedPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empFixedPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Endereço</label>
                                        <input type="text" class="form-control enderecoFuncionario {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="empAddress" value="{{ $user->address }}" required>
                                        @if($errors->has('empAddress'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empAddress') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black;">Ponto de referência</label>
                                        <input type="text" class="form-control refPoint {{ ($errors->has('refPoint') ? 'is-invalid' : '') }}" name="refPoint" value="{{ $user->refPoint }}" required>
                                        @if($errors->has('refPoint'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('refPoint') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Nº da residência</label>
                                        <input type="text" class="form-control adNumber {{ ($errors->has('adNumber') ? 'is-invalid' : '') }}" name="adNumber" value="{{ $user->adNumber }}" required>
                                        @if($errors->has('adNumber'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('adNumber') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Bairro (Modo cliente)</label>
                                        <select class="form-control userDistrict" name="district" required>
                                            <option value="" selected hidden>Selecione</option>
                                            @foreach($places as $place)
                                                <option value="{{ $place->name }}" {{ $user->district == $place->name ? 'selected' : '' }}>{{ $place->name }}</option>
                                            @endforeach
                                            <option value="FORA DA ÁREA DE ENTREGAS" {{ $user->district == 'FORA DA ÁREA DE ENTREGAS' ? 'selected' : '' }}>FORA DA ÁREA DE ENTREGAS</option>
                                        </select>

                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold empEmail" style="color: black">E-mail</label>
                                        <input type="email" class="form-control empEmail2 {{ ($errors->has('empEmail') ? 'is-invalid' : '') }}" name="empEmail" value="{{ $user->email }}">
                                        @if($errors->has('empEmail'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empEmail') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold empEmail" style="color: black;">Senha</label>
                                        <input type="password" class="form-control senhaFuncionario" placeholder="Só digite aqui caso queira alterar a senha." name="empSenha" >
                                    </div>

                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5 class="font-weight-bold func-mudancas text-center mb-4" style="color: black"></h5>

                                                <img src="{{ asset('logo/cara.svg') }}" class="imagem-alteracao mt-2" style="width: 100px; margin-left: 40%; height: 100px" hidden>

                                                <div class="row">

                                                    <div class="col-6 div-nome-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Nome do funcionário</p>
                                                        <p class="text-center" style="color: black;">Nome anterior: <span class="text-danger">{{ $user->name }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo nome: <span class="novo-nome text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-refPoint" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Ponto de referência</p>
                                                        <p class="text-center" style="color: black;">Nome anterior: <span class="text-danger">{{ $user->refPoint }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo nome: <span class="novo-refPoint text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-adNumber" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Nº da residência</p>
                                                        <p class="text-center" style="color: black;">Nome anterior: <span class="text-danger">{{ $user->adNumber }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo nome: <span class="novo-adNumber text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-email-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">E-mail do funcionário</p>
                                                        <p class="text-center" style="color: black;">E-mail anterior: <span class="text-danger">{{ $user->email }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo E-mail: <span class="novo-email text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-bairro-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Bairro do funcionário</p>
                                                        <p class="text-center" style="color: black;">Bairro anterior: <span class="text-danger">{{ $user->district }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo bairro: <span class="novo-bairro text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-sobrenome-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Sobrenome do funcionário</p>
                                                        <p class="text-center" style="color: black;">Sobrenome anterior: <span class="text-danger">{{ $user->surname }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo sobrenome: <span class="novo-Sobrenome text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-telefone-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Telefone</p>
                                                        <p class="text-center" style="color: black;">Anterior: <span class="text-danger">{{ $user->phone }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo: <span class="novo-Telefone text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-telefoneFixo-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Telefone Fixo</p>
                                                        <p class="text-center" style="color: black;">Anterior: <span class="text-danger fixo-anterior">{{ $user->fixedPhone }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo: <span class="novo-telefoneFixo text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-endereco-func" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Endereço do funcionário</p>
                                                        <p class="text-center" style="color: black;">Endereço anterior: <span class="text-danger">{{ $user->address }}</span></p>
                                                        <p class="text-center" style="color: black;">Novo endereço: <span class="novo-endereco text-success"></span></p>
                                                    </div>

                                                    <div class="col-12 mt-4 div-senha-func" hidden>
                                                        <p class="font-weight-bold text-center"><span class="senha-do-func text-danger"></span></p>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                                                <button type="submit" class="btn btn-success botao-salvar">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end" style="margin-bottom: -20px">
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter2" class="btn btn-danger salvar-alteracoes-func mb-3 mr-3">Deletar registro</button>
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary salvar-alteracoes-func mb-3">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('usuario.destroy', $user->id) }}" method="post">
    @csrf
    @method('DELETE')
    <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #343A40">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="color: white; margin-bottom: -10px">Atenção!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <span style="color: black">
                        Você está deletando o registro deste usuário,
                          ao deletá-lo ele não terá mais acesso ao sistema. Tem certeza que deseja prosseguir?
                      </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger deletar-func">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection


