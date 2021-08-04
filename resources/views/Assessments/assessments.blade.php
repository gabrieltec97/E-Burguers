@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
@section('title')
    Avaliações dos clientes.
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            <div class="card border-left-success shadow h-100 py-2 card-dash2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nota total</div>
                            <div class="h5 mt-2 mb-0 font-weight-bold text-gray-800">{{ $data['grade'] }} (Nota máxima é 5)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            <div class="card border-left-info shadow h-100 py-2 card-dash3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de avaliações</div>
                            <div class="h5 mt-2 mb-0 font-weight-bold text-gray-800">{{ $data['count'] }} votantes</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 mt-lg-0 col-lg-4">
            <div class="card border-left-info shadow h-100 py-2 card-dash3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Grau de satisfação</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                @if($data['grade'] >= 4)
                                    <i class="far fa-smile text-success mt-2"></i>
                                @elseif($data['grade'] >= 3 && $data['grade'] < 4)
                                    <i class="far fa-meh text-warning mt-2"></i>
                                @elseif($data['grade'] < 3)
                                    <i class="far fa-frown text-danger mt-2"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 mt-4">
            <table class="table table-bordered" style="cursor: pointer">
                <thead>
                <tr>
                    <th scope="col" style="color: black">Nota <i class="fas fa-star text-warning"></i></th>
                    <th scope="col" style="color: black">Comentário</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rating as $r)
                    <tr>
                        <td>{{ $r['ratingGrade'] }}</td>
                        <td>{{ $r['comments'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


