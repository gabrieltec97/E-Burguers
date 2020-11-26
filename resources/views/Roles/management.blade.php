@extends('layouts.extend')

@section('title')
    Gestão de funcionários
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px;">Funcionários cadastrados</div>

                    <div class="card-body first-table">

                        <div>
                            <form action="#" class="form-group">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Digite o nome do funcionário" name="clientName">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 18px"><i class="fas fa-search font-weight-bold"></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
