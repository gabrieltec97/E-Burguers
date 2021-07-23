@extends('layouts.extend')

@section('title')
    Perfis de Usuário
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">Perfis de {{ $user->name }}</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('userRolesSync', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @foreach($roles as $role)
                                            <div>
                                                <input type="checkbox" id="{{ $role->id }}" name="{{ $role->id }}" {{ ($role->can == '1' ? 'checked' : '') }}>
                                                <label for="{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach

                                        <button type="submit" class="btn btn-success float-right mt-3">Sincronizar usuário</button>
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


