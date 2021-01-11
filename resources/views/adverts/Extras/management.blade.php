@extends('layouts.extend')

@section('title')
    Novo item adicional
@endsection

@section('content')

    <div class="container">
    @if(session('msg'))
        <div class="alert alert-success alerta-sucesso-ref alert-dismissible fade show" role="alert">
            <span class="text-muted font-weight-bold">{{ session('msg') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        @if(session('msg-2'))
            <div class="alert alert-danger alerta-sucesso-ref alert-dismissible fade show" role="alert">
                <span class="text-muted font-weight-bold">{{ session('msg-2') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-12 col-sm-12">

                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Novo item adicional</div>

                    <div class="card-body">
                        <form action="{{ route('itensAdicionais.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="font-weight-bold">Nome</label>
                                    <input type="text" class="form-control nome-item-add {{ ($errors->has('name') ? 'is-invalid' : '') }}" placeholder="Nome do item" name="name">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('name') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label class="font-weight-bold">Valor</label>
                                    <input type="text" class="form-control valor-item-add {{ ($errors->has('value') ? 'is-invalid' : '') }}" placeholder="R$" name="value" required>
                                    @if($errors->has('value'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('value') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success font-weight-bold cadastrar-item-add"><i class="fas fa-plus mr-2"></i>Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mt-4 mt-lg-0 col-sm-12">

                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Itens cadastrados</div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($items))
                                @foreach($items as $item)
                                    <tr>
                                        <th>{{ $item->name }}</th>
                                        <td>{{ $item->price }}</td>
                                        <td style="cursor: pointer">
                                            <i class="fas fa-trash-alt mr-3 text-danger editar-item" title="Deletar item" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"></i>
                                            <i class="fas fa-edit text-info editar-item" title="Editar item" data-toggle="modal" data-target="#exampleModalCenterEdit{{$item->id}}"></i>
                                        </td>
                                    </tr>

                                    <form action="{{ route('itensAdicionais.destroy', $item->id) }}" class="form-group" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Um momento..</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 text-center">
                                                                <label class="font-weight-bold text-center" style="color: black">Tem certeza que deseja deletar este item?</label>
                                                            </div>

                                                            <div class="col-12 mt-2">
                                                                <label class="text-success font-weight-bold">Item:</label>
                                                                <label class="text-primary font-weight-bold">{{$item->name}}</label>
                                                            </div>

                                                            <div class="col-12 mt-2">
                                                                <label class="text-success font-weight-bold">Valor:</label> <label class="text-primary font-weight-bold">{{$item->price}}</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Voltar</button>
                                                        <button type="submit" class="btn btn-danger font-weight-bold">Deletar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form action="{{ route('itensAdicionais.update', $item->id) }}" class="form-group" method="post">
                                    @csrf
                                    @method('PUT')
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenterEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Edição de item adicional.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label class="font-weight-bold">Nome</label>
                                                                <input type="text" class="form-control nome-item-add-edit" name="name" value="{{ $item->name }}" placeholder="Nome do item">
                                                            </div>

                                                            <div class="col-12 col-lg-6">
                                                                <label class="font-weight-bold">Valor</label>
                                                                <input type="text" class="form-control valor-item-add-edit" name="price" value="{{ $item->price }}" placeholder="R$">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Voltar</button>
                                                        <button type="submit" class="btn btn-primary edit-item-add font-weight-bold">Salvar alterações</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection


