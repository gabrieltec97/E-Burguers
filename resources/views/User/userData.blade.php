@extends('layouts.extend')

@section('title')
    Cadastro de funcionário
@endsection

@section('content')
    @if(session('msg'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Tudo certo!',
                text: '{{ session('msg') }}',
            })
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">Dados do funcionário</div>

                    <div class="card-body">
                        <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Nome</label>
                                        <input type="text" placeholder="Apenas o nome" class="form-control" value="{{ $user['name'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Sobrenome(s)</label>
                                        <input type="text" class="form-control" value="{{ $user['surname'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 mt-md-0 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Telefone</label>
                                        <input type="text"  class="form-control user-Phone" value="{{ $user['phone'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Telefone fixo (Opcional)</label>
                                        <input type="text" class="form-control userFixedPhone" value="{{ $user['fixedPhone'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>

                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Endereço</label>
                                        <input type="text" class="form-control" value="{{ $user['address'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Ponto de referência</label>
                                        <input type="text" class="form-control" value="{{ $user['refPoint'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Bairro (Modo cliente)</label>
                                        <input type="text" value="{{ $user['district'] }}" class="form-control" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>

                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold" style="color: black">Nº da residência</label>
                                        <input type="text" class="form-control" name="adNumber" value="{{ $user['adNumber'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-3 col-md-4">
                                        <label class="font-weight-bold empEmail" style="color: black">E-mail</label>
                                        <input type="email" class="form-control empEmail" value="{{ $user['email'] }}" title="Dados disponíveis apenas para visualização" style="cursor: not-allowed" readonly>
                                    </div>

                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        @if(isset($details))
                                            <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modalEntregasFeitas">Entregas realizadas</button>
                                        @endif
                                        <a href="{{ route('usuario.edit', $user['id']) }}" class="btn btn-primary">Editar cadastro</a>
                                    </div>
                                </div>
                        </div>
                    </div>

                     </div>
            </div>
            </div>
        </div>
    </div>

    @if(isset($count) && isset($details))
    <!-- Modal -->
    <div class="modal fade" id="modalEntregasFeitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #343a40">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">{{ $user['name']. ' ' . $user['surname']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            @foreach($details as $dt => $val)
                                <th scope="col" style="color: black; font-weight: normal">{{ $val['bairro'] }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($details as $dt => $val)
                                <td style="color: black; font-weight: normal">{{ $val['total'] }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>

                    <div class="col-12" style="margin-bottom: -27px">
                        <p class="text-right" style="color: black; margin-right: -12px;">Total este mês: {{ $count == 1 ? $count . ' entrega feita' : $count . ' entregas feitas' }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection


