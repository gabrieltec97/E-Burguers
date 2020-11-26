@extends('layouts.extend')

@section('title')
    Histórico de pedidos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedido {{ $order->id }}</div>
                    <div class="card-body first-table">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <img src="{{ asset('logo/burger-5284886_1280.jpg') }}" class="mt-2 img-ped" style="margin-left: -10px; border-radius: 5px">
                                </div>

                                <div class="col-12 mt-4 col-lg-5 mt-lg-0">
                                    <label class="font-weight-bold mt-1" style="color: black">Id: #{{ $order->id }}</label>
                                    <label class="font-weight-bold" style="color: black">Cliente: {{ $order->clientName }}</label>
                                    <label class="font-weight-bold" style="color: black">Tipo de pedido: {{ $order->orderType }}</label>
                                    <label class="font-weight-bold" style="color: black">Tipo de entrega: {{ $order->deliverWay }}</label>
                                    <label class="font-weight-bold" style="color: black">Método de pagamento: {{ $order->payingMethod }}</label>
                                    <label class="font-weight-bold" style="color: black">Valor total: {{ $order->totalValue }}</label>
                                    <label class="font-weight-bold" style="color: black">Data do pedido: {{ $order->day }}, {{ $order->hour }}</label>
                                    <label class="font-weight-bold" style="color: black">Status: {{ $order->status }}</label>

                                    @if($order->detached != '')
                                        <label class="font-weight-bold mt-1" style="color: black">Refeições: {{ $order->detached }}</label>
                                    @else
                                        <label class="font-weight-bold mt-1" style="color: black">Refeições: {{ $order->hamburguer }}, {{ $order->portion }}, {{ $order->drinks }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
