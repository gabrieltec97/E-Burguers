@extends('layouts.extend')

@section('title')
    Informações do entregador
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info font-weight-bold" style="font-size: 25px; color: white">{{ $deliveryMan->name }} - Entregas</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            @foreach($count as $c)
                                                <th scope="col">{{ $c[1] }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($count as $c)
                                                <td>{{ $c[2] }}</td>
                                            @endforeach
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


