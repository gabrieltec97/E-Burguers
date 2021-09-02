<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-lg-4 mt-5">
                <div class="card" >
                    <div class="card-header bg-primary text-white font-weight-bold">
                        Resumo de todos os seus pedidos
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item font-weight-bold">Total de pedidos:  <span class="text-success">{{ count($countOrders) }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-8 mt-5">
                <div class="card hist-ped">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Meus pedidos</div>

                    <div class="card-body first-table">
                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">Número do pedido</th>
                                <th scope="col">Detalhes</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $ord)
                                <tr data-toggle="modal" data-target="#exampleModalCenter{{ $ord->id }}" style="cursor: pointer;">
                                    <td class="text-primary font-weight-bold">#{{ $ord->id }}</td>
                                    <td class="text-primary font-weight-bold">{{$ord->orderType}}</td>
                                    <td>
                                        @if($ord->status == 'Cancelado')
                                            <span class="text-danger font-weight-bold">{{ $ord->status }}</span>
                                        @elseif($ord->status == 'Pedido Entregue')
                                            <span class="text-success font-weight-bold">{{ $ord->status }}</span>
                                        @else
                                            <span class="text-info font-weight-bold">{{ $ord->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-primary font-weight-bold">{{ $ord->day }}</td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter{{ $ord->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Informações do pedido</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 d-flex justify-content-center">
                                                            @if($ord->orderType == "Avulso")
                                                                <img src="{{ asset('logo/hamburguer.png') }}" style="width: 250px; height: 250px;" alt="hamburguer">
                                                            @elseif($ord->orderType == "Combo")
                                                                <img src="{{ asset('logo/comida-rapida.png') }}" style="width: 250px; height: 250px;"  alt="hamburguer">
                                                            @endif
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <h2 class="titulo-cardapio mt-3 mt-md-0 text-center">Pedido #{{$ord->id}}</h2>
                                                            <hr>

                                                            {{--                                                       <span class="font-weight-bold text-primary">Data: <span class="font-weight-bold" style="color: black">{{ $ord->day }} - {{ $ord->hour }}</span></span><br>--}}
                                                            <span class="font-weight-bold text-primary">Tipo de pedido: <span class="font-weight-bold" style="color: black">{{ $ord->orderType }}</span></span><br>

                                                            <span class="font-weight-bold text-primary">Itens: <span class="font-weight-bold" style="color: black">
                                                               @if($ord->orderType == "Avulso")
                                                                        {{ $ord->detached }}
                                                                    @elseif($ord->orderType == "Combo")
                                                                        {{ $ord->hamburguer }}, {{ $ord->fries }}, {{ $ord->drinks }}
                                                                    @endif
                                                           </span>
                                                       </span><br>
                                                            <span class="font-weight-bold text-primary">Ingredientes: <span class="font-weight-bold" style="color: black">{{ $ord->comments }}</span></span><br>
                                                            <span class="font-weight-bold text-primary">Valor total: <span class="font-weight-bold" style="color: black">{{ $ord->totalValue }}</span></span><br>
                                                            <span class="font-weight-bold text-primary">Método de pagamento: <span class="font-weight-bold" style="color: black">{{ $ord->payingMethod }}</span></span><br>
                                                            <span class="font-weight-bold text-primary">Método de entrega: <span class="font-weight-bold" style="color: black">{{ $ord->deliverWay }}</span></span><br>
                                                            @if($ord->status == 'Cancelado')
                                                                <span class="font-weight-bold text-primary">Status: <span class="font-weight-bold text-danger">{{ $ord->status }}</span></span><br>
                                                            @else
                                                                <span class="font-weight-bold text-primary">Status: <span class="font-weight-bold text-success">{{ $ord->status }}</span></span><br>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-2">
                            {{ $orders->links('livewire.pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
