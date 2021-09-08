@extends('layouts.extend')

@section('title')
    Áreas de entrega
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Bairro cadastrado com sucesso!',
                })
            </script>
        @endif

        @if(session('msg-2'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Bairro não cadastrado!',
                    text: 'Já existe um bairro cadastrado com este nome, consulte a lista de bairros atendidos.',
                })
            </script>
        @endif

        @if(session('msg-3'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Item deletado com sucesso!'
                })
            </script>
        @endif

        @if(session('msg-4'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registro não alterado',
                    text: 'Você inseriu um valor inválido para taxa de entrega.',
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
                    text: 'Já existe um bairro cadastrado com este nome. Consulte a lista de bairros atendidos.',
                })
            </script>
        @endif

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Novo local atendido</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('locaisDeEntrega.store') }}" method="post">
                                        @csrf
                                        <label class="font-weight-bold" style="color: black">Nome do bairro</label>
                                        <input type="text" autocomplete="off" class="form-control {{ ($errors->has('bairro') ? 'is-invalid' : '') }}" value="{{ old('bairro') }}" name="bairro" required>
                                        @if($errors->has('bairro'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('bairro') }}</span>
                                            </div>
                                        @endif

                                        <label class="font-weight-bold mt-2" style="color: black">Taxa de entrega</label>
                                        <input type="text" autocomplete="off" class="form-control taxaEntrega {{ ($errors->has('taxa') ? 'is-invalid' : '') }}" value="{{ old('taxa') }}" name="taxa" required>
                                        @if($errors->has('taxa'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('taxa') }}</span>
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
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Lista de bairros atendidos</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col" style="color: black">Id</th>
                                            <th scope="col" style="color: black">Nome</th>
                                            <th scope="col" style="color: black">Valor</th>
                                            <th scope="col" style="color: black">Tratativas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($places as $place => $data)
                                            <tr style="cursor: pointer">
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td>
                                                    <form id="destroyArea{{ $data->id }}" action="{{ route('locaisDeEntrega.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $data->id }}" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                                        <button type="button" class="btn btn-danger" title="Deletar" onclick="deletarRegistro({{ $data->id }})"><i class="fas fa-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>

                                            <script>
                                                function deletarRegistro(id){
                                                    Swal.fire({
                                                        icon: 'info',
                                                        showConfirmButton: false,
                                                        title: 'Deseja deletar o registro ' + id + ' ?',
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
                                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <form action="{{ route('locaisDeEntrega.update', $data->id) }}" method="post" class="">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label class="font-weight-bold" style="color: black;">Nome do bairro</label>
                                                                        <input type="text" class="form-control mt-1" style="color: black;" autocomplete="off" value="{{ $data->name }}" name="bairro" required>

                                                                        <label class="font-weight-bold mt-2" style="color: black">Taxa de entrega</label>
                                                                        <input type="text" class="form-control mt-1 taxaEntrega" autocomplete="off" style="color: black;" value="{{ $data->price }}" name="taxa" required>
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


