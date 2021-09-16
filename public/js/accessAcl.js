$(document).ready(() => {
    $(".modalACLroute").click();

    setTimeout(function (){
        $(".warn-message").html('<div class="spinner-border text-primary" role="status"></div> <span class="ml-2 text-danger">Redirecionando...</span>');
        // window.location.href = '/E-Pedidos/public/home';
    }, 20000)
});
