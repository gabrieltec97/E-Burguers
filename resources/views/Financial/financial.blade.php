@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Dados financeiros
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-5 col-12">
                                Vendas este mês
                            </div>

                            <div class="col-lg-7 col-12 d-flex mt-2 mt-lg-0 justify-content-end mb-2">

                                <form action="{{ route('financeiro') }}">
                                    @csrf
                                    <select name="month" class="form-control mesVenda" style="cursor: pointer">
                                        <option value="janeiro"
                                        @if($thisMonth == 'janeiro')
                                            selected
                                        @endif>Janeiro</option>

                                        <option value="fevereiro"
                                        @if($thisMonth == 'fevereiro')
                                            selected
                                        @endif>Fevereiro</option>

                                        <option value="março"
                                        @if($thisMonth == 'março')
                                            selected
                                        @endif>Março</option>

                                        <option value="abril"
                                        @if($thisMonth == 'abril')
                                            selected
                                        @endif>Abril</option>

                                        <option value="maio"
                                        @if($thisMonth == 'maio')
                                            selected
                                        @endif>Maio</option>

                                        <option value="junho"
                                        @if($thisMonth == 'junho')
                                            selected
                                        @endif>Junho</option>

                                        <option value="julho"
                                        @if($thisMonth == 'julho')
                                            selected
                                        @endif>Julho</option>

                                        <option value="agosto"
                                        @if($thisMonth == 'agosto')
                                            selected
                                        @endif>Agosto</option>

                                        <option value="setembro"
                                        @if($thisMonth == 'setembro')
                                            selected
                                        @endif>Setembro</option>

                                        <option value="outubro"
                                        @if($thisMonth == 'outubro')
                                            selected
                                        @endif
                                        >Outubro</option>

                                        <option value="novembro"
                                        @if($thisMonth == 'novembro')
                                            selected
                                        @endif
                                        >Novembro</option>

                                        <option value="dezembro"
                                        @if($thisMonth == 'dezembro')
                                            selected
                                        @endif
                                        >Dezembro</option>
                                    </select>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="font-weight-normal" style="font-size: 17px; color: black">Deseja trazer os dados sobre as vendas do mês de <span class="mes font-weight-bold text-primary"></span>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart->container() !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Valor arrecadado em cada mês</div>

                    <div class="card-body financial-table">

                        <div id="app">
                            {!! $chart2->container() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <select class="mesHoje" hidden>
        <option value="{{ $thisMonth }}"></option>
    </select>

    <?php

    setlocale(LC_TIME, 'pt_BR', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $mesAtual = strftime('%B', strtotime('today'));

    ?>

    <select class="mesPHP" hidden>
        <option value="{{ $mesAtual }}"></option>
    </select>

    <button class="disparar">aaaa</button>

    <script>
        $(function () {

        var mesSistema = $(".mesHoje").val();
        var mesAtual = $(".mesPHP").val();

        // if (mesAtual != mesSistema){
        //
        // }

            $(".disparar").click();

        $(".disparar").on("click", function(){
            bs4pop.notice('<strong>Estão sendo exibidas as vendas referentes ao mês de <span style="color:red">{{ $thisMonth }}</span>, não do mês atual (<span style="color: red">{{ ucfirst($mesAtual) }}</span>)</strong>', {
                type: 'info',
                position: 'topright',
                appendType: 'append',
                closeBtn: 'false',
                className: ''
            })
        })
        });
    </script>

    <button class="disparar">aaaa</button>
@endsection
