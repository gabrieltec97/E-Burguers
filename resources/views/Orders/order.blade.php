@extends('layouts.extend')

@section('title')
    Histórico de pedidos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedido nº {{ $order->id }}</div>
                    <div class="card-body first-table">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <img src="{{ asset('logo/undraw_Chef_cu0r.svg') }}" class="mt-2 img-fluid" style="border-radius: 5px;">
                                </div>

                                <div class="col-12 mt-4 col-lg-5 mt-lg-0">
                                    <label class="font-weight-bold mt-1" style="color: black">Id: {{ $order->id }}</label><br>
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Cliente: <span class="font-weight-normal" style="font-size: 16px">{{ $order->clientName }}</span></label><br>
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Contato: <span class="font-weight-normal" style="font-size: 16px">{{ $order->userPhone }}</span></label><br>
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Data do pedido: <span class="font-weight-normal" style="font-size: 16px">{{ $order->day }}, {{ $order->hour }}</span></label><br>
                                    <label {{ $order->status == 'Cancelado' ? 'text-danger' : 'text-success'}} class="font-weight-bold" style="color: black; font-size: 17px">Status: <span class="font-weight-normal {{ $order->status == 'Cancelado' ? 'text-danger' : 'text-success' }}" style="font-size: 16px">{{ $order->status }}</span></label><br>
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Tipo de pedido: <span class="font-weight-normal" style="font-size: 16px">{{ $order->orderType }}</span></label><br>
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Tipo de entrega: <span class="font-weight-normal" style="font-size: 16px">{{ $order->deliverWay }}</span></label><br>
                                    @if($order->deliverWay == 'Entrega em domicílio')
                                        <label class="font-weight-bold" style="color: black; font-size: 17px;">Entregue em: <span class="font-weight-normal" style="font-size: 16px">{{ $order->address }}</span></label><br>
                                    @endif
                                    <label class="font-weight-bold" style="color: black; font-size: 17px;">Método de pagamento: <span class="font-weight-normal" style="font-size: 16px">{{ $order->payingMethod }}</label><br>
                                    @if($order->deliverMan != null)
                                    <label class="font-weight-bold" style="color: black">Entregador: <span class="font-weight-normal">{{ $order->deliverMan }}</span></label><br>
                                    @endif

                                    @if($order->usedCoupon != null)
                                        <label class="font-weight-bold" style="color: black">Cupom utilizado: {{ $order->usedCoupon }}</label>
                                    @endif

                                    <?php

                                        $count = strlen($order->totalValue);

                                        if ($count == 4 && $order->totalValue > 10){
                                            $price = $order->totalValue . '0';
                                        }elseif ($count == 2){
                                            $price = $order->totalValue. '.' . '00';
                                        }
                                        else{
                                            $price = $order->totalValue;
                                        }


                                    ?>

                                    <label class="font-weight-bold text-success" style="color: black; font-size: 17px;">Valor total: <span class="font-weight-normal" style="font-size: 16px; color: black">R$ {{ $price }}</span></label>
                                </div>

                                <div class="col-12 hr-order">
                                    <hr class="">
                                </div>

                                <div class="col-12 col-lg-3 mt-lg-0">

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
