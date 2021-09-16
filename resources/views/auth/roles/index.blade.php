@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Perfis de Usuário
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
                <strong>Tudo certo!</strong> {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('msg-2'))
            <div class="alert alert-danger sumir-feedback alert-dismissible fade show" role="alert">
                <strong>Tudo certo!</strong> {{ session('msg-2') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Novo perfil</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('roles.store') }}" method="post">
                                        @csrf
                                        <label class="font-weight-bold" style="color: black">Nome do perfil</label>
                                        <input type="text" class="form-control" name="profile">
                                        <button type="submit" class="btn btn-success float-right mt-3">Cadastrar</button>
                                    </form>
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('routeAuthLock') }}" class="text-danger font-weight-bold"><i class="fas fa-user-lock mr-2"></i>Encerrar Sessão</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Lista de perfis</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col" style="color: black">Perfil</th>
                                            <th scope="col" style="color: black">Tratativas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $r)
                                            <tr style="cursor: pointer">
                                                <td>{{ $r['name'] }}</td>
                                                <td>
                                                    <form action="{{ route('roles.destroy', $r['id']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$r['id']}}" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                                        <button type="submit" class="btn btn-danger" title="Deletar"><i class="fas fa-trash"></i></button>
                                                        <a href="{{ route('rolePermissions', ['role' => $r['id']]) }}" class="btn btn-info">Permissões</a>
                                                    </form>

                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $r['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel" style="color: black">Alteração de Funcionalidade</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <form action="{{ route('roles.update', $r['id']) }}" method="post" class="form-group">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="text" class="form-control" style="color: black; margin-top: -15px" value="{{ $r['name'] }}" name="profile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>
                                                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        window.onbeforeunload = confirmar_saida;

        function confirmar_saida()
        {
            return 'Deseja sair do site?';
        }
    </script>
@endsection


