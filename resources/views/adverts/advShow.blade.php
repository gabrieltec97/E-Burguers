@extends('layouts.extend')

@section('title')
    Visualização de anúncio
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Tudo certo!',
                            text: '{{ session('msg') }}',
                            timer: 7000,
                            timerProgressBar: true,
                        })
                    </script>
                @endif

                @if(session('msg-att'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Tudo certo!',
                                text: '{{ session('msg-att') }}',
                                timer: 7000,
                                timerProgressBar: true,
                            })
                        </script>
                @endif

                @if(session('msg-dstv'))
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Desativação concluída!',
                                text: '{{ session('msg-dstv') }}',
                                timer: 7000,
                                timerProgressBar: true,
                            })
                        </script>
                @endif
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">{{ $meal->name }}</div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                                    <img src="{{ asset($meal->picture) }}" style="margin-top: 10px; width: 300px; height: 300px; border-radius: 5px" class="img-fluid" alt="">
                                </div>

                                <div class="col-12 col-lg-8 mt-4 mt-lg-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Nome</label>
                                                <input type="text" value="{{ $meal->name }}" class="form-control w-100" title="{{ $meal->name }}" readonly>
                                        </div>

                                        <div class="col-12 col-lg-4 mt-lg-0 mt-3">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Tipo
                                                @if($meal->foodType == 'Hamburguer')
                                                    <i class="fas fa-hamburger ml-1 text-dark" title="Este item é do tipo hamburguer" style="cursor:pointer;"></i>
                                                @elseif($meal->foodType == 'Bebida')
                                                    <i class="fas fa-wine-glass-alt ml-1 text-danger" title="Este item é uma bebida" style="cursor:pointer;"></i>
                                                @elseif($meal->foodType == 'Sobremesa')
                                                    <i class="fas fa-ice-cream ml-1" style="color: lightpink; cursor:pointer;" title="Este item é uma sobremesa"></i>
                                                @elseif($meal->foodType == 'Acompanhamento')
                                                    <i class="fas fa-cookie-bite ml-1 text-info" title="Este item é um acompanhamento" style="cursor:pointer;"></i>
                                                @endif

                                            </label>
                                                <input type="text" value="{{ $meal->foodType }}" class="form-control w-100" title="Apenas visualização." readonly>
                                        </div>

                                        <div class="col-12 col-lg-4 mt-lg-0 mt-3">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Valor <i class="fas fa-dollar-sign ml-1 text-success" style="cursor:pointer;" title="Valor que o cliente pagará por este item"></i></label>
                                                <input type="text" value="{{ $meal->value }}" class="form-control w-100" title="Apenas visualização." readonly>
                                        </div>

                                        <div class="col-12 col-lg-4 mt-lg-4 mt-3">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Participa do combo</label>
                                            <input type="text" value="{{ $meal->combo }}" class="form-control w-100" title="Informação se este item participa do combo." readonly>
                                        </div>

                                        @if($meal->combo == 'Sim')
                                            <div class="col-12 col-lg-4 mt-lg-4 mt-3">
                                                <label style="font-size: 16px; color: black;" class="font-weight-bold">Valor no combo <i class="fas fa-hand-holding-usd ml-1 text-primary" style="cursor:pointer;" title="Valor que o cliente paga por este item no combo"></i></label>
                                                <input type="text" value="{{ $meal->comboValue }}" class="form-control w-100"  title="Apenas visualização." readonly>
                                            </div>
                                        @endif

                                        <div class="col-12 col-lg-4 mt-lg-4 mt-3">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Nota de avaliação <i class="fas fa-star text-warning ml-1" style="cursor:pointer;" title="Nota média com base nas avaliações dos clientes"></i></label>
                                            <input type="text" value="{{ round($meal->finalGrade, 1) }}" class="form-control w-100" title="{{ $meal->ratingAmount == null ? 'Este item ainda não tem' :  'Nota ' . round($meal->finalGrade, 1) . ' em ' . $meal->ratingAmount}} {{ $meal->ratingAmount == 1 ? 'avaliação' :  'avaliações'}}" readonly>
                                        </div>

                                        @if($meal->foodType != 'Bebida')
                                            @if($meal->ingredients != null)
                                                <div class="col-12 col-lg-6 mt-lg-6 mt-3">
                                                    <label style="font-size: 16px; color: black;" class="font-weight-bold">Ingredientes: <i class="fas fa-clipboard-list text-info ml-1" style="cursor:pointer;" title="Ingredientes que podem acompanhar este item"></i></label>
                                                    <textarea  id="" cols="30" rows="3" class="form-control" style="resize: none;" readonly>{{ $meal->ingredients }}.</textarea>
                                                </div>
                                            @endif
                                            @if($meal->extras != null)
                                                    <div class="col-12 col-lg-6 mt-lg-6 mt-3">
                                                        <label style="font-size: 16px; color: black;" class="font-weight-bold">Adicionais: <i class="fas fa-plus-circle text-danger ml-1" style="cursor:pointer;" title="Adicionais que podem ser inseridos neste item"></i></label>
                                                        <textarea  id="" cols="30" rows="3" class="form-control" style="resize: none;" readonly>{{ $meal->extras }}.</textarea>
                                                    </div>
                                            @endif
                                        @else
                                            <div class="col-12 col-lg-6 mt-lg-6 mt-3">
                                                <label style="font-size: 16px; color: black;" class="font-weight-bold">Sabores: <i class="far fa-lemon text-warning ml-1" style="cursor:pointer;" title="Variações de sabor deste item"></i></label>
                                                <textarea  id="" cols="30" rows="4" class="form-control" style="resize: none;" readonly>{{ $meal->tastes }}</textarea>
                                            </div>
                                        @endif

                                        <div class="col-12 col-lg-6 mt-lg-6 mt-3">
                                            <label style="font-size: 16px; color: black;" class="font-weight-bold">Descrição: <i class="far fa-keyboard text-dark ml-1" style="cursor:pointer;" title="Descrição do item apresentada ao cliente"></i></label>
                                            <textarea  id="" cols="30" rows="4" class="form-control" style="resize: none;" readonly>{{ $meal->description }}.</textarea>
                                        </div>
                                    </div>


                                    <button type="button" style="color: white" class="btn {{ $meal->status == 'Ativo' ? 'btn-danger' : 'btn-success' }} mt-5" data-toggle="modal" data-target="#toggleAdvert">{{ $meal->status == 'Ativo' ? 'Desativar anúncio' : 'Ativar anúncio' }}</button>
                                    <a href="{{ route('refeicoes.edit', $meal->id) }}" class="btn btn-primary float-right mt-5"><i class="fas fa-edit mr-2"></i>Editar dados cadastrais</a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="toggleAdvert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle" style="color: black; margin-bottom: -30px;">Atenção!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span style="color: black; font-size: 18px">Tem certeza que deseja {{ $meal->status == 'Ativo' ? 'desativar o anúncio deste item?' : 'ativar o anúncio deste item?' }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                    <a href="{{ route('toggleAdvert', $meal->id) }}" style="color: white" class="btn toggleAdvert {{ $meal->status == 'Ativo' ? 'btn-danger' : 'btn-success' }}">{{ $meal->status == 'Ativo' ? 'Desativar anúncio' : 'Ativar anúncio' }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection


