$(document).ready(() => {

    $.ajax({type: 'GET',
        url: '/E-Pedidos/public/verificarFrete',
        dataType: 'json',
        success: function(data){

            $(".forma-entrega").on('change', function (){
                if ($(this).val() == 'Retirada no restaurante'){
                    let totalValue = data[0][0] - data[0][2];

                    $(".total-val").text(totalValue.toFixed(2));
                }else{
                    let totalValue = data[0][0];

                    $(".total-val").text(totalValue);
                }
            });

        //Entrega em local diferente do cadastrado.
            $(".entregaCasa").on("click", function () {
                let totalValue = parseFloat(data[0][0]);

                console.log(totalValue);

                $(".total-val").text(totalValue.toFixed(2))
            });

            $(".entregaFora").on("click", function () {

                $(".entregaDiff").on('change', function (){
                    let bairro = $(this).val();

                    data[1].forEach((value) =>{
                        if (bairro == value.name){
                            let totalValue = parseFloat(data[0][0]) + parseFloat(value.price) - parseFloat(data[0][2]);

                            $(".total-val").text(totalValue.toFixed(2));
                        }
                    })
                });

            })

        },
        error: function(erro){console.log(erro)}})
})
