@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Dados financeiros
@endsection

<?php

setlocale(LC_TIME, 'pt_BR', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$mesAtual = strftime('%B', strtotime('today'));
$anoAtual = strftime('%Y');

?>

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

            <div class="col-lg-12 col-sm-12 mb-5 alvo">
                <div class="card shadow" style="height: 560px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-7 col-12 textoAno">

                            </div>
                            <div class="col-lg-5 col-12 d-flex mt-2 mt-lg-0 justify-content-end" style="margin-bottom: -25px;">

                                <form action="{{ route('financeiro') }}">
                                    @csrf
                                    <select name="year" class="form-control anoVenda" style="cursor: pointer">
                                        @if($anoAtual == $ano)
                                            @foreach($yearsBefore as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Selecione</option>
                                            @foreach($yearsBefore as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalAno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
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

            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card shadow" style="height: 230px">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                Total de vendas por dia
                            </div>
                            <div class="col-lg-5 col-12 d-flex mt-2 mt-lg-0 justify-content-end" style="margin-bottom: -25px;">

                                <form action="{{ route('financeiro') }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalAno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
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
                        <div class="row">
                            <div class="col-2">
                                <label>Dia</label>
                                <select name="dia" class="form-control">
                                    <option value="" @if($thisDay == 1) selected @endif>1</option>
                                    <option value="" @if($thisDay == 2) selected @endif>2</option>
                                    <option value="" @if($thisDay == 3) selected @endif>3</option>
                                    <option value="" @if($thisDay == 4) selected @endif>4</option>
                                    <option value="" @if($thisDay == 5) selected @endif>5</option>
                                    <option value="" @if($thisDay == 6) selected @endif>6</option>
                                    <option value="" @if($thisDay == 7) selected @endif>7</option>
                                    <option value="" @if($thisDay == 8) selected @endif>8</option>
                                    <option value="" @if($thisDay == 9) selected @endif>9</option>
                                    <option value="" @if($thisDay == 10) selected @endif>10</option>
                                    <option value="" @if($thisDay == 11) selected @endif>11</option>
                                    <option value="" @if($thisDay == 12) selected @endif>12</option>
                                    <option value="" @if($thisDay == 13) selected @endif>13</option>
                                    <option value="" @if($thisDay == 14) selected @endif>14</option>
                                    <option value="" @if($thisDay == 15) selected @endif>15</option>
                                    <option value="" @if($thisDay == 16) selected @endif>16</option>
                                    <option value="" @if($thisDay == 17) selected @endif>17</option>
                                    <option value="" @if($thisDay == 18) selected @endif>18</option>
                                    <option value="" @if($thisDay == 19) selected @endif>19</option>
                                    <option value="" @if($thisDay == 20) selected @endif>20</option>
                                    <option value="" @if($thisDay == 21) selected @endif>21</option>
                                    <option value="" @if($thisDay == 22) selected @endif>22</option>
                                    <option value="" @if($thisDay == 23) selected @endif>23</option>
                                    <option value="" @if($thisDay == 24) selected @endif>24</option>
                                    <option value="" @if($thisDay == 25) selected @endif>25</option>
                                    <option value="" @if($thisDay == 26) selected @endif>26</option>
                                    <option value="" @if($thisDay == 27) selected @endif>27</option>
                                    <option value="" @if($thisDay == 28) selected @endif>28</option>
                                    <option value="" @if($thisDay == 29) selected @endif>29</option>
                                    <option value="" @if($thisDay == 30) selected @endif>30</option>
                                    <option value="" @if($thisDay == 31) selected @endif>31</option>
                                </select>
                            </div>

                            <div class="col-3">
                                <label>Mês</label>
                                <select name="mesvenda" class="form-control">
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
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Buscar dados</button>
                            </div>
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
            <option value="{{ $ano }}"></option>
        </select>



    <select class="mesPHP" hidden>
        <option value="{{ $mesAtual }}"></option>
    </select>

    <select class="anoPHP" hidden>
        <option value="{{ $anoAtual }}"></option>
    </select>

    <script>
        $(function () {

        var mesSistema = $(".mesHoje").val();
        var mesAtual = $(".mesPHP").val();

        var anoSistema = $(".anoHoje").val();
        var anoAtual = $(".anoPHP").val();

        console.log(anoSistema)

        if (mesAtual != mesSistema){
            $(".vendaMes").text('Vendas no mês de ' + mesSistema);
        }else{
            $(".vendaMes").text('Vendas este mês');
        }

        if (anoAtual != anoSistema){
            $(".textoAno").text('Total arrecadado por mês em ' + anoSistema);

            setTimeout(function (){
                $('html, body').animate({
                    scrollTop: $(".alvo").offset().top
                }, 1500);
            }, 250)
        }else{
            $(".textoAno").text('Total arrecadado por mês este ano');
        }
        });
    </script>
@endsection
