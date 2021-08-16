<div>
    <ol>
        @if(isset($items))
            @foreach($items as $item)
                <form action="{{ route('removerItem', ['id' => $item->id])}}" method="post">
                    @csrf
                    <li>{{$item->itemName}} <button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></li>

                </form>
            @endforeach
        @endif

        @if(isset($itemWExtras))
            @foreach($itemWExtras as $item2)
                <form action="{{ route('removerPersonalizado', $item2['id']) }}" method="post">
                    @csrf
                    <li><span class="text-success">{{$item2['name']}}<button type="submit" class="fas fa-times text-danger ml-1" style="cursor: pointer; border: none; background-color: white;" title="Remover item"></button></span></li>
                </form>
            @endforeach
        @endif
    </ol>

    @if(isset($val))
        @if($val[0]['totalValue'] != 0)
        <span class="float-right">Valor atual: <span class="text-success">{{ $val[0]['totalValue'] }}</span></span>
        @else
            bandeja vazia, escolhe aí..
        @endif
    @else
       bandeja vazia, escolhe aí..
    @endif
</div>
