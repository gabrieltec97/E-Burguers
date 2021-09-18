@extends('layouts.extend')

@section('title')
    Edição de dados cadastrais
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Edição dos dados do funcionário</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('usuario.update', $user->id) }}" method="post" class="form-group">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="text-muted font-weight-bold">Nome</label>
                                        <input type="text" class="form-control nome-funcionario {{ ($errors->has('empName') ? 'is-invalid' : '') }}" name="empName" value="{{ $user->name }}" required>
                                        @if($errors->has('empName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Sobrenome(s)</label>
                                        <input type="text" class="form-control sobrenome-funcionario {{ ($errors->has('empSurname') ? 'is-invalid' : '') }}" value="{{ $user->surname }}" name="empSurname" required>
                                        @if($errors->has('empSurname'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empSurname') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Telefone</label>
                                        <input type="tel" class="form-control telFuncionario {{ ($errors->has('empPhone') ? 'is-invalid' : '') }}" value="{{ $user->phone }}" name="empPhone" required>
                                        @if($errors->has('empPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Telefone fixo (Opcional)</label>
                                        <input type="tel" class="form-control fixoFuncionario" value="{{ $user->fixedPhone }}" name="empFixedPhone">
                                    </div>
                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Endereço</label>
                                        <input type="text" class="form-control enderecoFuncionario {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="empAddress" value="{{ $user->address }}" required>
                                        @if($errors->has('empAddress'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empAddress') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Horário de serviço</label>
                                        <input type="text" class="form-control horarioFuncionario {{ ($errors->has('empWorkingTime') ? 'is-invalid' : '') }}" name="empWorkingTime" value="{{ $user->workingTime }}" required>
                                        @if($errors->has('empWorkingTime'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empWorkingTime') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold empEmail">Senha</label>
                                        <input type="password" class="form-control senhaFuncionario" placeholder="Só digite aqui caso queira alterar a senha." name="empSenha" >
                                    </div>

                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Atenção!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold func-mudancas"></p>

                                                <img src="{{ asset('logo/cara.svg') }}" class="imagem-alteracao mt-2" style="width: 100px; margin-left: 40%; height: 100px" hidden>

                                                <div class="row">

                                                    <div class="col-6 div-nome-func" hidden>
                                                        <p class="font-weight-bold text-primary text-center">Nome do funcionário</p>
                                                        <p class="font-weight-bold text-center">Nome anterior: <span class="text-danger">{{ $user->name }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo nome: <span class="novo-nome text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-sobrenome-func" hidden>
                                                        <p class="font-weight-bold text-primary text-center">Sobrenome do funcionário</p>
                                                        <p class="font-weight-bold text-center">Sobrenome anterior: <span class="text-danger">{{ $user->surname }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo sobrenome: <span class="novo-Sobrenome text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-telefone-func" hidden>
                                                        <p class="font-weight-bold text-center">Telefone</p>
                                                        <p class="font-weight-bold text-center">Anterior: <span class="text-danger">{{ $user->phone }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo: <span class="novo-Telefone text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-telefoneFixo-func" hidden>
                                                        <p class="font-weight-bold text-center">Telefone Fixo</p>
                                                        <p class="font-weight-bold text-center">Anterior: <span class="text-danger fixo-anterior">{{ $user->fixedPhone }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo: <span class="novo-telefoneFixo text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-endereco-func" hidden>
                                                        <p class="font-weight-bold text-center">Endereço do funcionário</p>
                                                        <p class="font-weight-bold text-center">Endereço anterior: <span class="text-danger">{{ $user->address }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo endereço: <span class="novo-endereco text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-cargo-func" hidden>
                                                        <p class="font-weight-bold text-center">Cargo</p>
                                                        <p class="font-weight-bold text-center">Cargo anterior: <span class="text-danger">{{ $user->occupation }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo cargo: <span class="novo-cargo text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-perfilUsuario-func" hidden>
                                                        <p class="font-weight-bold text-center">Perfil de usuário</p>
                                                        <p class="font-weight-bold text-center">Anterior: <span class="text-danger">{{ $user->profile }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo: <span class="perfil-usuario text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-horárioServico-func" hidden>
                                                        <p class="font-weight-bold text-center">Horário de serviço</p>
                                                        <p class="font-weight-bold text-center">Horário anterior: <span class="text-danger">{{ $user->workingTime }}</span></p>
                                                        <p class="font-weight-bold text-center">Novo horário: <span class="horario-servico text-success"></span></p>
                                                    </div>


                                                    <div class="col-12 mt-4 div-senha-func" hidden>
                                                        <p class="font-weight-bold text-center"><span class="senha-do-func text-danger"></span></p>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-success botao-salvar">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 mt-4 d-flex justify-content-end" style="margin-bottom: -20px">
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter2" class="btn btn-danger salvar-alteracoes-func mb-3 mr-3 font-weight-bold"><i class="fas fa-trash-alt mr-2"></i>Deletar registro</button>
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary salvar-alteracoes-func mb-3 font-weight-bold"><i class="fas fa-user-plus mr-2"></i>Salvar alterações</button>
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
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Atenção!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <span class="text-danger font-weight-bold">
                        Você está deletando este registro do funcionário. Caso este seja um registro de funcionário que possui
                        acesso ao sistema, ao deletá-lo ele não terá mais acesso ao sistema. Tem certeza que deseja prosseguir?
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


