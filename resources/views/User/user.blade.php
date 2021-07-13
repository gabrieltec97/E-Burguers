@extends('layouts.extend')

@section('title')
    Meus dados cadastrais
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Meus dados cadastrais</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="text-muted font-weight-bold">Nome</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->name }}" readonly>
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Sobrenome</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->surname }}" readonly>
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Telefone</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->phone }}" readonly>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Endereço</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->address }}" readonly>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">E-mail</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->email }}"  readonly>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Cargo</label>
                                    <input type="text" class="form-control campo" value="{{ $myUser[0]->occupation }}"  readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-box"></div>
            <div class="div-box">
                <div class="card">
                    <div class="card-header text-danger font-weight-bold d-flex" style="font-size: 22px">
                        <i class="fas fa-exclamation-triangle mt-1"></i>&nbsp; Aviso
                    </div>
                    <div class="card-body">
                        <p class="text-muted font-weight-bold mb-4">Por questões de segurança, você pode alterar
                        apenas a sua foto de perfil. Caso queira alterar seus dados cadastrais, entre em contato
                        com o administrador do sistema.</p>
                        <p class="d-flex justify-content-end mb-0"><a href="#" class="btn btn-primary sair">Compreendi</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


