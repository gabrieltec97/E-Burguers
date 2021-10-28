@extends('layouts.extend')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
@section('title')
    Gerenciamento de anúncios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-5">
                @if(session('msg-2'))
                    <div class="alert alert-success alerta-sucesso-ref alert-dismissible fade show" role="alert">
                        <span class="font-weight-bold">Tudo certo!</span> {{ session('msg-2') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    @if(session('msg'))
                        <div class="alert alert-danger alerta-sucesso-user alert-dismissible fade show" role="alert">
                            <span class="font-weight-bold">Feito! </span>{{ session('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: #17B3DF;">Refeições cadastradas</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="checkbox" style="width: 16px; height: 16px;" class="form-check-input ml-1 travarAvaliacoes" data-toggle="modal" data-target="#modalTrava" id="travarAval" name="travarAval" {{ $rate == "Sim" ? 'checked' : '' }}>
                                <label for="travarAval" class="ml-4 font-weight-bold" style="color: black; cursor: pointer;  margin-top: 2px;"> Habilitar avaliações</label><br>
                            </div>

                            <div class="col-6 mb-2 d-flex justify-content-end">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" title="Aqui você poderá fazer cadastros" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-plus"></i>
                                        Novo
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <li><button class="dropdown-item" type="button"><i class="fas fa-hamburger text-primary mr-2"></i><a class="font-weight-bold" href="{{ route('refeicoes.create') }}" title="Cadastrar refeição para o cardápio" style="font-size: 15px; text-decoration: none;">Nova refeição</a></button></li>
                                        <li><button class="dropdown-item" type="button"><i class="fas fa-plus-square text-success mr-2"></i><a class="font-weight-bold text-success" href="{{ route('itensAdicionais.index') }}" title="Itens em que o cliente paga a mais para adicionar no sanduíche." style="font-size: 15px; text-decoration: none;">Novo item adicional</a></button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @livewire('adverts')
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTrava" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: black; margin-bottom: -30px">Atenção!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('travaAvaliacoes', $rate) }}" method="get">
                        @csrf
                        <p>
                            @if($rate == "Sim")
                           <p style="color: black; margin-top: -20px;"> Deseja ocultar as avaliações? As avaliações dos clientes não aparecerão mais ao lado de cada item
                               do cardápio.</p>
                            @else
                                <p style="color: black; margin-top: -20px;">Deseja mostrar as avaliações? As avaliações dos clientes aparecerão ao lado de cada item
                                    do cardápio.</p>
                            @endif
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary toggle-aval">Sim</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @if($deactivated != null)
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Atenção!',
                text: 'Você tem {{ count($deactivated) }} {{ count($deactivated) > 1 ? 'itens desativados. Lembre-se de reativá-los quando estes estiverem disponíveis' : 'item desativado. Lembre-se de reativá-lo quando ele estiver disponível' }}, ok?',
                showCancelButton: false,
                showConfirmButton: true,
            });
        </script>
    @endif
@endsection
