@extends('layouts.extend')

@section('title')
    Histórico de pedidos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedido nº {{ $order->id }}</div>
                    <div class="card-body first-table">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <img src="{{ asset('logo/burger-5284886_1280.jpg') }}" class="mt-2 img-ped" style="margin-left: -10px; border-radius: 5px; width: 300px; height: 300px;">
                                </div>

                                <div class="col-12 mt-4 col-lg-5 mt-lg-0">
                                    <label class="font-weight-bold mt-1" style="color: black">Id: {{ $order->id }}</label><br>
                                    <label class="font-weight-bold" style="color: black">Cliente: {{ $order->clientName }}</label><br>
                                    <label class="font-weight-bold" style="color: black">Data do pedido: {{ $order->day }}, {{ $order->hour }}</label><br>
                                    <label class="font-weight-bold" style="color: black"><span class="text-primary">Valor total:</span> {{ $order->totalValue }}</label><br>
                                    <label class="font-weight-bold {{ $order->status == 'Cancelado' ? 'text-danger' : 'text-success'}}" style="color: black">Status: {{ $order->status }}</label><br>
                                    <label class="font-weight-bold" style="color: black">Tipo de pedido: {{ $order->orderType }}</label><br>
                                    <label class="font-weight-bold" style="color: black">Tipo de entrega: {{ $order->deliverWay }}</label><br>
                                    <label class="font-weight-bold" style="color: black">Método de pagamento: {{ $order->payingMethod }}</label><br>
                                    @if($order->deliverMan != null)
                                    <label class="font-weight-bold" style="color: black">Entregador: {{ $order->deliverMan }}</label><br>
                                    @endif

                                    @if($order->usedCoupon != null)
                                        <label class="font-weight-bold" style="color: black">Cupom utilizado: {{ $order->usedCoupon }}</label>
                                    @endif
                                </div>

                                <div class="col-12 mt-4 col-lg-3 mt-lg-0">

                                    @if($order->detached != '')
                                        {{--                                        <label class="font-weight-bold mt-1" style="color: black">Itens: {{ $order->detached }}</label>--}}
                                        @foreach(explode(';', $order->detached) as $item)
                                            @if($item != null)
                                                <li class="mt-2" style="color: black">{{$item}}.</li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li style="color: black">{{ $order->hamburguer }}.</li>
                                        <li style="color: black">{{ $order->fries }}.</li>
                                        <li style="color: black">{{ $order->drinks }}.</li>
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
