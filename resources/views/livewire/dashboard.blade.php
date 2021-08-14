<div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th style="color: black;" scope="col">#id</th>
            <th style="color: black;" scope="col">Item</th>
            <th style="color: black;" scope="col">Quantidade vendida este mês</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $value)
            <tr>
                <th style="color: black; cursor: pointer;" title="{{ $value->totalSale }} Itens vendidos" scope="row">{{ $value->id }}</th>
                <td style="color: black; cursor: pointer;" title="{{ $value->totalSale }} Itens vendidos">{{ $value->name }}</td>
                <td style="color: black; cursor: pointer;" title="{{ $value->totalSale }} Itens vendidos">{{ $value->totalSale == 1 ? $value->totalSale . ' venda' : $value->totalSale . ' vendas'}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-2">
        {{ $items->links('livewire.pagination') }}
    </div>
</div>
