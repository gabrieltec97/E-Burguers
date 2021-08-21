@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
@section('title')
    Cardápio
@endsection

<?php

?>

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Preparamos um cardápio especial para você!</h1>
                <hr>
            </div>

            @if($val > 0)
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('fimCompra') }}" class="btn btn-success font-weight-bold"><i class="fas fa-chevron-circle-right mr-2"></i>Ir para pagamento</a>
                </div>
            @endif
            <div class="col-12 col-md-9">
                <div class="container-fluid">
                    @livewire('detached-tray')
                </div>
            </div>
    </div>
@endsection
