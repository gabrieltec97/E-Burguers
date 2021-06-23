@extends('layouts.extend')
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
                    <div class="alert alert-success sumir-feedback alert-dismissible fade show" role="alert">
                        <strong>Bom trabalho!</strong> {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
                                          <form action="{{ route('preparo.update', $order->id) }}" method="post">
                                              @csrf
                                              @method('PUT')
                                              <i data-toggle="modal" data-target="#exampleModalCenter{{$order->id}}" class="fas fa-check-square text-success" style="font-size: 25px; cursor: pointer"></i>

                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModalCenter{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel"><i class="fas fa-exclamation-triangle mr-1"></i> Um momento..</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <p class="font-weight-bold" style="color: #1b1e21">Certifique-se de que você preparou as refeições corretamente, pois este
                                                                  pedido constará como pronto para o(a) atendente. Deseja confirmar?</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                              <button type="submit" class="btn btn-primary">Confirmar</button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>

                                      </td>
                                  </tr>
                                @endforeach


                            </tbody>
                        </table>

                        <div class="col-6 offset-4 offset-xl-5">
                            <span>{{ $orders->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <select class="count2" hidden>
        <option value="{{ count($orders) }}"></option>
    </select>
@endsection
