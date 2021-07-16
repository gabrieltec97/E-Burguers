$(document).ready(() => {

    $(".ul-pedidos").attr('hidden', 'true');

    setInterval(function(){

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/pedidoCliente',
            dataType: 'json',
            success: function(dados){

            console.log(dados)

                if (dados.length == 1) {
                    $(".ul-pedidos").removeAttr('hidden', 'true');
                    $(".verifica-pedido").attr('hidden', 'true');

                    if (dados[0].deliverWay == 'Entrega em domicílio') {

                        $(".et5").attr('hidden', 'true');

                        if (dados[0].status == 'Pedido registrado') {
                            $(".et1").css('background', '#d4f5d4');
                        } else if (dados[0].status == 'Em preparo' || dados[0].status == 'Pronto') {
                            $(".et1").css('background', '#d4f5d4');
                            $(".et2").attr('hidden', 'true');
                            $(".preparing").removeAttr('hidden', 'true');
                            $(".preparing").css('background', '#d4f5d4');
                        } else if (dados[0].status == 'Em rota de entrega') {
                            $(".et1, .et2, .et3").css('background', '#d4f5d4');
                            $(".preparing").attr('hidden', 'true');
                            $(".et2").removeAttr('hidden', 'true');
                            $(".btn-cancelamentos, .cancelarPedido, .li-cancelamento").attr('hidden', 'true');
                            $(".hr-cancelamentos").attr('hidden', 'true');

                            //Travando o clique do botão.
                            $(".btn-cancelamentos, .cancelarPedido").on("click", function (e){
                                e.preventDefault();
                            })
                        }
                    }else {
                        $(".et5").removeAttr('hidden', 'true');

                        $(".et3").attr('hidden', 'true');

                        if (dados[0].status == 'Pedido registrado') {
                            $(".et1").css('background', '#d4f5d4');
                        }
                        else if(dados[0].status == 'Em preparo' || dados[0].status == 'Pronto'){
                            $(".et1").css('background', '#d4f5d4');
                            $(".et2").attr('hidden', 'true');
                            $(".preparing").removeAttr('hidden', 'true');
                            $(".preparing").css('background', '#d4f5d4');
                        }
                        else if(dados[0].status == 'Pronto para ser retirado no restaurante'){
                            $(".et1, .et2, .et5").css('background', '#d4f5d4');
                            $(".preparing").attr('hidden', 'true');
                            $(".et2").removeAttr('hidden', 'true');
                            $(".btn-cancelamentos, .cancelarPedido, .li-cancelamento").attr('hidden', 'true');
                            $(".hr-cancelamentos").attr('hidden', 'true');

                            //Travando o clique do botão.
                            $(".btn-cancelamentos, .cancelarPedido").on("click", function (e){
                                e.preventDefault();
                            })
                        }
                    }
                }else if(dados.length > 1){

                    if(dados[0].status == 'Pronto para ser retirado no restaurante'){
                        $(".et1, .et2, .et5").css('background', '#d4f5d4');
                        $(".preparing").attr('hidden', 'true');
                        $(".et2").removeAttr('hidden', 'true');
                        $(".btn-cancelamentos").attr('hidden', 'true');
                        $(".hr-cancelamentos").attr('hidden', 'true');

                        //Travando o clique do botão.
                        $(".btn-cancelamentos").on("click", function (e){
                            e.preventDefault();
                        })
                    }else if (dados[0].status == 'Em rota de entrega') {
                        $(".et1, .et2, .et3").css('background', '#d4f5d4');
                        $(".preparing").attr('hidden', 'true');
                        $(".et2").removeAttr('hidden', 'true');
                        $(".btn-cancelamentos").attr('hidden', 'true');
                        $(".hr-cancelamentos").attr('hidden', 'true');

                        //Travando o clique do botão.
                        $(".btn-cancelamentos").on("click", function (e) {
                            e.preventDefault();
                        })
                    }

                    // let original = $(".dados-tab").text();
                    let data = '';

                    for (let pedido of dados){
                        data+= "<tr><td>"+ '#'+ (pedido.id) + "</td>";
                        data+= "<td>"+ (pedido.hour) + "</td>";
                        data+= "<td>"+ (pedido.status) + "</td></tr>";
                    }

                    $(".dados-tab").html(data);
                }

                if (dados.length == 0){
                    location.reload();
                }
            },
            error: function(erro){console.log(erro)}})


    },10000);

})
