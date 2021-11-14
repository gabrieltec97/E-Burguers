$(document).ready(() => {

    $(".ul-pedidos").attr('hidden', 'true');

    function mostrarNotificacao(){
        const notificacao = new Notification("Hey, temos uma atualização do seu pedido.", {
            body: 'Começamos a preparar agora, ok?'
        });
    }

    function mostrarNotificacao2(){
        const notificacao = new Notification("Tudo certo! Seu pedido está pronto.", {
            body: 'Você escolheu retirada no restaurante, pode vir buscar conosco :)'
        });
    }

    function mostrarNotificacao3(){
        const notificacao = new Notification("Tudo certo! Seu pedido está pronto.", {
            body: 'Estamos enviando-o até você, bom apetite!'
        });
    }

    function mostrarNotificacao4(){
        const notificacao = new Notification("Nova notificação.", {
            body: 'Ei! O status do seu pedido foi atualizado, dá uma olhada!'
        });
    }

    function mostrarNotificacao5(){
        const notificacao = new Notification("Nova notificação.", {
            body: 'Ei! O status do seu pedido foi atualizado, dá uma olhada!'
        });
    }

    var send = 'nao';
    var send2 = 'nao';
    let clicado = 'nao';

    setInterval(function(){

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/pedidoCliente',
            dataType: 'json',
            success: function(dados){

                if (dados.length == 1) {

                    var status = dados[0].status;

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

                            if (send == 'nao'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao();
                                        }
                                    })
                                }
                                send = 'sim';
                            }

                        } else if (dados[0].status == 'Em rota de entrega') {
                            $(".et1, .et2, .et3").css('background', '#d4f5d4');
                            $(".et5, .et2, .et3").removeClass('text-secondary');
                            $(".iet5, .iet2").addClass('text-success');
                            $(".iet2ready, #delivery, .page-wrapper, .et2, .closedelivery, .rotaEntrega").removeAttr('hidden', 'true');
                            $(".btn-cancelamentos, .hr-cancelamentos, .cancelarPedido, .li-cancelamento, .iet2, .iet3, .preparing, .footerinfo").attr('hidden', 'true');
                            $(".message-take").text('Seu pedido está pronto e estamos levando-o até você. Fique atento que em instantes o entregador chegará por ai!');
                            $(".title-take").text('Está chegando...');

                            //Travando o clique do botão.
                            $(".btn-cancelamentos, .cancelarPedido").on("click", function (e){
                                e.preventDefault();
                            })

                            if (send == 'sim'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao3();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao3();
                                        }
                                    })
                                }
                                send = 'sim2';
                            }

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

                            if (send == 'nao'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao();
                                        }
                                    })
                                }
                                send = 'sim';
                            }

                        }
                        else if(dados[0].status == 'Pronto para ser retirado no restaurante'){
                            $(".et1, .et2, .et5").css('background', '#d4f5d4');
                            $(".et5, .et2").removeClass('text-secondary');
                            $(".iet5, .iet2").addClass('text-success');
                            $(".info-pedidos").removeClass('col-12');
                            $(".info-pedidos").addClass('col-6');
                            $(".preparing, .li-cancelamento, .footer-info, .buscar-pedido").attr('hidden', 'true');
                            $(".iet2").attr('hidden', 'true');
                            $("#takeThere, .iet2ready, .routegps, .page-wrapper, .et2, .footerinfo, .rotaEntrega, .infoPedidos2").removeAttr('hidden', 'true');
                            $(".message-take").text('Seu pedido já está pronto, e como você escolheu a opção de retirada no balcão,basta você vir aqui buscar seu pedido.');
                            $(".title-take").text('Venha buscar seu pedido');

                            if (clicado == 'nao'){
                                $(".footer-info").click();

                                clicado = 'sim';
                            }


                            //Travando o clique do botão.
                            $(".btn-cancelamentos, .cancelarPedido").on("click", function (e){
                                e.preventDefault();
                            })

                            if (send == 'sim'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao2();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao2();
                                        }
                                    })
                                }
                                send = 'sim2';
                            }
                        }
                    }

                }else if(dados.length > 1){

                    //Envio de notificações
                    dados.forEach((value, key) =>{
                        if (value.status == 'Em preparo' || value == 'Pronto'){
                            var verifica = true;
                        }

                        if (verifica == true){
                            if (send2 == 'nao'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao4();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao4();
                                        }
                                    })
                                }
                                send2 = 'sim';
                            }
                        }
                    })

                    dados.forEach((value, key) =>{
                        if (value.status == 'Pronto para ser retirado no restaurante'){
                            var verifica = true;
                        }

                        if (verifica == true){
                            if (send2 == 'sim'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao2();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao2();
                                        }
                                    })
                                }
                                send2 = 'não';
                            }
                        }
                    })

                    dados.forEach((value, key) =>{
                        if (value.status == 'Em rota de entrega'){
                            var verifica = true;
                        }

                        if (verifica == true){
                            if (send2 == 'sim'){
                                if (Notification.permission === "granted"){
                                    mostrarNotificacao3();
                                }else if(Notification.permission !== 'denied'){
                                    Notification.requestPermission().then(permission => {
                                        if (permission === "granted"){
                                            mostrarNotificacao3();
                                        }
                                    })
                                }
                                send2 = 'não';
                            }
                        }
                    })

                    if(dados[0].status == 'Pronto para ser retirado no restaurante'){
                        $(".et1, .et2, .et5").css('background', '#d4f5d4');
                        $(".preparing, .btn-cancelamentos, .hr-cancelamentos, .cancel-alot").attr('hidden', 'true');
                        $(".et2, .page-wrapper, #takeThere").removeAttr('hidden', 'true');

                        //Travando o clique do botão.
                        $(".btn-cancelamentos").on("click", function (e){
                            e.preventDefault();
                        })
                    }else if (dados[0].status == 'Em rota de entrega') {
                        $(".et1, .et2, .et3").css('background', '#d4f5d4');
                        $(".hr-cancelamentos, .btn-cancelamentos, .et2, .preparing, .cancel-alot").attr('hidden', 'true');
                        $(".page-wrapper, #delivery").removeAttr('hidden', 'true');
                        $(".col-alot").removeClass('col-8');
                        $(".col-alot").addClass('col-12');


                        //Travando o clique do botão.
                        $(".btn-cancelamentos, .cancel-alot").on("click", function (e) {
                            e.preventDefault();
                        })
                    }

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
