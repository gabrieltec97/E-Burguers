$(document).ready(() => {

    setInterval(function(){

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/dados',
            dataType: 'json',
            success: function(data){

                var valorAnterior = $(".count").val();
                var valorAtual = data.length;
                var tocar = document.getElementById("newOne");
                console.log(valorAtual);
                console.log('ant' + valorAnterior);

                function playAudio() {
                    tocar.play();
                }
                if (valorAtual > valorAnterior ){
                   playAudio();

                    setTimeout(function (){
                        location.reload();
                    }, 800)
                }else if (valorAnterior > valorAtual){
                    
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
