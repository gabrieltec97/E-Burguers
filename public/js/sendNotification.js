$(document).ready(() => {

    $.ajax({type: 'GET',
        url: '/E-Pedidos/public/enviarNotificacao',
        dataType: 'json',
        success: function(rate){

           

        },
        error: function(erro){console.log(erro)}})
})
