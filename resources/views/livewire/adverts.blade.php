<div>
    <table class="table table-striped table-bordered table-responsive-lg">
        <thead>
        <tr>
            <th scope="col" style="color: black; border-bottom: 2px solid  #bdbcbc;">Nome</th>
            <th scope="col" style="color: black; border-bottom: 2px solid #bdbcbc;">Status</th>
            <th scope="col" style="color: black; border-bottom: 2px solid #bdbcbc;">Tipo de refeição</th>
            <th scope="col" style="color: black; border-bottom: 2px solid #bdbcbc;">Vendas</th>
            <th scope="col" style="color: black; border-bottom: 2px solid #bdbcbc;">Valor</th>
            <th scope="col" style="color: black; border-bottom: 2px solid #bdbcbc;">Nota</th>
        </tr>
        </thead>
        <tbody>
        @foreach($meals as $meal)
            <tr>
                <td style="cursor: pointer;"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->name }}</a></td>
                <td style="cursor: pointer;" ><a href="{{ route('refeicoes.show', $meal->id) }}" style="text-decoration: none; {{ $meal->status == 'Ativo' ? 'color: #25d366;' : 'color: red;' }}"> {{ $meal->status }} </a></td>
                <td style="cursor: pointer;"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->foodType }} </a></td>
                <td style="cursor: pointer;"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->totalSale == null ? '0' : $meal->totalSale }}</a></td>
                <td style="cursor: pointer;"><a href="{{ route('refeicoes.show', $meal->id) }}" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->value }}</a></td>
                <td style="cursor: pointer;"><a href="{{ route('refeicoes.show', $meal->id) }}" title="Nota {{ round($meal->finalGrade, 1) }} em {{ $meal->ratingAmount == null ? '0' : $meal->ratingAmount }} avaliações" style="color: rgba(0,0,0,0.73); text-decoration: none">{{ $meal->finalGrade == null ? 'Ainda não avaliado' : round($meal->finalGrade, 1) }}</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $meals->links('livewire.pagination') }}
    </div>
</div>
