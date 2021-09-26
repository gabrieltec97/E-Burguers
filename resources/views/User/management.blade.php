@extends('layouts.extend')

@section('title')
    Gestão de funcionários
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Tudo certo!',
                            text: '{{ session('msg') }}',
                        })
                    </script>
                @endif

                @if(session('msg-2'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Tudo certo!',
                            text: '{{ session('msg-2') }}',
                        })
                    </script>
                @endif

                @if(session('msg-not'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Não permitido!',
                            text: '{{ session('msg-not') }}',
                        })
                    </script>
                @endif
                <div class="card">
                        <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: #2E21ED">Funcionários cadastrados</div>

                    <div class="card-body first-table">

                        <div class="mb-1 d-flex justify-content-end">
                            <a href="{{ route('usuario.create') }}" title="Cadastre um novo funcionário para usar o sistema" class="cadastrar-link" style="cursor: pointer; text-decoration: none;">
                                <i class="fas fa-user-plus"></i>
                                <label class="ml-1 cadastrar-link font-weight-bold" style="cursor: pointer;">Cadastrar funcionário</label>
                            </a>
                        </div>

                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col" style="color: black;">Nome</th>
                                <th scope="col" style="color: black;">Telefone</th>
                                <th scope="col" style="color: black;">Horário de serviço</th>
                                <th scope="col" style="color: black;">Perfis de usuário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="font-weight-bold"><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->name }} {{ $employee->surname }}</a></td>
                                    <td class="font-weight-bold"><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->phone }} </a></td>
                                    <td class="font-weight-bold"><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->workingTime }} </a></td>
                                    <td class="font-weight-bold"><a href="{{ route('userRoles', ['user' => $employee->id]) }}" class="btn btn-info" style="text-decoration:none; color:whitesmoke;">Configurar perfil</a></td>
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
