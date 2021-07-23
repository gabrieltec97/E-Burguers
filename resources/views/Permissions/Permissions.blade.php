@extends('layouts.extend')

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
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Nova permissão</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('permissions.store') }}" method="post">
                                    @csrf
                                        <label class="font-weight-bold" style="color: black">Nome da funcionalidade</label>
                                        <input type="text" class="form-control" name="function">
                                        <button type="submit" class="btn btn-success float-right mt-3">Cadastrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Lista de permissões</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col" style="color: black">Funcionalidade</th>
                                                <th scope="col" style="color: black">Tratativas</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($function as $f)
                                            <tr style="cursor: pointer">
                                                <td>{{ $f['name'] }}</td>
                                                <td>
                                                    <form action="{{ route('permissions.destroy', $f['id']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$f['id']}}">Editar</button>
                                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                                    </form>

                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$f['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <form action="{{ route('permissions.update', $f['id']) }}" method="post" class="form-group">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="text" class="form-control" style="color: black; margin-top: -15px" value="{{$f['name']}}" name="function">
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
@endsection


