<div>
    <table class="table table-bordered table-hover" style="cursor: pointer">
        <thead>
        <tr>
            <th scope="col" style="color: black">Nota <i class="fas fa-star text-warning"></i></th>
            <th scope="col" style="color: black">Comentário</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rating as $r)
            <tr>
                <td style="color: rgba(0,0,0,0.73);">{{ $r->ratingGrade }}</td>
                <td style="color: rgba(0,0,0,0.73);">{{ $r->comments }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $rating->links('livewire.pagination') }}
    </div>
</div>
