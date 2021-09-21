@extends('layouts.extend')

@section('title')
    Cadastros de entregadores
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Registro cadastrado com sucesso!',
                })
            </script>
        @endif

        @if(session('msg-2'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Entregador não cadastrado!',
                    text: 'Já existe um entregador cadastrado com este nome, consulte a lista de entregadores cadastrados.',
                })
            </script>
        @endif

        @if(session('msg-3'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Registro deletado com sucesso!'
                })
            </script>
        @endif

        @if(session('msg-4'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registro não alterado',
                    text: 'Já existe um entregador cadastrado com este nome.',
                })
            </script>
        @endif

        @if(session('msg-5'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Registro atualizado com sucesso!',
                })
            </script>
        @endif

        @if(session('msg-6'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Nada a ser alterado!',
                    text: 'Você não fez alterações no registro.',
                })
            </script>
        @endif

        @if(session('msg-7'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registro não alterado!',
                    text: 'O nome do entregador deve conter no mínimo 5 e no máximo 45 caracteres.',
                })
            </script>
        @endif

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Novo cadastro</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('entregadores.store') }}" method="post">
                                        @csrf
                                        <label class="font-weight-bold" style="color: black">Nome do entregador</label>
                                        <input type="text" autocomplete="off" class="form-control {{ ($errors->has('name') ? 'is-invalid' : '') }}" value="{{ old('name') }}" name="name" required>
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('name') }}</span>
                                            </div>
                                        @endif

                                        <button type="submit" class="btn btn-success float-right mt-3 cadastrar-taxa">Cadastrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Lista de entregadores</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col" style="color: black">Nome</th>
                                            <th scope="col" style="color: black">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deliveryMen as $d => $man)
                                            <tr style="cursor: pointer">
                                                <td class="font-weight-bold"><a href="{{ route('entregadores.show', $man->id) }}" style="text-decoration: none; color: black">{{ $man->name }}</a></td>
                                                <td>
                                                    <form id="destroyArea{{ $man->id }}" action="{{ route('entregadores.destroy', $man->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $man->id }}" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                                        <button type="button" class="btn btn-danger" title="Deletar" onclick="deletarRegistro({{ $man->id }})"><i class="fas fa-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>

                                            <script>
                                                function deletarRegistro(id){
                                                    Swal.fire({
                                                        icon: 'question',
                                                        showConfirmButton: false,
                                                        title: 'Deseja deletar este registro?',
                                                        html: '<button type="button" class="btn btn-primary fechar" title="Sair">Sair</button> ' +
                                                            '<button type="button" class="btn btn-danger send-delete-area-form" title="Deletar">Deletar</button>',
                                                    })

                                                    $(".fechar").on('click', function (){
                                                        Swal.close()
                                                    })

                                                    $(".send-delete-area-form").on('click', function (){
                                                        $(this).html('<div class="spinner-border text-light" role="status"></div>');
                                                        $("#destroyArea" + id).submit();
                                                    })
                                                }

                                            </script>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $man->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel" style="color: black">Alteração de dados.</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <form action="{{ route('entregadores.update', $man->id) }}" method="post" class="">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label class="font-weight-bold" style="color: black;">Nome do entregador</label>
                                                                        <input type="text" class="form-control mt-1" style="color: black;" autocomplete="off" value="{{ $man->name }}" name="name" required>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>
                                                            <button type="submit" class="btn btn-success editar-area">Salvar Alterações</button>
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


