@extends('layouts.app')
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card recover-card">
                <div class="card-header bg-danger" style="color: white">Alterar senha</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <form method="POST" action="{{ route('resetPassword') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <label for="E-mail">E-mail:</label>
                                </div>

                                <div class="col-12">
                                    <input type="email" value="{{ old('email') }}" class="form-control w-100" name="email" required>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" style="margin-bottom: -22px" class="btn btn-primary send-mail">Enviar e-mail de redefinição de senha</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    @if(session('msg-error'))
        <script>
            Swal.fire({
                title: 'E-mail não encontrado',
                text: "Este e-mail não está cadastrado em nossa base de dados.",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                timer: 12000,
                timerProgressBar: true,
                confirmButtonText: 'Ok'
            })
        </script>
    @endif
@endsection
