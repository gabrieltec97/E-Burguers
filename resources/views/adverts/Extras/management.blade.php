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
                                    <input type="text" class="form-control" placeholder="Nome do item" required>
                                </div>

                                <div class="col-6">
                                    <label class="font-weight-bold">Valor</label>
                                    <input type="text" class="form-control" placeholder="R$" required>
                                </div>

                                <div class="col-12 mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success font-weight-bold"><i class="fas fa-plus mr-2"></i>Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


