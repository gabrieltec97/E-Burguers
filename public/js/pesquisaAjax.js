$(document).ready(() => {

//Pesquisa de pedidos
    $(".meuForm").validate();
$(".meuForm").on("submit", function (e){

    var dataString = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "bin/process.php",
        data: dataString,
        success: function () {
            $("#contact_form").html("<div id='message'></div>");
            $("#message")
                .html("<h2>Contact Form Submitted!</h2>")
                .append("<p>We will be in touch soon.</p>")
                .hide()
                .fadeIn(1500, function () {
                    $("#message").append(
                        "<img id='checkmark' src='images/check.png' />"
                    );
                });
        }
    });

    e.preventDefault();
});







})
