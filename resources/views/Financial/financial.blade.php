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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="card shadow" style="height: 560px;">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1fbee1">
                        <div class="row">
                            <div class="col-lg-5 col-12 vendaMes" style="color: ghostwhite;">

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
                                                <div class="modal-header" style="background-color: #343A40">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; margin-bottom: -30px">Atenção!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="font-weight-normal" style="font-size: 17px; color: black">Deseja trazer os dados sobre as vendas do mês de <span class="mes font-weight-bold text-primary"></span>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-success buscar-dados">Confirmar</button>
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
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1fbee1">
                        <div class="row">
                            <div class="col-lg-7 col-12 textoAno" style="color: ghostwhite;">

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
                                                <div class="modal-header" style="background-color: #343A40">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; margin-bottom: -30px">Atenção!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="font-weight-normal" style="font-size: 17px; color: black">Deseja trazer os dados sobre as vendas do ano de <span class="ano font-weight-bold text-primary"></span>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-success buscar-dados">Confirmar</button>
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
                <div class="card shadow" >
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1fbee1">
                        <div class="row">
                            <div class="col-lg-7 col-12" style="color: ghostwhite;">
                                Total de vendas por dia
                            </div>
                            <div class="col-lg-5 col-12 d-flex mt-2 mt-lg-0 justify-content-end" style="margin-bottom: -25px;">

                                <form action="{{ route('financeiro') }}">

