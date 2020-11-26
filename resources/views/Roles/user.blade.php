@extends('layouts.extend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Meus dados cadastrais</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="text-muted font-weight-bold">Nome</label>
                                    <input type="text" class="form-control"disabled>
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Sobrenome</label>
                                    <input type="text" class="form-control"disabled>
                                </div>

                                <div class="col-12 mt-3 mt-md-0 col-md-4">
                                    <label class="text-muted font-weight-bold">Telefone</label>
                                    <input type="text" class="form-control"disabled>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Endereço</label>
                                    <input type="text" class="form-control"disabled>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">E-mail</label>
                                    <input type="text" class="form-control"disabled>
                                </div>

                                <div class="col-12 mt-3 col-md-4">
                                    <label class="text-muted font-weight-bold">Cargo</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection


