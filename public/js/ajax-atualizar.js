$(document).ready(() => {

    function mostrarNotificacao(){
        const notificacao = new Notification("Hey! Temos um novo pedido.", {
            body: 'Um novo pedido foi cadastrado, confira!'
        });
    }

    function mostrarNotificacao2(){
        const notificacao = new Notification("Pedido cancelado!", {
            body: 'Poxa, infelizmente houve um cancelamento de pedido'
        });
    }

    setInterval(function(){

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/dados',
            dataType: 'json',
            success: function(data){

                var valorAnterior = $(".count").val();
                var valorAtual = data.length;
                var tocar = document.getElementById("newOne");

                function playAudio() {
                    tocar.play();
                }

                console.log(valorAtual);
                console.log(valorAnterior);

                // if (valorAtual < valorAnterior){
                //
                //     if (Notification.permission === "granted"){
                //         mostrarNotificacao2();
                //     }else if(Notification.permission !== 'denied'){
                //         Notification.requestPermission().then(permission => {
                //             if (permission === "granted"){
                //                 mostrarNotificacao2();
                //             }
                //         })
                //     }
                //
                //     setTimeout(function (){
                //         location.reload();
                //     }, 800);
                // }else if (valorAnterior < valorAtual){
                //
                //     if (Notification.permission === "granted"){
                //         mostrarNotificacao2();
                //     }else if(Notification.permission !== 'denied'){
                //         Notification.requestPermission().then(permission => {
                //             if (permission === "granted"){
                //                 mostrarNotificacao2();
                //             }
                //         })
                //     }
                //
                //     setTimeout(function (){
                //         location.reload();
                //     }, 800)
                // }

                if (valorAtual > valorAnterior){
                   playAudio();

                    if (Notification.permission === "granted"){
                        mostrarNotificacao();
                    }else if(Notification.permission !== 'denied'){
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted"){
                                mostrarNotificacao();
                            }
                        })
                    }

                    setTimeout(function (){
                        location.reload();
                    }, 800)
                }else if (valorAnterior > valorAtual){
                    playAudio();

                    if (Notification.permission === "granted"){
                        mostrarNotificacao();
                    }else if(Notification.permission !== 'denied'){
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted"){
                                mostrarNotificacao();
                            }
                        })
                    }

                    setTimeout(function (){
                        location.reload();
                    }, 800)
                }

                $(".registereds").text(valorAtual);
            },
            error: function(erro){console.log(erro)}})


        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/ajaxpreparo',
            dataType: 'json',
            success: function(prepare){

                var sum = 0;
                for (let pedido of prepare){
                    if (pedido.status == 'Pronto'){
                        sum += 1;
                    }
                }
                var valorAnterior2 = $(".status-ref").val();
                var tocar2 = document.getElementById("readyOne");

                function playAudio2() {
                    tocar2.play();
                }

               if (valorAnterior2 != sum){
                   playAudio2();

                   setTimeout(function (){
                   location.reload();
               }, 800)
               }
            },
            error: function(erro){console.log(erro)}})

    },10000);
})
