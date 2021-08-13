@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jqueryStyles.js') }}"></script>
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
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    @livewire('search')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        $(function () {
            $(".botao-recolher-menu").click();
        })
    </script>
@endsection
