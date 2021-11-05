@extends('layouts.extend-client')

@section('title')
    Meus dados cadastrais
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-5 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold" style="font-size: 25px; color: white; background-color: #565a5c">Meus dados cadastrais</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="text-muted font-weight-bold">Nome</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Sobrenome</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Telefone</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">E-mail</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Endereço</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Ponto de referência</label>
                                    <input type="text" class="form-control">
                                </div>

                                    <div class="col-12 mt-5">
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


