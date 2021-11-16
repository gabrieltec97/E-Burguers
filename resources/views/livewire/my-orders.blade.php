<div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 mt-lg-5 mt-4">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-dark" style="font-size: 25px;">Meus pedidos - {{ count($countOrders) }} {{ count($countOrders) > 1 ? 'pedidos' : 'pedido' }}</div>

                    <div class="card-body first-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Número do pedido</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $ord)
                                <tr data-toggle="modal" data-target="#exampleModalCenter{{ $ord->id }}" style="cursor: pointer;">
                                    <td style="font-size: 16px">#{{ $ord->id }}</td>
                                    <td>
                                        @if($ord->status == 'Cancelado')
                                            <span class="text-danger" style="font-size: 15px">{{ $ord->status }}</span>
                                        @elseif($ord->status == 'Pedido Entregue')
                                            <span class="text-success" style="font-size: 15px">{{ $ord->status }}</span>
                                        @else
                                            <span class="text-info" style="font-size: 15px">{{ $ord->status }}</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 16px">{{ $ord->day }}</td>
                                </tr>

                                <?php
                                $count = strlen($ord->totalValue);

                                if ($count == 4 && $ord->totalValue > 10){
                                    $price = $ord->totalValue . '0';
                                }elseif ($count == 2){
                                    $price = $ord->totalValue. '.' . '00';
                                }
                                else{
                                    $price = $ord->totalValue;
                                }
                                ?>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter{{ $ord->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark">
                                                <h5 class="modal-title font-weight-bold" style="color: white" id="exampleModalLongTitle">Informações do pedido</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 d-flex justify-content-center">
                                                            @if($ord->orderType == "Avulso")
                                                                <img src="{{ asset('logo/pizza.png') }}" class="img-pedido" alt="hamburguer">
                                                            @elseif($ord->orderType == "Combo")
                                                                <img src="{{ asset('logo/comida-rapida.png') }}" style="width: 250px; height: 250px;"  alt="hamburguer">
                                                            @endif
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <h2 class="titulo-cardapio mt-3 mt-md-0 text-center">Pedido {{$ord->id}}</h2>
                                                            <hr>

                                                            <span style="font-size: 16px">Itens: <span class="text-primary font-weight-normal" style="font-size: 15px">
                                                               @if($ord->orderType == "Avulso")
                                                                        {{ $ord->detached }}
                                                                    @elseif($ord->orderType == "Combo")
                                                                        {{ $ord->hamburguer }}, {{ $ord->fries }}, {{ $ord->drinks }}
                                                                    @endif
                                                           </span>
                                                       </span><br>
                                                            <span style="font-size: 16px">Método de pagamento: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $ord->payingMethod }}</span></span><br>
                                                            <span style="font-size: 16px">Método de entrega: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $ord->deliverWay }}</span></span><br>
                                                            @if($ord->deliverWay == 'Entrega em domicílio' && $ord->status != 'Cancelado')
                                                                <span style="font-size: 16px">Entregue em: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $ord->address }}</span></span><br>
                                                            @endif
                                                            @if($ord->status == 'Cancelado')
                                                                <span style="font-size: 16px">Status: <span class="text-danger">{{ $ord->status }}</span></span><br>
                                                            @else
                                                                <span style="font-size: 16px">Status: <span class="text-success">{{ $ord->status }}</span></span><br>
                                                            @endif
                                                            <span style="font-size: 16px">Comentários: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $ord->comments != '' ? $ord->comments : 'Sem comentários adicionados.' }}</span></span><br>

                                                            <span style="font-size: 16px">Data: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $ord->day }} - {{ $ord->hour }}</span></span><br>
                                                            <span style="font-size: 16px">Valor total: <span class="text-primary font-weight-normal" style="font-size: 15px">{{ $price }}</span></span>

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
