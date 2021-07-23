@extends('layouts.extend')

@section('title')
    Gestão de funcionários
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <div class="alert alert-success alerta-sucesso-user alert-dismissible fade show" role="alert">
                       <span class="text-muted font-weight-bold">{{ session('msg') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    @if(session('msg-2'))
                        <div class="alert alert-danger alerta-sucesso-user alert-dismissible fade show" role="alert">
                            <span class="text-muted font-weight-bold">{{ session('msg-2') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Funcionários cadastrados</div>

                    <div class="card-body first-table">

                        <div class="mb-1 d-flex justify-content-end">
                            <a href="{{ route('usuario.create') }}" class="cadastrar-link">
                                <i class="fas fa-user-plus"></i>
                                <label class="ml-1 cadastrar-link">Cadastrar funcionário</label>
                            </a>
                        </div>

                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Perfil de usuário</th>
                                <th scope="col">Perfis</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="font-weight-bold"><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->name }} {{ $employee->surname }}</a></td>
                                    <td class="font-weight-bold"><a href="{{ route('usuario.show', $employee->id) }}" style="text-decoration:none; color:rgba(0,0,0,0.73);">{{ $employee->occupation }}</a></td>
                                    <td class="font-weight-bold"><a href="{{ route('usuario.show', $employee->id) }}" style="text-decoration:none; color:rgba(0,0,0,0.73);">{{ $employee->profile }}</a></td>
                                    <td class="font-weight-bold"><a href="{{ route('userRoles', ['user' => $employee->id]) }}" class="btn btn-info" style="text-decoration:none; color:whitesmoke;">Perfis</a></td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
