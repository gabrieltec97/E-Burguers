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

                    setTimeout(function (){
                        location.reload();
                    }, 800);


                }else if (valorAnterior > valorAtual){

                    setTimeout(function (){
                        location.reload();
                    }, 800);
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
})
