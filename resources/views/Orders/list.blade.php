@extends('layouts.extend')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jqueryStyles.js') }}"></script>


@section('title')
    Histórico de pedidos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card hist-ped">
                    <div class="card-header font-weight-bold text-white bg-primary" style="font-size: 25px;">Pedidos registrados</div>
                    <div class="card-body first-table">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Faça sua pesquisa" />
                                </div>
                                <div class="table-responsive">
{{--                                    <label class="font-weight-bold">Total de registros: <span id="total_records"></span></label>--}}
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
                                        </tbody>
                                    </table>

                                    <div class="pag">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <button class="mydialog56" hidden></button>
<script>

   $(".mydialog56").on("click", function(){

    bs4pop.notice('<b>Pedidos recebidos hoje: {{ $count }}</b>', {
        type: 'primary',
        position: 'topright',
        appendType: 'append',
        closeBtn: 'false',
            className: ''
        })
})
</script>

    <script>
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('buscaPedidos') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('tbody').html(data.table_data);
                        $('.pag').html(data.datas);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
    </script>
@endsection
