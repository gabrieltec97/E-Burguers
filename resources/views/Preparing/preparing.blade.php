@extends('layouts.extend-employees')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxCozinha.js') }}"></script>

@section('title')
    Pedidos para preparo
@endsection

@section('content')
    <div class="container">
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
                    <div class="card-header font-weight-bold text-muted" style="font-size: 25px; background: linear-gradient(90deg, rgba(230,85,85,1) 45%, rgba(231,224,73,1) 76%);">
                        <span class="text-white">Pedidos à serem preparados</span> <span class="badge bg-secondary text-white">{{ count($orders) }}</span></div>

                    <div class="card-body first-table">

                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">A preparar</th>
                                <th scope="col">Detalhes</th>
                                <th scope="col">Adicionais</th>
                                <th scope="col">Tratativa</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                  <tr style="cursor: pointer">
                                    <td>#{{ $order->id }}</td>
                                    <td title="Itens do pedido.">
                                        @if($order->detached != '')
                                            <ul>
                                                @foreach(explode(';', $order->detached) as $item)
                                                    @if($item != null)
                                                        <li class="mt-2">{{$item}}.</li>
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
                                      <td title="Comentários que o cliente inseriu sobre este pedido.">
                                          @if($order->clientComments != '')
                                              {{ $order->clientComments }}
                                          @else
                                              <span>Sem comentários adicionados.</span>
                                          @endif
                                      </td>

                                      <td>
                                          @if($order->extras != null)
                                              <p class="text-success font-weight-bold">{{ $order->extras }}</p>
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
                                @endforeach


                            </tbody>
                        </table>

                        <div class="col-12">
                            <span style="">{{ $orders->links() }}</span>
                        </div>
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
                title: 'Este pedido está pronto? Verifique se foi feito corretamente.',
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
