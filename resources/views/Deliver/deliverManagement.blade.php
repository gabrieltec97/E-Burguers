@extends('layouts.extend')

@section('title')
    Áreas de entrega
@endsection

@section('content')
    <div class="container">

        @if(session('msg'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Bairro cadastrado com sucesso!',
                })
            </script>
        @endif

        @if(session('msg-2'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Bairro não cadastrado!',
                    text: 'Já existe um bairro cadastrado com este nome, consulte a lista de bairros atendidos.',
                })
            </script>
        @endif

        @if(session('msg-3'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Item deletado com sucesso!'
                })
            </script>
        @endif

        @if(session('msg-4'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registro não alterado',
                    text: 'Você inseriu um valor inválido para taxa de entrega.',
                })
            </script>
        @endif

        @if(session('msg-5'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Registro atualizado com sucesso!',
                })
            </script>
        @endif

        @if(session('msg-6'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Nada a ser alterado!',
                    text: 'Você não fez alterações no registro.',
                })
            </script>
        @endif

        @if(session('msg-7'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registro não alterado!',
                    text: 'Já existe um bairro cadastrado com este nome. Consulte a lista de bairros atendidos.',
                })
            </script>
        @endif

        @livewire('delivery')
    </div>


@endsection


