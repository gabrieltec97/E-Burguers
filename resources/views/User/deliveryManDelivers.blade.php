@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Entregas de {{ $deliveryMan[0]->name }}
@endsection

<?php

setlocale(LC_TIME, 'pt_BR', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (!isset($thisMonth)){
    $thisMonth = strftime('%B', strtotime('today'));
    $thisYear = strftime('%Y');
    $day = strftime('%d');
}
?>

@if($thisMonth == strftime('%B', strtotime('today')) && $day == strftime('%d') && $thisYear == strftime('%Y'))
    <button class="diff-day" value="nao" hidden></button>
@else
    <button class="diff-day" value="sim" hidden></button>
@endif


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1fbee1">
                        <span style="color: white">{{ $deliveryMan[0]->name . ' ' . $deliveryMan[0]->surname}} </span>
                    </div>

                    <div class="card-body">
                      <form action="{{ route('searchSendings', $deliveryMan[0]->id) }}" class="form-group">
                       <div class="row">

                           <div class="col-12">
                               <table class="table table-bordered table-striped table-responsive-lg">
                                   <thead>
                                   <tr>
                                       @foreach($delivers as $d => $name)
                                           <th scope="col" style="color: black; font-weight: normal">{{ $name['bairro'] }}</th>
                                       @endforeach
                                   </tr>
                                   </thead>
                                   <tbody>

                                   <tr>
                                       @foreach($delivers as $d2 => $dt)
                                           <td style="color: black; font-weight: normal">{{ $dt['total'] }}</td>
                                       @endforeach
                                   </tr>
                                   </tbody>
                               </table>
                           </div>


                           <div class="col-12 mb-2 mt-2">
                               <h5 style="color: black">Escolha a data</h5>
                           </div>

                               <div class="col-12 col-lg-2">
                                   <select name="dia" class="form-control" style="cursor: pointer">
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

                               <div class="col-12 col-lg-2 mt-3 mt-lg-0">
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
                               </div>

                               <div class="col-12 col-lg-2 mt-3 mt-lg-0">
                                   <select name="year" class="form-control" style="cursor: pointer">
                                       <option value="{{ $thisYear }}">{{ $thisYear }}</option>
                                       <option value="{{ $thisYear - 1 }}">{{ $thisYear - 1 }}</option>
                                       <option value="{{ $thisYear - 2 }}">{{ $thisYear - 2 }}</option>
                                   </select>
                               </div>

                           <div class="col-12 mt-lg-4 mt-3">
                               <span style="color: black; font-size: 17px" class="text-primary" >Total de entregas:</span> <span style="color: black">{{ $totalToday == 1 ? $totalToday . ' concluída.' : $totalToday . ' concluídas.' }}</span> <br>
                               <span style="color: black; font-size: 17px" class="text-primary" >Total a pagar:</span> <span class="text-success">R$ {{ $price }}</span></span><br>
                               <span class="text-danger text-entregas" style="font-size: 15.5px">*Entregas referentes ao dia {{ $day . ' de ' . $thisMonth . ' de ' . $thisYear }}.</span>
                           </div>

                           <div class="col-12 mt-3 d-flex justify-content-end" style="margin-bottom: -20px">
                                <button type="submit" class="btn btn-primary buscar-entregas">Buscar</button>
                           </div>
                       </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-5">
                <div class="card shadow">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #1fbee1">
                        <span style="color: white">Entregas feitas este mês</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive-lg">
                            <thead>
                            <tr>
                                @foreach($countMonth as $month => $name)
                                    <th scope="col" style="color: black; font-weight: normal">{{ $name['bairro'] }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                            @foreach($countMonth as $month2 => $dt)
                                <td style="color: black; font-weight: normal">{{ $dt['total'] }}</td>
                            @endforeach
                            </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-3">
                            <span style="color: black; font-size: 16px">Total este mês: {{ $totalMonth == 1 ? $totalMonth . ' entrega feita' : $totalMonth . ' entregas feitas' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
