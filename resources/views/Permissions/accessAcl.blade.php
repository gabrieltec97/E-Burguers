@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/accessAcl.js') }}"></script>

@section('title')
    Rota não permitida
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="card" style="width: 38rem;">
                    <div class="card-header">
                        <span class="font-weight-bold" style="color: black;">Rota não permitida para seu usuário.</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('routeAuthLogin') }}" method="post">
                            @csrf
                            <label class="font-weight-bold" style="color: black;">Senha de acesso:</label>
                            <input type="password" class="form-control" name="password">

                            <button class="btn btn-primary mt-3 float-right">Acessar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary modalACLroute" style="margin-left: 550px; margin-top: -30px" data-toggle="modal" data-target="#modalACLroute"></button>

    <!-- Modal -->
    <div class="modal fade" id="modalACLroute" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Atenção!</h5>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <span style="color: black;" class="font-weight-bold warn-message">
                        Esta é uma rota de administração do sistema <span class="text-danger">e só deve ser acessada pela Agência Flight Digital.</span>
                        Por favor, volte para o acesso comum do sistema de acordo com as orientações de uso e manual do usuário.
                    </span>
                </div>
                <div class="modal-footer">
                    <a type="button" href="{{ route('home') }}" class="btn btn-success">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection


