@extends('layouts.extend')

@section('title')
    Histórico de pedidos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card hist-ped">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedidos registrados</div>
                    <div class="card-body first-table">
                        <div>
                            <form action="#" class="form-group">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Digite o número do pedido" name="orderNumber">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 18px"><i class="fas fa-search font-weight-bold"></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">ID do pedido</th>
                                <th scope="col">Data do pedido</th>
                                <th scope="col">Hora do pedido</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Status do pedido</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $ord)
                                    <tr>
                                        <td class="font-weight-bold text-primary"> #{{ $ord->id }}</td>
                                        <td class="font-weight-bold text-primary"> {{ $ord->day }}</td>
                                        <td class="font-weight-bold text-primary"> {{ $ord->hour }}</td>
                                        <td class="font-weight-bold text-primary"> {{ $ord->clientName }}</td>

                                        @if($ord->status == "Cancelado")
                                            <td class="text-danger font-weight-bold"> {{ $ord->status }}</td>
                                        @else
                                            <td class="text-success font-weight-bold"> {{ $ord->status }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="col-6 offset-4 offset-xl-5">
                            <span>{{ $orders->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
