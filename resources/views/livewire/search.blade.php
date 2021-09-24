<div>
    <div>
        <div class="form-group">
            <input wire:model="search" class="form-control mb-3" type="text" placeholder="Digite sua pesquisa.">
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th style="color: black">Id</th>
                <th style="color: black">Data</th>
                <th style="color: black">Cliente</th>
                <th style="color: black">Forma de entrega</th>
                <th style="color: black">Forma de pagamento</th>
                <th style="color: black">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @if($order != '')
                    <tr>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->id }}</a></td>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->day }}</a></td>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->clientName }}</a></td>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->deliverWay }}</a></td>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->payingMethod }}</a></td>
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">
                                <button class="btn font-weight-bold" style="border-radius: 50px; border: none;

                                                    {{ $order->status == 'Pedido Entregue' ? 'background: #00e676; color: #fffcfc' : ''  }}
                                {{ $order->status == 'Pedido registrado' ? 'background: #5bc0de; color: #fffcfc' : ''  }}
                                {{ $order->status == 'Cancelado' ? 'background: #f74242; color: #fffcfc' : ''  }}
                                {{ $order->status == 'Pronto' ? 'background: #FFD700; color: black' : ''  }}
                                {{ $order->status == 'Em preparo' ? 'background: #FFD700; color: black' : ''  }}
                                {{ $order->status == 'Pronto para ser retirado no restaurante' ? 'background: #22e583; color: #fffcfc' : ''  }}
                                    ">{{ $order->status == 'Pronto para ser retirado no restaurante' ? 'Aguardando retirada' : $order->status  }}
                                    @if($order->status == 'Pronto' or $order->status == 'Pronto para ser retirado no restaurante')
                                        <span class="spinner-grow spinner-grow-sm text-danger" style="margin-bottom: 2.8px; margin-left: 4px" role="status" aria-hidden="true"></span>
                                    @endif
                                </button>
                            </a></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $orders->links('livewire.pagination') }}
        </div>
</div>
</div>
