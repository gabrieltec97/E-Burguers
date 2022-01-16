@extends('layouts.extend')

@section('title')
    Minhas entregas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header font-weight-bold" style="font-size: 25px; color: white; background-color: #343a40">
                        Entregas realizadas hoje
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered  table-responsive-lg">
                                    <thead>
                                    <tr>
                                        @foreach($total as $t => $value)
                                        <th scope="col" style="color: black">{{ $value['bairro'] }}</th>
                                        @endforeach

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($total as $t => $value)
                                            <th scope="row" style="color: black; font-weight: normal">{{ $value['total'] }}</th>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                @if($countTotal > 1 or $countTotal == 0)
                                    <p style="color: black; margin-bottom: -15px;" class="text-center text-lg-left">{{ $countTotal }} entregas realizadas.</p>
                                @elseif($countTotal == 1)
                                    <p style="color: black; margin-bottom: -15px;" class="text-center text-lg-left">{{ $countTotal }} entrega realizada.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header bg-primary font-weight-bold" style="font-size: 25px; color: white">Entregas realizadas ontem</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered  table-responsive-lg">
                                    <thead>
                                    <tr>
                                        @foreach($total as $t => $value)
                                            <th scope="col" style="color: black">{{ $value['bairro'] }}</th>
                                        @endforeach

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($totalOntem as $t => $value)
                                            <th scope="row" style="color: black; font-weight: normal">{{ $value['total'] }}</th>
                                        @endforeach
                                    </tr>

                                    </tbody>
                                </table>
                                <hr>
                                @if($countOntem > 1 or $countOntem == 0)
                                    <p style="color: black; margin-bottom: -15px;" class="text-center text-lg-left">{{ $countOntem }} entregas realizadas.</p>
                                @elseif($countOntem == 1)
                                    <p style="color: black; margin-bottom: -15px;" class="text-center text-lg-left">{{ $countOntem }} entrega realizada.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection


