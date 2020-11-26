$(document).ready(() => {

    setInterval(function () {

        $.ajax({type: 'GET',
            url: '/E-Pedidos/public/ajaxcozinha',
            dataType: 'json',
            success: function(prepareKitchen){

                var valorAnterior2 = $(".count2").val();
                var valorAtual2 = prepareKitchen.length;

                if (valorAnterior2 != valorAtual2){
                    location.reload();
                }
            },
            error: function(erro){console.log(erro)}})
    },10000)
})
