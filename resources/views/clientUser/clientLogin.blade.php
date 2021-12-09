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
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

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
                        <div class="card-header bg-primary font-weight-bold" style="color: white">Cadastre-se, é rapidinho!</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="name" class="font-weight-bold">{{ __('Name') }}</label>

                                            <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control w-100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2 mt-lg-0 col-lg-6">
                                            <label for="name" class="font-weight-bold">{{ __('Telefone') }}</label>

                                            <input id="phone" type="text" placeholder="(ddd) número" class="form-control w-100 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" min="9" max="12" autofocus required>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2 col-lg-9">
                                            <label for="name" class="font-weight-bold">{{ __('Endereço') }}</label>

                                            <input id="address" type="text" placeholder="O local onde será entregue o pedido." class="form-control w-100 @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus required>

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2 col-lg-3">
                                            <label for="name" class="font-weight-bold">{{ __('Nº') }}</label>

                                            <input id="adNumber" type="number" placeholder="Número da residência" class="form-control w-100 @error('adNumber') is-invalid @enderror" name="adNumber" value="{{ old('adNumber') }}" autocomplete="adNumber" autofocus required>

                                            @error('adNumber')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2 col-lg-5">
                                            <label for="name" class="font-weight-bold">{{ __('Bairro') }}</label>

                                            <select name="district" class="form-control">
                                                @foreach($districts as $d => $value)
                                                    <option value="{{ $value->name }}" {{ old('district') == $value->name ? 'selected' : ''}}>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-7 mt-2">
                                            <label for="name" class="font-weight-bold">{{ __('Ponto de referência') }}</label>

                                            <input id="refPoint" type="text" placeholder="Um local próximo ao seu endereço" class="form-control w-100 @error('refPoint') is-invalid @enderror" name="refPoint" value="{{ old('refPoint') }}" autocomplete="refPoint" autofocus required>

                                            @error('refPoint')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="col-12 mt-2 col-lg-6">
                                            <label for="name" class="font-weight-bold">{{ __('E-mail') }}</label>

                                            <input id="email" type="text" class="form-control w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2 col-lg-6">
                                            <label for="name" class="font-weight-bold">{{ __('Senha') }}</label>

                                            <input id="password" type="password" class="form-control w-100 @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" autofocus required>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-3" style="margin-bottom: -10px">
                                            <button type="submit" class="btn btn-primary float-right">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

@if(session('msg-success'))

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Tudo certo!',
            text: 'Senha alterada com sucesso!',
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

