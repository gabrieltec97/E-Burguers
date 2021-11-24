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
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-responsive-lg">
                                        <thead>
                                        <tr>
                                            @foreach($count as $c)
                                                <th scope="col" style="color: black">{{ $c[1] }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($count as $c)
                                                <td style="color: black">{{ $c[2] }}</td>
                                            @endforeach
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 mt-4">
                                    <span class="font-weight-bold" style="color: black">Total: <span class="font-weight-normal">{{ $total == 1 ? $total . ' entrega.' : $total . ' entregas.' }}</span> </span>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection


