<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entre ou cadastre-se!</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/e656fe6405.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{ asset('logo/mybg.jpg') }}); background-size: cover;">
<div id="app">

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-login">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: black">Página inicial</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} &nbsp; <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" style="border: none;">
                        <div class="card-header bg-danger"><span class="text-white font-weight-bold">Entre e faça seu pedido!</span></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Entrar
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                Esqueci minha senha
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                    <div class="card" style="border: none;">
                        <div class="card-header bg-primary"><span class="text-white font-weight-bold">Ainda não tenho cadastro.</span></div>

                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="{{ route('newClientUser') }}" method="post" class="form-group">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="nome" class="font-weight-bold">Nome</label>
                                            <input type="text" class="form-control {{ ($errors->has('clientName') ? 'is-invalid' : '') }}" value="{{ old('clientName') }}" placeholder="Apenas seu nome" name="clientName" required>
                                            @if($errors->has('clientName'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientName') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                                            <label for="nome" class="font-weight-bold">Sobrenome</label>
                                            <input type="text" class="form-control {{ ($errors->has('clientSurname') ? 'is-invalid' : '') }}" value="{{ old('clientSurname') }}" name="clientSurname" required>
                                            @if($errors->has('clientSurname'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientSurname') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-9 mt-2">
                                            <label for="nome" class="font-weight-bold">Endereço</label>
                                            <input type="text" class="form-control {{ ($errors->has('clientAddress') ? 'is-invalid' : '') }}" value="{{ old('clientAddress') }}" placeholder="Nome da rua onde serão entregues os pedidos" name="clientAddress" required>
                                            @if($errors->has('clientAddress'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientAddress') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-3 mt-2">
                                            <label for="nome" class="font-weight-bold">Nº</label>
                                            <input type="number" class="form-control {{ ($errors->has('clientAdNumber') ? 'is-invalid' : '') }}" value="{{ old('clientAdNumber') }}" name="clientAdNumber" required>
                                            @if($errors->has('clientAdNumber'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientAdNumber') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="nome" class="font-weight-bold">Ponto de referência</label>
                                            <input type="text" class="form-control {{ ($errors->has('refPoint') ? 'is-invalid' : '') }}" value="{{ old('refPoint') }}" placeholder="Um local próximo ao que será entregue o pedido." name="refPoint" required>
                                            @if($errors->has('refPoint'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('refPoint') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-6 mt-2">
                                            <label for="nome" class="font-weight-bold">Bairro</label>
                                            <select name="district" class="form-control">
                                                @foreach($districts as $d => $value)
                                                    <option value="{{ $value->name }}" {{ old('district') == $value->name ? 'selected' : ''}}>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-2">
                                            <label for="nome" class="font-weight-bold">Telefone</label>
                                            <input type="number" class="form-control {{ ($errors->has('clientNumber') ? 'is-invalid' : '') }}" value="{{ old('clientNumber') }}" placeholder="(ddd) numero" name="clientNumber" required>
                                            @if($errors->has('clientNumber'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientNumber') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-6 mt-2">
                                            <label for="nome" class="font-weight-bold">E-mail</label>
                                            <input type="email" placeholder="E-mail para login" class="form-control {{ ($errors->has('clientEmail') ? 'is-invalid' : '') }}" value="{{ old('clientEmail') }}" name="clientEmail" required>
                                            @if($errors->has('clientEmail'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientEmail') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 col-lg-6 mt-2">
                                            <label for="nome" class="font-weight-bold">Senha</label>
                                            <input type="password" class="form-control {{ ($errors->has('clientPassword') ? 'is-invalid' : '') }}" value="{{ old('clientPassword') }}" name="clientPassword" required>
                                            @if($errors->has('clientPassword'))
                                            <div class="invalid-feedback">
                                                <span class="font-weight-bold"> {{ $errors->first('clientPassword') }}</span>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-12 d-flex justify-content-end mt-4" style="margin-bottom: -20px">
                                            <button type="submit" class="btn btn-primary cadastro-cliente"><i class="fas fa-pizza-slice mr-1"></i>Cadastrar-se</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

@if(session('msg'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Parabéns, cadastro realizado!',
            text: 'Agora basta você entrar e escolher sua pizza!',
        })
    </script>
@endif

@if(session('msg-error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Cadastro não realizado!',
            text: 'Este e-mail já está cadastrado, caso não lembre a senha, clique em "Esqueci minha senha".',
        })
    </script>
@endif
</html>

