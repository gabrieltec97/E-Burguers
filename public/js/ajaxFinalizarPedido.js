$(document).ready(() => {

    $.ajax({type: 'GET',
        url: '/E-Pedidos/public/verificarFrete',
        dataType: 'json',
        success: function(data){

            $(".forma-entrega").on('change', function (){
                if ($(this).val() == 'Retirada no restaurante'){
                    let totalValue = data[0][0] - data[0][2];

                    $(".total-val").text(totalValue);
                }else{
                    let totalValue = data[0][0];

                    $(".total-val").text(totalValue);
                }
            })
        },
        error: function(erro){console.log(erro)}})
})
