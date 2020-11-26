@extends('layouts.extend')

@section('title')
    Cadastro de funcionário
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Dados do funcionário</div>

                    <div class="card-body">
                        <div class="container-fluid">
                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-lg-5">
                                        <img src="{{ asset('logo/user.png') }}" class="img-fluid" alt="">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Nome:</span><span class="text-primary"> {{ $user['name'] }} {{ $user['surname'] }}</span></label><br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Cargo:</span><span class="text-primary"> {{ $user['occupation'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Perfil de usuário:</span><span class="text-primary"> {{ $user['profile'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Endereço:</span><span class="text-primary"> {{ $user['address'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Telefone:</span><span class="text-primary"> {{ $user['phone'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Telefone fixo:</span><span class="text-primary"> {{ ($user['fixedPhone'] != '') ? $user['fixedPhone']: 'Não informado' }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Perfil de usuário:</span><span class="text-primary"> {{ $user['profile'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">E-mail:</span><span class="text-primary"> {{ ($user['email'] == '')?'Não informado': $user['email'] }}</span></label>
                                        <br>
                                        <label class="text-muted font-weight-bold"><span style="font-size: 16px" class="text-muted font-weight-bold">Horário de trabalho:</span><span class="text-primary"> {{ $user['workingTime'] }}</span></label>
                                        <br>

                                        <a href="{{ route('usuario.edit', $user['id']) }}" class="btn btn-primary mt-5 float-right"><i class="fas fa-user-edit mr-2"></i>Editar dados cadastrais</a>
                                    </div>


                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


