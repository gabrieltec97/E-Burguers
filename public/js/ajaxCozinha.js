$(document).ready(() => {

    function mostrarNotificacao(){
        const notificacao = new Notification("Hey! Novo pedido.", {
            body: 'Temos um novo pedido para preparo, vamos nessa?'
        });
    }

    function mostrarNotificacao2(){
        const notificacao2 = new Notification("Poxa, pedido cancelado!", {
            body: 'Infelizmente houve um cancelamento de pedido.'
        });
    }

    setInterval(function () {

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/ajaxcozinha',
            dataType: 'json',
            success: function(prepareKitchen){

                var valorAnterior2 = $(".count2").val();
                var valorAtual2 = prepareKitchen.length;
                var tocar3 = document.getElementById("newPrepare");

                function playAudio3() {
                    tocar3.play();
                }

                if (valorAnterior2 < valorAtual2){
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
                    }, 800)
                }

                else if (valorAnterior2 > valorAtual2){

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
                    }, 800)
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
});
