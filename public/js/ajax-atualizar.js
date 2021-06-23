$(document).ready(() => {

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
                if (valorAnterior != valorAtual){
                   playAudio();

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

                var status = $(".status-ref").val();
                var data = '';
                var tocar2 = document.getElementById("readyOne");

                function playAudio2() {
                    tocar2.play();
                }

               for (let pedido of prepare){
                  data+=(pedido.status);
               }

               if (data != status){
                   playAudio2();

                   setTimeout(function (){
                       location.reload();
                   }, 800)
               }
            },
            error: function(erro){console.log(erro)}})

    },10000);
})
