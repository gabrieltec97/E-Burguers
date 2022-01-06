@extends('layouts.extend-client')

@section('title')
    Meus dados cadastrais
@endsection

@section('content')

    @if(session('msg'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Tudo certo!',
                text: '{{ session('msg') }}',
            })
        </script>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-5 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header font-weight-bold" style="font-size: 25px; color: white; background-color: #343a40">Meus dados cadastrais</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="{{ route('usuario.update', $data['id']) }}" method="post" class="form-group">
                                @csrf
                                @method('PUT')
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Nome</label>
                                    <input type="text" class="form-control {{ ($errors->has('empName') ? 'is-invalid' : '') }}" name="empName" value="{{ $user != 'funcionario' ? $data['name'] : ''}}" required>
                                    @if($errors->has('empName'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empName') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Sobrenome</label>
                                    <input type="text" class="form-control {{ ($errors->has('empSurname') ? 'is-invalid' : '') }}" name="empSurname" value="{{ $user != 'funcionario' ? $data['surname'] : ''}}" required>
                                    @if($errors->has('empSurname'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empSurname') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Telefone(fixo)</label>
                                    <input type="text" class="form-control {{ ($errors->has('empFixedPhone') ? 'is-invalid' : '') }}" name="empFixedPhone" value="{{ $user != 'funcionario' ? $data['fixedPhone'] : ''}}">
                                    @if($errors->has('empFixedPhone'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empFixedPhone') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Telefone</label>
                                    <input type="text" class="form-control {{ ($errors->has('empPhone') ? 'is-invalid' : '') }}" name="empPhone" value="{{ $user != 'funcionario' ? $data['phone'] : ''}}" required>
                                    @if($errors->has('empPhone'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empPhone') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">E-mail</label>
                                    <input type="text" class="form-control {{ ($errors->has('empEmail') ? 'is-invalid' : '') }}" name="empEmail" value="{{ $user != 'funcionario' ? $data['email'] : ''}}" required>
                                    @if($errors->has('empEmail'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empEmail') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Endereço</label>
                                    <input type="text" class="form-control {{ ($errors->has('empAddress') ? 'is-invalid' : '') }}" name="empAddress" value="{{ $user != 'funcionario' ? $data['address'] : ''}}" required>
                                    @if($errors->has('empAddress'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('empAddress') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Nº da residência</label>
                                    <input type="text" class="form-control {{ ($errors->has('adNumber') ? 'is-invalid' : '') }}" name="adNumber" value="{{ $user != 'funcionario' ? $data['adNumber'] : ''}}" required required>

                                    @if($errors->has('adNumber'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('adNumber') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Ponto de referência</label>
                                    <input type="text" class="form-control {{ ($errors->has('refPoint') ? 'is-invalid' : '') }}" name="refPoint" value="{{ $user != 'funcionario' ? $data['refPoint'] : ''}}" required>
                                    @if($errors->has('refPoint'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('refPoint') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label style="color: black;" class="font-weight-bold">Bairro</label>
                                    <select name="district" class="form-control">
                                        @foreach($neighboor as $n => $value)
                                            <option value="{{ $value->name }}" {{ $value->name == $data['district'] ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary salvar-alt-client">Salvar Alterações</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


