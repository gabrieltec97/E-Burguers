@extends('layouts.app')
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="https://kit.fontawesome.com/e656fe6405.js" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card recover-card" style="border: none;">
                    <div class="card-header bg-primary" style="color: white">Atualizar senha</div>

                    <div class="card-body">
                        <div class="container">
                            <form method="POST" action="{{ route('redefinir') }}">
                                @csrf

                                <div class="row">

                                    <div class="col-12 col-lg-3">
                                        <label for="email" class="font-weight-bold">E-mail:</label>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" value="{{ old('email') }}" class="form-control w-100" name="email" required>
                                    </div>

                                    <div class="col-12 col-lg-3 mt-3">
                                        <label for="code" class="font-weight-bold">Código:</label>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" value="{{ old('code') }}" class="form-control w-100" name="code" required>
                                    </div>

                                    <div class="col-12 col-lg-3 mt-3">
                                        <label for="password" class="font-weight-bold">Senha:</label>
                                    </div>

                                    <div class="col-12">
                                        <input type="password" value="{{ old('password') }}" class="form-control w-100 n-pass" name="password" required>
                                    </div>

                                    <div class="col-12 col-lg-5 mt-3">
                                        <label for="confirm" class="font-weight-bold">Confirmar senha:</label>
                                    </div>

                                    <div class="col-12">
                                        <input type="password" value="{{ old('confirm') }}" onkeyup="checkPassword()" class="mb-2 form-control w-100 confirm-pass" name="confirm" required>
                                        <span class="text-danger check-pass" hidden><i class="fas fa-ban"></i> As senhas estão diferentes.</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary send-mail" style="margin-bottom: -20px;">Redefinir senha</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-send'))
        <script>
            Swal.fire({
                title: 'Verifique seu e-mail',
                text: 'Foi enviado um código para o seu e-mail. Caso não encontre-o, verifique na caixa de spam, ou aguarde 3 minutos.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                timer: 14000,
                timerProgressBar: true,
                confirmButtonText: 'Ok'
            })
        </script>
    @endif

    @if(session('msg-error'))

        <button value="{{ session('msg-error') }}" class="msg-error" hidden></button>

        <script>

            let msgError = $(".msg-error").val();

            Swal.fire({
                title: 'Senha não alterada',
                text: msgError,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                timer: 12000,
                timerProgressBar: true,
                confirmButtonText: 'Ok'
            })
        </script>
    @endif

    <script>
        function checkPassword(){
            let newPass = $(".n-pass").val();
            let confirm = $(".confirm-pass").val();

            if (newPass != confirm){
                $(".check-pass").removeAttr('hidden', 'true');
                $(".send-mail").attr('disabled', 'true');
                $(".send-mail").css('cursor', 'not-allowed');
            }else{
                $(".send-mail").removeAttr('disabled', 'true');
                $(".send-mail").css('cursor', 'pointer');
                $(".check-pass").attr('hidden', 'true');
            }
        }
    </script>
@endsection
