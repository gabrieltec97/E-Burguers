@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Dados financeiros
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card shadow" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-5 col-12 vendaMes">

                            </div>
                            <div class="col-lg-7 col-12 d-flex mt-2 mt-lg-0 justify-content-end" style="margin-bottom: -25px;">

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
                <div class="card shadow" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-6 col-12 textoAno">

                            </div>
                            <div class="col-lg-6 col-12 d-flex mt-2 mt-lg-0 justify-content-end" style="margin-bottom: -25px;">

                                <form action="{{ route('financeiro') }}">
                                    @csrf
                                    <select name="year" class="form-control anoVenda" style="cursor: pointer">
                                        @foreach($yearsBefore as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalAno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="font-weight-normal" style="font-size: 17px; color: black">Deseja trazer os dados sobre as vendas do ano de <span class="ano font-weight-bold text-primary"></span>?</p>
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
                                {!! $chart2->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <select class="mesHoje" hidden>
        <option value="{{ $thisMonth }}"></option>
    </select>

    <select class="anoHoje" hidden>
        <option value="{{ $year }}"></option>
    </select>

    <?php

    setlocale(LC_TIME, 'pt_BR', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $mesAtual = strftime('%B', strtotime('today'));
    $anoAtual = strftime('%Y');

    ?>

    <select class="mesPHP" hidden>
        <option value="{{ $mesAtual }}"></option>
    </select>

    <select class="anoPHP" hidden>
        <option value="{{ $mesAtual }}"></option>
    </select>

    <script>
        $(function () {

        var mesSistema = $(".mesHoje").val();
        var mesAtual = $(".mesPHP").val();

        var anoSistema = $(".anoHoje").val();
        var anoAtual = $(".anoPHP").val();

        if (mesAtual != mesSistema){
            $(".vendaMes").text('Vendas no mês de ' + mesSistema);
        }else{
            $(".vendaMes").text('Vendas este mês');
        }

            if (anoAtual != anoSistema){
                $(".textoAno").text('Total arrecadado por mês em ' + anoSistema);
            }else{
                $(".textoAno").text('Total arrecadado por mês este ano');
            }
        });
    </script>
@endsection