{{--                                    <!-- Modal -->--}}
{{--                                    <div class="modal fade" id="modalAno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog" role="document">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="modal-header" style="background-color: #343A40">--}}
{{--                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; margin-bottom: -30px">Atenção!</h5>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <p class="font-weight-normal" style="font-size: 17px; color: black">Deseja trazer os dados sobre as vendas do ano de <span class="ano font-weight-bold text-primary"></span>?</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>--}}
{{--                                                    <button type="submit" class="btn btn-success buscar-dados">Confirmar</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body financial-table">
                        <div class="row">
                            <div class="col-6 col-lg-2">
                                <label style="color: black;">Dia</label>
                                <select name="dia" class="form-control">
                                    <option value="01" @if($day == 01) selected @endif>01</option>
                                    <option value="02" @if($day == '02') selected @endif>02</option>
                                    <option value="03" @if($day == '03') selected @endif>03</option>
                                    <option value="04" @if($day == 04) selected @endif>04</option>
                                    <option value="05" @if($day == 05) selected @endif>05</option>
                                    <option value="06" @if($day == 06) selected @endif>06</option>
                                    <option value="07" @if($day == 07) selected @endif>07</option>
                                    <option value="08" @if($day == '08') selected @endif>08</option>
                                    <option value="09" @if($day == '09') selected @endif>09</option>
                                    <option value="10" @if($day == 10) selected @endif>10</option>
                                    <option value="11" @if($day == 11) selected @endif>11</option>
                                    <option value="12" @if($day == 12) selected @endif>12</option>
                                    <option value="13" @if($day == 13) selected @endif>13</option>
                                    <option value="14" @if($day == 14) selected @endif>14</option>
                                    <option value="15" @if($day == 15) selected @endif>15</option>
                                    <option value="16" @if($day == 16) selected @endif>16</option>
                                    <option value="17" @if($day == 17) selected @endif>17</option>
                                    <option value="18" @if($day == 18) selected @endif>18</option>
                                    <option value="19" @if($day == 19) selected @endif>19</option>
                                    <option value="20" @if($day == 20) selected @endif>20</option>
                                    <option value="21" @if($day == 21) selected @endif>21</option>
                                    <option value="22" @if($day == 22) selected @endif>22</option>
                                    <option value="23" @if($day == 23) selected @endif>23</option>
                                    <option value="24" @if($day == 24) selected @endif>24</option>
                                    <option value="25" @if($day == 25) selected @endif>25</option>
                                    <option value="26" @if($day == 26) selected @endif>26</option>
                                    <option value="27" @if($day == 27) selected @endif>27</option>
                                    <option value="28" @if($day == 28) selected @endif>28</option>
                                    <option value="29" @if($day == 29) selected @endif>29</option>
                                    <option value="30" @if($day == 30) selected @endif>30</option>
                                    <option value="31" @if($day == 31) selected @endif>31</option>
                                </select>
                            </div>

                            <div class="col-6 col-lg-3">
                                <label style="color: black;">Mês</label>
                                <select name="mesvenda" class="form-control">
                                    <option value="janeiro"
                                            @if($reqmonth == 'janeiro')
                                            selected
                                        @endif>Janeiro</option>

                                    <option value="fevereiro"
                                            @if($reqmonth == 'fevereiro')
                                            selected
                                        @endif>Fevereiro</option>

                                    <option value="março"
                                            @if($reqmonth == 'março')
                                            selected
                                        @endif>Março</option>

                                    <option value="abril"
                                            @if($reqmonth == 'abril')
                                            selected
                                        @endif>Abril</option>

                                    <option value="maio"
                                            @if($reqmonth == 'maio')
                                            selected
                                        @endif>Maio</option>

                                    <option value="junho"
                                            @if($reqmonth == 'junho')
                                            selected
                                        @endif>Junho</option>

                                    <option value="julho"
                                            @if($reqmonth == 'julho')
                                            selected
                                        @endif>Julho</option>

                                    <option value="agosto"
                                            @if($reqmonth == 'agosto')
                                            selected
                                        @endif>Agosto</option>

                                    <option value="setembro"
                                            @if($reqmonth == 'setembro')
                                            selected
                                        @endif>Setembro</option>

                                    <option value="outubro"
                                            @if($reqmonth == 'outubro')
                                            selected
                                        @endif
                                    >Outubro</option>

                                    <option value="novembro"
                                            @if($reqmonth == 'novembro')
                                            selected
                                        @endif
                                    >Novembro</option>

                                    <option value="dezembro"
                                            @if($reqmonth == 'dezembro')
                                            selected
                                        @endif
                                    >Dezembro</option>
                                </select>
                            </div>

                            <div class="col-12 col-lg-8 mt-4 target">
                                <label style="color: black;">Total de vendas: <b>
                                        @if($sales < 1)
                                            <span class="text-danger font-weight-normal">{{ $sales }} venda</span>
                                        @elseif($sales == 1)
                                            <span class="text-success font-weight-normal">{{ $sales }} venda</span>
                                        @elseif($sales > 1)
                                            <span class="text-success font-weight-normal">{{ $sales }} vendas</span>
                                        @endif
                                    </b></label>
                                <br>
                                <label style="color: black;">Total de arrecadado: <b>
                                        @if($money < 1)
                                            <span class="text-danger font-weight-normal">R$ {{ $money }}</span>
                                        @elseif($money >= 1)
                                            <span class="text-success font-weight-normal">R$ {{ $money }}</span>
                                        @endif
                                    </b></label>
                                <br>
                                <label class="text-danger dadosReferentes"></label>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <button type="submit" class="btn buscar-dados" style="background: #1fbee1; color: white">Buscar dados</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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

    @if(isset($thisDay))
        <select class="diaHoje" hidden>
            <option value="{{ $thisDay }}"></option>
        </select>
    @endif

    @if(isset($reqmonth))
        <select class="mesHojeFiltro" hidden>
            <option value="{{ $reqmonth }}"></option>
        </select>
    @endif

    @if(isset($day))
        <select class="diaPHP" hidden>
            <option value="{{ $day }}"></option>
        </select>
    @endif

    <script>
        $(function () {

        var mesSistema = $(".mesHoje").val();
        var mesAtual = $(".mesPHP").val();
        var mesVendaFiltro = $(".mesHojeFiltro").val();

        var anoSistema = $(".anoHoje").val();
        var anoAtual = $(".anoPHP").val();

        var diaSistema = $(".diaPHP").val();
        var diaAtual = $(".diaHoje").val();


        if (mesAtual != mesSistema){
            $(".vendaMes").text('Vendas no mês de ' + mesSistema);
        }else{
            $(".vendaMes").text('Vendas este mês');
        }

        if (diaAtual != undefined){
            if (diaAtual != diaSistema || mesVendaFiltro != mesAtual){

                $(".dadosReferentes").text("*Vendas referentes ao dia " + diaSistema + " de " + mesVendaFiltro + " de " + anoAtual);

                setTimeout(function (){
                    $('html, body').animate({
                        scrollTop: $(".target").offset().top
                    }, 1500);
                }, 250)

                setTimeout(function (){
                    $(".dadosReferentes").fadeOut('slow');
                }, 8000)
            }

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
