<div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th style="color: black;" scope="col">Item</th>
            <th style="color: black;" scope="col">Quantidade vendida este mês</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale as $value)
            <tr>
                <td style="color: black; cursor: pointer;" title="{{ $value['sales'] }} Itens vendidos">{{ $value['item'] }}</td>
                <td style="color: black; cursor: pointer;" title="{{ $value['sales'] }} Itens vendidos">{{ $value['sales'] == 1 ? $value['sales'] . ' venda' : $value['sales'] . ' vendas'}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
