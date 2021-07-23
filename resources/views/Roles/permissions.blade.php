@extends('layouts.extend')

@section('title')
    Perfis de Usuário
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
                <strong>Tudo certo!</strong> {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('msg-2'))
            <div class="alert alert-danger sumir-feedback alert-dismissible fade show" role="alert">
                <strong>Tudo certo!</strong> {{ session('msg-2') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Permissões de {{ $role->name }}</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('rolePermissionsSync', ['role' => $role->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input type="checkbox" id="{{ $permission->id }}" name="{{ $permission->id }}" {{ ($permission->can == '1' ? 'checked' : '') }}>
                                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach

                                        <button type="submit" class="btn btn-success float-right mt-3">Sincronizar perfil</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>


    </div>
    </div>
@endsection


