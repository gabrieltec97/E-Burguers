@extends('layouts.extend-employees')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxCozinha.js') }}"></script>

@section('title')
    Pedidos para preparo
@endsection

@section('content')
    <div class="container" style="padding: 0px 0px;">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('msg'))
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 7000,
                            timerProgressBar: true,
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Muito bem! Parabéns por preparar mais este pedido.'
                        })
                    </script>
                @endif
                <div class="card card-prep-emp mb-4">
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: #15b4dc;">
                        <span class="text-white">Pedidos à serem preparados</span> <span class="badge" style="color: black; background: #FFFFFF">{{ count($orders) }}</span></div>

                    <div class="card-body first-table">

                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col" style="color: black">Id</th>
                                <th scope="col" style="color: black">A preparar</th>
                                <th scope="col" style="color: black">Detalhes</th>
                                <th scope="col" style="color: black">Adicionais</th>
                                <th scope="col" style="color: black">Tratativa</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                  <tr style="cursor: pointer">
                                    <td style="color: black" data-toggle="modal" data-target="#exampleModalCenter">#{{ $order->id }}</td>
                                    <td title="Itens do pedido." style="color: black" data-toggle="modal" data-target="#exampleModalCenter">
                                        @if($order->detached != '')
                                            <ul>
                                                @foreach(explode(';', $order->detached) as $item)
                                                    @if($item != null)
                                                        <li class="mt-2" style="color: black">{{$item}}.</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <ul>
                                                <li class="font-weight-bold" style="color: black"><label>{{ $order->hamburguer }}</label></li>
                                                <li class="font-weight-bold" style="color: black"><label> {{ $order->fries }} </label></li>
                                                <li class="font-weight-bold" style="color: black"><label>{{ $order->drinks }}</label></li>
                                            </ul>
                                        @endif
                                    </td>
                                      <td title="Comentários que o cliente inseriu sobre este pedido." data-toggle="modal" data-target="#exampleModalCenter">
                                          @if($order->clientComments != '')
                                              {{ $order->clientComments }}
                                          @else
                                              <span style="color: black">Sem comentários adicionados.</span>
                                          @endif
                                      </td>

                                      <td data-toggle="modal" data-target="#exampleModalCenter">
                                          @if($order->extras != null)
                                              <p class="text-success font-weight-bold" style="color: black">{{ $order->extras }}</p>
                                          @elseif(strripos($order->hamburguer, 'Adicionais'))
                                              <p class="text-success font-weight-bold" style="color: black">Sim</p>
                                          @else
                                            <p class="text-danger font-weight-bold">Não</p>
                                          @endif
                                      </td>

                                      <td>
                                          <form id="readyKitchen{{ $order->id }}" action="{{ route('preparo.update', $order->id) }}" method="post">
                                              @csrf
                                              @method('PUT')
                                              <i class="fas fa-check-square text-success" onclick="triggerModal({{ $order->id }})" style="font-size: 25px; cursor: pointer"></i>
                                          </form>

                                      </td>
                                  </tr>

                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">Informações do pedido.</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  @if($order->detached != '')
                                                      <ul>
                                                          @foreach(explode(';', $order->detached) as $item)
                                                              @if($item != null)
                                                                  <li class="mt-2 font-weight-bold" style="color: black">{{$item}}.</li>
                                                              @endif
                                                          @endforeach
                                                      </ul>
                                                  @else
                                                      <ul>
                                                          <li class="font-weight-bold" style="color: black"><label>{{ $order->hamburguer }}</label></li>
                                                          <li class="font-weight-bold" style="color: black"><label> {{ $order->fries }} </label></li>
                                                          <li class="font-weight-bold" style="color: black"><label>{{ $order->drinks }}</label></li>
                                                      </ul>
                                                  @endif
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="newPrepare">
        <source src="{{ asset('audio/kitchen.mp3') }}" type="audio/mp3">
    </audio>

    <select class="count2" hidden>
        <option value="{{ count($orders) }}"></option>
    </select>

    <script>
        function triggerModal(id){

            Swal.fire({
                title: 'Este pedido está pronto? Verifique se foi preparado corretamente.',
                icon: 'question',
                showCancelButton: false,
                showConfirmButton: false,
                html:
                    '<button type="button" class="btn btn-success mt-2 finished">Confirmar</button>' +
                    '<button type="button" class="btn btn-primary mt-2 ml-4 fechar">Voltar</button>'
            })

            $(".fechar").on('click', function (){
                Swal.close()
            })

            $(".finished").on('click', function (){
                $(this).html('<div class="spinner-border text-light" role="status"></div>');
                $("#readyKitchen"+ id).submit();
            })
        }
    </script>
@endsection
