$(document).ready(() => {

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
                        var notification = new Notification("Você tem um novo pedido");

                        setTimeout(function (){
                            $("#showNotif").submit();
                        }, 1000);

                    }else if(Notification.permission !== 'denied'){
                        Notification.requestPermission().then(permission => {

                            if (permission === "granted"){
                                var notification = new Notification("Você tem um novo pedido");

                                setTimeout(function (){
                                    $("#showNotif").submit();
                                }, 1000);
                            }
                        })
                    }

                    setTimeout(function (){
                        location.reload();
                    }, 1000);

                }else if (valorAnterior > valorAtual){

                    if (Notification.permission === "granted"){

                        var notification = new Notification("Pedido cancelado!");

                        setTimeout(function (){
                            $("#showCancelotif").submit();
                        }, 1000);

                    }else if(Notification.permission !== 'denied'){
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted"){
                                var notification = new Notification("Pedido cancelado!");

                                setTimeout(function (){
                                    $("#showCancelotif").submit();
                                }, 1000);
                            }
                        })
                    }

                    setTimeout(function (){
                        location.reload();
                    }, 1000);
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
})
