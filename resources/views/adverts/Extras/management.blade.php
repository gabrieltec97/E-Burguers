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
        <div class="row">
            <div class="col-lg-6 col-12 col-sm-12">

                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Novo item adicional</div>

                    <div class="card-body">
                        <form action="#">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="font-weight-bold">Nome</label>
                                    <input type="text" class="form-control nome-item-add" placeholder="Nome do item" name="name" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('name') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label class="font-weight-bold">Valor</label>
                                    <input type="text" class="form-control valor-item-add" placeholder="R$" name="value" required>
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection


