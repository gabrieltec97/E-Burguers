$(document).ready(() => {

    function mostrarNotificacao(){
        const notificacao = new Notification("Hey! Temos um novo pedido.", {
            body: 'Um novo pedido foi cadastrado, confira!'
        });
    }

    function mostrarNotificacao2(){
        const notificacao2 = new Notification("Pedido cancelado!", {
            body: 'Poxa, infelizmente houve um cancelamento de pedido.'
        });
    }

    setInterval(function () {

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/hybridTaking',
            dataType: 'json',
            success: function(hybridData){

                var valorAnterior = parseInt($(".countHybrid").val());
                var valorAtual = parseInt(hybridData.length);
                var tocar3 = document.getElementById("newPrepare");

                function playAudio3() {
                    tocar3.play();
                }

                if (valorAnterior < valorAtual){
                    playAudio3();

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
                    }, 800);


                }else if (valorAnterior > valorAtual){

                    if (Notification.permission === "granted"){
                        mostrarNotificacao2();
                    }else if(Notification.permission !== 'denied'){
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted"){
                                mostrarNotificacao2();
                            }
                        })
                    }

                    setTimeout(function (){
                        location.reload();
                    }, 800);
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
})
