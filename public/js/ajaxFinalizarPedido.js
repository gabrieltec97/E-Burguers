$(document).ready(() => {

    $.ajax({type: 'GET',
        url: '/E-Pedidos/public/verificarFrete',
        dataType: 'json',
        success: function(data){

        //Aplicando alterações visuais de frete apenas se não houver pedidos pendentes e/ou em andamento.
            let pendente = data[0][3]
            let emAndamento = data[0][4]

            if (pendente == 'Não' && emAndamento == 'Não'){
                $(".forma-entrega").on('change', function (){

                    //Verificando se há o uso de cupom de frete grátis.
                    if ($(this).val() == 'Retirada no restaurante'){
                        if (data[0][5] == "Não"){
                            let totalValue = data[0][0] - data[0][2];

                            $(".total-val").text(totalValue.toFixed(2));
                        }

                    }else{
                        let totalValue = data[0][0];

                        $(".total-val").text(totalValue);
                    }
                });

                //Entrega em local diferente do cadastrado.
                $(".entregaCasa").on("click", function () {
                    let totalValue = parseFloat(data[0][0]);

                    $(".entregaDiff").removeAttr('required', 'true');
                    $(".pontoRef").removeAttr('required', 'true');
                    $(".end-entrega").removeAttr('required', 'true');

                    $(".total-val").text(totalValue.toFixed(2))
                });

                $(".entregaFora").on("click", function () {
                    $(".entregaDiff").attr('required', 'true');
                    $(".pontoRef").attr('required', 'true');
                    $(".end-entrega").attr('required', 'true');

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
            }

        },
        error: function(erro){console.log(erro)}});

    //Formatações fora do Ajax.

    $(".aplicar-cupom").on('click', function(e){
        e.preventDefault();
        $(".diffEnd").val($(".end-entrega").val());
        $(".adSend").val($(".adDeliver").val());
        $(".newPrice").val($(".total-val").text());
        $(".refPoint").val($(".pontoRef").val());
        $(".district").val($(".entregaDiff").val());
        $(".deliverType").val($(".forma-entrega").val());
        $(".payingMethod").val($(".forma-pagamento").val());
        $(".payingValue").val($(".troco").val());

        if ($(".cupomDesconto").val() != ''){
            $("#couponApply").submit();
        }else{
            $(".aplicar-cupom").html('<p>Aplicar cupom</p>')
        }
    });

    let deliver = $(".deliver-coupon").val();

    if(deliver != "" || deliver != null){

        if (deliver == 'Retirada no restaurante'){
            $(".troco").removeAttr('required', 'true');
            $(".pagamento").hide();
            $(".entrega").hide();
            $(".local-entrega").hide();
            $(".val-entregue").hide();
            $(".finalizar-pedido").removeAttr('disabled', 'true');
        }
    }

    //Envio de formulário de remoção de cupom e local alterado.
    $(".alterar-local-cupom").on('click', function (){
        $(".remove-cupon").click();
    });
});

