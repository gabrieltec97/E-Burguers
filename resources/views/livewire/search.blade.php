<div>
    <div>
        <div class="form-group">
            <input wire:model="search" class="form-control mb-3" type="text" placeholder="Digite sua pesquisa.">
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Forma de entrega</th>
                <th>Forma de pagamento</th>
                <th>Status</th>
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
                        <td><a style="text-decoration: none; color: black;" href="{{ route('pedidos.show', $order->id) }}">{{ $order->status }}</a></td>
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
