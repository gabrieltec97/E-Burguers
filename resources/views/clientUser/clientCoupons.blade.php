@extends('layouts.extend-client')

@section('title')
    Meus cupons
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="card" style="margin-top: 70px;">
            <div class="card-header bg-dark">
                <span class="text-light" style="font-size: 17px">Cupons disponíveis</span>
            </div>
            <div class="card-body">
                @foreach($coupons as $coupon)
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 col-lg-1">
                                    <img src="{{ asset('logo/cupom.png') }}" class="img-cupom">
                                </div>

                                <div class="col-5 col-lg-2">
                                    <span class="font-weight-bold text-danger" style="font-size: 19px">{{ $coupon->name }}</span> <br>
                                    <span>Expira em: {{ $coupon->expireDate }}</span>
                                </div>

                                <div class="col-4 mb-4">
                                    <span>Você terá direito a <span class="text-success">{{ $coupon->disccount }}</span> nos pedidos acima de <span class="text-danger">{{ $coupon->disccountRule }}</span></span>
                                </div>

                                @if(count($coupons) > 1)
                                    <hr>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="footertray">
            <span class="badge badge-success">Voltar ao <br> cardápio</span>
            <a href="{{ route('cardapio', $insert = true) }}"><img src="{{ asset('logo/bandeja-de-comida.png') }}" style="width: 60px; height: 60px; cursor: pointer" title="Minha bandeja"></a>
        </div>
    </div>
@endsection


