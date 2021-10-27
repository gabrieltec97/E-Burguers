@extends('layouts.extend')

@section('title')
    {{ $status[0]->status == 'Fechado' ? 'Abrir' : 'Fechar'}} delivery
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: '{{ $status[0]->status == 'Fechado' ? 'Delivery fechado com sucesso!' : 'Delivery aberto com sucesso!' }}',
                })
            </script>
        @endif

        @if(session('msg-2'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Mensagem de emergência editada com sucesso!',
                })
            </script>
        @endif

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-primary font-weight-bold" style="font-size: 25px; color: white;">
                        @if($status[0]->status == 'Aberto')
                            Delivery aberto<i class="fas fa-circle text-success ml-2 mt-1"></i>
                        @else
                            Delivery fechado<i class="fas fa-circle text-danger ml-2 mt-1"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form id="changeStatus" action="{{ route('changeDeliveryStatus') }}" method="post">
                                        @csrf

                                        @if($status[0]->status == "Aberto")
                                            <label>Mensagem de emergência:</label>
                                            <textarea name="feedback" placeholder="Preencha este campo somente em situações não eventuais de fechamento do delivery." class="form-control" cols="30" rows="5"></textarea>
                                        @endif

                                        <button type="button" class="btn btn-success w-100 mt-4" onclick="verificaMudança()">{{ $status[0]->status == "Fechado" ? "Abrir delivery" : "Fechar delivery" }}</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-primary font-weight-bold" style="font-size: 25px; color: white">Mensagem de feedback</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    @if($status[0]->status == 'Fechado' && $status[0]->message != null)
                                        <label class="justify-content-center font-weight-bold" style="color: red">Mensagem de emergência:</label>
                                        <p>{{ $status[0]->message }} <i class="fas fa-pen ml-2 text-primary" data-toggle="modal" data-target="#editmsg" title="Editar mensagem" style="cursor:pointer;"></i></p>
                                    @elseif($status[0]->status == 'Fechado' && $status[0]->message == null)
                                        <label class="justify-content-center">Sem mensagem de emergência</label>
                                    @else
                                        <label class="justify-content-center">Delivery aberto. Feche o delivery para inserir uma mensagem de fechamento.</label>
                                    @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="editmsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edição da mensagem de emergência</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('editDeliveryStatus') }}" method="post">
                                                            @csrf
                                                            <textarea name="feedback" cols="30" rows="5" class="form-control">{{ $status[0]->message }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-success atualizar-msg-emergencia">Atualizar mensagem</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        function verificaMudança(){

            Swal.fire({
            icon: 'question',
            title: '{{ $status[0]->status == 'Fechado' ? 'Deseja abrir o delivery?' : 'Deseja fechar o delivery?' }}',
            showConfirmButton: false,
            html:
                '<button type="button" class="btn btn-primary mt-2 fechar">Cancelar</button>' +
                '<button type="button" class="btn btn-success mt-2 ml-4 alterar-status-delivery">{{ $status[0]->status == "Fechado" ? "Sim, abrir delivery" : "Sim, fechar delivery" }}</button>'
            });

            $(".fechar").on('click', function (){
                Swal.close();
            });

            $(".alterar-status-delivery").on('click', function (){
                $(this).html('<div class="spinner-border text-light" role="status"></div>');
                $("#changeStatus").submit();
            });
            }
    </script>
@endsection


