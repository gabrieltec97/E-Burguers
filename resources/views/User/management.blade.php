@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Gestão de funcionários
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Funcionário cadastrado!',
                            showCancelButton: false,
                            showConfirmButton: false,
                            html:'<button type="button" class="btn btn-success mt-2 configureProfile">Configurar perfil</button>'
                        });

                        $(".configureProfile").on("click", function (){
                            window.location.href = '/E-Pedidos/public/user/{{ session('msg') }}/roles';
                            console.log('click');
                        });
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
                        <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">Funcionários cadastrados</div>

                    <div class="card-body first-table">

                        <div class="mb-1">
                            <a href="{{ route('usuario.create') }}" title="Cadastre um novo funcionário para usar o sistema" class="cadastrar-link" style="cursor: pointer; text-decoration: none;">
                                <i class="fas fa-user-plus"></i>
                                <label class="ml-1 cadastrar-link font-weight-bold" style="cursor: pointer;">Novo funcionário</label>
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
                                    <td><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->name }} {{ $employee->surname }}</a></td>
                                    <td><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->phone }} </a></td>
                                    <td><a style="color:rgba(0,0,0,0.73); text-decoration: none" href="{{ route('usuario.show', $employee->id) }}">{{ $employee->workingTime }} </a></td>
                                    <td><a href="{{ route('userRoles', ['user' => $employee->id]) }}" class="btn btn-info" style="text-decoration:none; color:whitesmoke;">Configurar perfil</a></td>
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
