@extends('layouts.extend')

@section('title')
    Cadastro de funcionário
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Novo funcionário</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('usuario.store') }}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="text-muted font-weight-bold">Nome</label>
                                        <input type="text" placeholder="Apenas o nome" class="form-control {{ ($errors->has('empName') ? 'is-invalid' : '') }}" name="empName" value="{{ old('empName') }}" required>
                                        @if($errors->has('empName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Sobrenome(s)</label>
                                        <input type="text" class="form-control {{ ($errors->has('empSurname') ? 'is-invalid' : '') }}" name="empSurname" value="{{ old('empSurname') }}" required>
                                        @if($errors->has('empSurname'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empSurname') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="text-muted font-weight-bold">Telefone</label>
                                        <input type="text" placeholder="(xx) xxxxx-xxxx" class="form-control user-Phone {{ ($errors->has('empPhone') ? 'is-invalid' : '') }}" name="empPhone" value="{{ old('empPhone') }}" required>
                                        @if($errors->has('empPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Telefone fixo (Opcional)</label>
                                        <input type="text" placeholder="(xx) xxxx-xxxx" class="form-control userFixedPhone" name="empFixedPhone">
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Endereço</label>
                                        <input type="text" class="form-control {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="empAddress" value="{{ old('empAddress') }}" required>
                                        @if($errors->has('empAddress'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empAddress') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Horário de serviço</label>
                                        <input type="text" placeholder="xx:xx - xx:xx" class="form-control empHour {{ ($errors->has('empWorkingTime') ? 'is-invalid' : '') }}" name="empWorkingTime" value="{{ old('empWorkingTime') }}" required>
                                         @if($errors->has('empWorkingTime'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empWorkingTime') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold empEmail">E-mail</label>
                                        <input type="email" class="form-control empEmail" name="empEmail" value="{{ old('empEmail') }}">
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="text-muted font-weight-bold">Senha</label>
                                        <input type="text" class="form-control senha" name="empPassword">
                                    </div>

                                    <div class="col-12 mt-5 d-flex justify-content-end" style="margin-bottom: -20px">
                                        <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-user-plus mr-2"></i>Cadastrar funcionário</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-box"></div>
    <div class="div-box">
        <div class="card">
            <div class="card-header text-danger font-weight-bold d-flex" style="font-size: 22px">
                <i class="fas fa-exclamation-triangle mt-1"></i>&nbsp; Atenção
            </div>
            <div class="card-body">
                <p class="text-muted font-weight-bold mb-4">Você está criando um novo usuário e escolheu a opção "Administrador". O usuário de administrador
                tem o total controle do sistema, contendo permissões importantes que se mal usadas, podem acarretar
                em um descontrole e visualização de informações financeiras. Caso tenha marcado esta opção por acidente,
                basta voltar à caixa de Cargo(Usuário do sistema) e alterar. Caso contrário, basta fechar este alerta.</p>
                <p class="d-flex justify-content-end mb-0"><a href="#" class="btn btn-primary sair">Compreendi</a></p>
            </div>
        </div>
    </div>


    <button class="disparador">disparar</button>

@endsection


