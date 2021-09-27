@extends('layouts.extend')

@section('title')
    Cadastro de funcionário
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">Novo funcionário</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('usuario.store') }}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Nome</label>
                                        <input type="text" placeholder="Apenas o nome" class="form-control {{ ($errors->has('empName') ? 'is-invalid' : '') }}" name="empName" value="{{ old('empName') }}" required>
                                        @if($errors->has('empName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empName') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Sobrenome(s)</label>
                                        <input type="text" class="form-control {{ ($errors->has('empSurname') ? 'is-invalid' : '') }}" name="empSurname" value="{{ old('empSurname') }}" required>
                                        @if($errors->has('empSurname'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empSurname') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Telefone</label>
                                        <input type="text" placeholder="(xx) xxxxx-xxxx" class="form-control user-Phone {{ ($errors->has('empPhone') ? 'is-invalid' : '') }}" name="empPhone" value="{{ old('empPhone') }}" required>
                                        @if($errors->has('empPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Telefone fixo (Opcional)</label>
                                        <input type="text" placeholder="(xx) xxxx-xxxx" class="form-control userFixedPhone {{ ($errors->has('empFixedPhone') ? 'is-invalid' : '') }}" name="empFixedPhone">
                                        @if($errors->has('empFixedPhone'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empFixedPhone') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Endereço</label>
                                        <input type="text" class="form-control {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="empAddress" value="{{ old('empAddress') }}" required>
                                        @if($errors->has('empAddress'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empAddress') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Bairro (Modo cliente)</label>
                                        <select class="form-control {{ ($errors->has('district') ? 'is-invalid' : '') }}" name="district" required>
                                            <option value="" selected hidden>Selecione</option>
                                            @foreach($places as $place)
                                                <option value="{{ $place->name }}" {{ old('district') == $place->name ? 'selected' : '' }}>{{ $place->name }}</option>
                                            @endforeach
                                            <option value="FORA DA ÁREA DE ENTREGAS">FORA DA ÁREA DE ENTREGAS</option>
                                        </select>

                                        @if($errors->has('bairro'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('bairro') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Horário de serviço</label>
                                        <input type="text" placeholder="xx:xx - xx:xx" class="form-control empHour {{ ($errors->has('empWorkingTime') ? 'is-invalid' : '') }}" name="empWorkingTime" value="{{ old('empWorkingTime') }}" required>
                                         @if($errors->has('empWorkingTime'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('empWorkingTime') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold empEmail" style="color: black">E-mail</label>
                                        <input type="email" class="form-control empEmail" name="empEmail" value="{{ old('empEmail') }}">
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Senha</label>
                                        <input type="password" class="form-control senha" name="empPassword" value="{{ old('empPassword') }}">
                                    </div>

                                    <div class="col-12 mt-5 d-flex justify-content-end" style="margin-bottom: -20px">
                                        <button type="submit" class="btn btn-primary cadastrar-funcionario"><i class="fas fa-user-plus mr-2"></i>Cadastrar funcionário</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Opa, não cadastrado!',
                text: 'Já existe um funcionário registrado com este e-mail.',
            })
        </script>
    @endif

@endsection


