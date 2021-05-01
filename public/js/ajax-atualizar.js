$(document).ready(() => {

    setInterval(function(){

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/dados',
            dataType: 'json',
            success: function(data){

                var valorAnterior = $(".count").val();
                var valorAtual = data.length;

                if (valorAnterior != valorAtual){
                    location.reload();
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

               for (let pedido of prepare){
                  data+=(pedido.status);
               }

               if (data != status){
                   location.reload();
               }
            },
            error: function(erro){console.log(erro)}})

    },10000);
})
