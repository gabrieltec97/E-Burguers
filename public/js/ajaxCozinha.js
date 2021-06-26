$(document).ready(() => {

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

                if (valorAnterior2 != valorAtual2){
                    playAudio3();

                    setTimeout(function (){
                        location.reload();
                    }, 800)
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
})
