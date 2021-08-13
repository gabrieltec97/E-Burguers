<div>
    <div class="form-group">
        <input wire:model="name" class="form-control mb-3" type="text" placeholder="Digite sua pesquisa.">
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
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->day }}</td>
                        <td>{{ $order->clientName }}</td>
                        <td>{{ $order->deliverWay }}</td>
                        <td>{{ $order->payingMethod }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @else
                    Sem dados..
                @endif
            @endforeach
            </tbody>
        </table>

    <div class="d-flex justify-content-center">
        {{ $orders->links('livewire.pagination') }}
    </div>
</div>
