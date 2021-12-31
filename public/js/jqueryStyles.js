$(function () {

// Ajuste de imagem de usuário no menu lateral.
$(".div-img-user, .text-entregas").hide();

//Verificação de itens vendidos e cancelados hoje.
$(".vendidos, .pedidos-cancelados, .text-bebida").hide();

//Mascara de horário de funcionamento
$(".horarioFuncionamento").mask('00:00');

$(".hamburger").click(function () {

    setTimeout(function () {
        $(".div-img-user").toggle('medium');
    }, 300)

});

    $(".div-pizzas, .div-drinks, .div-desserts, .div-medium-pizzas, .div-large-pizzas").hide();

//Ajuste em carrinho do menu superior
$(".hamburger-menu").on("click", function (){
   $(".arelocala-carrinho-hide-big").toggle();
});

//Verificação e disparo de modal de criação de novo usuário.

    $(".disparador").hide();

    $(".disparador").on('click', function () {

        $(".bg-box").fadeIn('fast');
        $(".div-box").fadeIn('fast');
    })

    $(".bg-box, .div-box, .sair").on('click', function () {

        $(".bg-box").fadeOut('fast');
        $(".div-box").fadeOut('fast');
    })


$(".select-cargo").change(function () {
    if($('.select-cargo :selected').text() == 'Administrador'){
        $(".disparador").click();
    };
})

//Tratativa para bloqueamento de campo de senha em criação de funcionário sem login.

        $(".select-cargo").change(function () {
            if($('.select-cargo :selected').text() == 'Outro (Sem login)'){
                $(".senha").attr('readonly', 'true');
                $(".senha").removeAttr('required', 'true')
                $(".empEmail").text('E-mail (opcional)');
                $(".senha").removeAttr('required', 'true')
            }else{
                $(".senha").removeAttr('readonly', 'true');
                $(".empEmail").text('E-mail');
            };
        })


//Tratativa de escolha de cargo junto com perfil de usuário.

    $(".select-occ").change(function () {
        if($('.select-occ :selected').text() == 'Outro' || $('.select-occ :selected').text() == 'Limpeza' || $('.select-occ :selected').text() == 'Garçom'){
            $('.select-cargo').val('Outro (Sem login)');

            $(".senha").attr('readonly', 'true');
            $(".senha").attr('title', 'Como o usuário não terá acesso ao sistema, não é permitido criar uma senha.');
            $(".senha").removeAttr('required', 'true')
            $(".empEmail").text('E-mail (opcional)');
            $(".empEmail").removeAttr('required', 'true')
            $(".senha").removeAttr('required', 'true')
            $(".senha").css('cursor', 'not-allowed')


        } else if ($('.select-occ :selected').text() == 'Administrador'){
            $(".disparador").click();
            $('.select-cargo').val('Administrador');

            $(".senha").removeAttr('readonly', 'true');
            $(".senha").removeAttr('title', 'true');
            $(".senha").css('cursor', 'inherit');
            $(".empEmail").text('E-mail');

        }else if($('.select-occ :selected').text() == 'Atendente'){
            $('.select-cargo').val('Atendente');

            $(".senha").removeAttr('readonly', 'true');
            $(".senha").removeAttr('title', 'true');
            $(".senha").css('cursor', 'inherit');
            $(".empEmail").text('E-mail');

        }else if($('.select-occ :selected').text() == 'Cozinheiro'){
            $('.select-cargo').val('Cozinheiro');

            $(".senha").removeAttr('readonly', 'true');
            $(".senha").removeAttr('title', 'true');
            $(".senha").css('cursor', 'inherit');
            $(".empEmail").text('E-mail');
        }
    })


//Informativo de dados cadastrais de funcionário.

    $(".campo").on('mouseenter', function () {
        $(".campo").css('cursor', 'not-allowed');
    })

    $(".campo").on('click', function () {

        $(".bg-box").fadeIn('fast');
        $(".div-box").fadeIn('fast');
    })

    $(".bg-box, .div-box, .sair").on('click', function () {

        $(".bg-box").fadeOut('fast');
        $(".div-box").fadeOut('fast');
    })

//Inserção de máscara na view de cadastro de funcionários.

    $(".empHour").mask('00:00 - 00:00');

//Verificações adicionais na view de novo funcionário.


//Inserção de máscara na view de cadastro de usuário.

    $(".user-Phone").mask('(00) 00000-0000');
    $(".userFixedPhone").mask('(00) 0000-0000');


//Verificação e inserção de máscara em cadastro de alimentos.

$(".verificaPreco").hide();

// $(".impComboNao").on('click', function () {
//
//     if($(this).val() == 'Não'){
//         $(".valComboPromo").val('Esta refeição não participará do combo.');
//         $(".valComboPromo").attr('readonly', 'true');
//         $(".valComboPromo").css('cursor', 'not-allowed');
//         $(".verificaPreco").hide();
//     }
// })
//
// $(".impComboSim").on('click', function () {
//     $(".valComboPromo").val('');
//     $(".valComboPromo").removeAttr('readonly');
//     $(".valComboPromo").css('cursor', 'initial')
// })
//
    //Inserção de máscara de preço na view de cadastro de anuncio.
    $(".valorRefeicao, .taxaEntrega").keyup(function (){
        $(this).mask('000.00', {reverse: true});
    })
//
// $(".valComboPromo, .valComboPromo-edit").on('keyup', function () {
//
//     if(parseInt($(".valComboPromo, .valComboPromo-edit").val()) >= parseInt($(".valorRefeicao, .valorRefeicao-edit").val())){
//         $(".verificaPreco").fadeIn('slow');
//     }else{
//         $(".verificaPreco").fadeOut('slow');
//     }
// });

//Colocando nome do cupom em maiúsculo.

    $(".nome-cupom").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    })

//Edição de cupom

    const nome = $(".novo-nome").val();
    const dataExp = $(".data-exp").val();
    const desconto = $(".select-desconto").val();
    const valorCompra =  $(".compras-acima").val();

    $(".salvamento-alteracoes-cupom").on("click", function () {

        if(nome == $(".novo-nome").val() && valorCompra == $(".compras-acima").val() && desconto == $(".select-desconto").val() && dataExp == $(".data-exp").val()){

            $(".p-mudancas").text("Você não efetuou nenhuma alteração.");
            $(".imagem-alteracao").removeAttr('hidden');
            $(".botao-salvar").attr('hidden', 'true');
        }else{
            $(".p-mudancas").text('Revise as alterações antes de prosseguir com o salvamento.');
            $(".imagem-alteracao").attr('hidden', 'true');
            $(".botao-salvar").removeAttr('hidden', 'true');
        }

        if(nome != $(".novo-nome").val()){
            $(".div-novo-nome").removeAttr('hidden', 'true');
            $(".novo-nome-cupom").text($(".novo-nome").val());
        }else{
            $(".div-novo-nome").attr('hidden', 'true');
        }

        if(dataExp != $(".data-exp").val()){
            $(".div-nova-data").removeAttr('hidden', 'true');
            $(".nova-data").text($(".data-exp").val());

        }else{
            $(".div-nova-data").attr('hidden', 'true');
        }

        if(desconto != $(".select-desconto").val()){
            $(".div-novo-desconto").removeAttr('hidden', 'true');
            $(".novo-desconto").text($(".select-desconto").val());

        }else{
            $(".div-novo-desconto").attr('hidden', 'true');
        }

        if(valorCompra != $(".compras-acima").val()){
            $(".div-novo-valor").removeAttr('hidden', 'true');
            $(".novo-valor").text($(".compras-acima").val());

        }else{
            $(".div-novo-valor").attr('hidden', 'true');
        }
    })

//Verificando expiração de cupom.
    $(".cupom-expire").hide();
    $(".cupom-expire2").hide();

    var dateToday = new Date();

    if (dateToday.getMonth() < 9){
        if (dateToday.getDate() < 9){
            dateToday = dateToday.getFullYear() + '-' + '0'+ (dateToday.getMonth() + 1) + '-' + '0'+ dateToday.getDate();
        }else{
            dateToday = dateToday.getFullYear() + '-' + '0'+ (dateToday.getMonth() + 1) + '-' + dateToday.getDate();
        }

    }else{
        if (dateToday.getDate() < 9){
            dateToday = dateToday.getFullYear() + '-' + (dateToday.getMonth() + 1) + '-' + '0'+ dateToday.getDate();
        }else{
            dateToday = dateToday.getFullYear() + '-' + (dateToday.getMonth() + 1) + '-' + dateToday.getDate();
        }
    }

    //Verificando data de novo cupom.
    $(".data-exp-cupom, .data-exp").on("change", function (){

        var teste = $(".data-exp-cupom, .data-exp").val();
        if(parseInt(teste.replace(/-/g,""),10) < parseInt(dateToday.replace(/-/g,""),10)){
            $(".cupom-expire2").fadeIn('slow');
            $(".cupom-expire").fadeOut();
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").attr('disabled', 'true')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'not-allowed')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").attr('title', 'Verifique a data de expiração do cupom.')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom, .botao-salvar").on("click", function (e){
                e.preventDefault();
            })
        }else if (parseInt(teste.replace(/-/g,""),10) == parseInt(dateToday.replace(/-/g,""),10)){
            $(".cupom-expire2").fadeOut();
            $(".cupom-expire").fadeIn('slow');
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").attr('disabled', 'true')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'not-allowed')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").attr('title', 'Verifique a data de expiração do cupom.')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom, .botao-salvar").on("click", function (e){
                e.preventDefault();
            })
        }else{
            $(".cupom-expire").fadeOut('slow');
            $(".cupom-expire2").fadeOut('slow');
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").removeAttr('disabled', 'true')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").removeAttr('title', 'true')
            $(".cadastrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'pointer')
            $(".cadastrar-cupom, .botao-salvar").on("click", function (e){
                $(".cupom-sub").submit();
            })
        }
    })

//Verificação de cadastro de refeição.

    $(".verifica-ingredientes").hide();

    // $(".valComboPromo, .nome-refeicao, .impComboSim, .impComboNao, .descricao, .valorRefeicao, .sabores-edit, .ingredientes-edit, .nome-refeicao-edit, .valorRefeicao-edi, .valComboPromo-edit, .descricao-edit").on("click", function (){
    //     $(".verifica-ingredientes").fadeOut('slow');
    // })

$(".ingredientes, .ingredientes-edit, .sabores-edit").on("click", function () {
    $(".verifica-ingredientes").fadeIn('slow')
})

$(".ingredientes").on("keyup", function (){
  $(".exemplo").fadeOut('slow');

    var valor = $(".ingredientes, .ingredientes-edit").val();
    var tamanho = valor.length;

    if(tamanho == 0){
      $(".exemplo").fadeIn('slow');
    }else{
      $(".exemplo").fadeOut('slow');
    }

    });

// $(".descricao, .descricao-edit").on("click", function (){
//     $(".lbl-alerta, .total-char").fadeIn('slow');
//
//     setTimeout(function (){
//         $(".lbl-alerta").fadeOut('slow');
//     },10000)
// });

// $(".descricao, .descricao-edit").on("keyup", function (){
//
//    var text = $(".descricao, .descricao-edit").val();
//    var totalChar = text.length;
//
//    if(totalChar < 70 || totalChar > 90){
//        $(".contagem").text(totalChar);
//        $(".contagem").css('color', 'red');
//        $(".btn-cadastrar-refeicao").attr('disabled', 'disabled')
//        $(".btn-cadastrar-refeicao").css('cursor', 'not-allowed');
//    }else{
//        $(".contagem").text(totalChar);
//        $(".contagem").css('color', '#5cb85c');
//        $(".btn-cadastrar-refeicao").removeAttr('disabled', 'disabled')
//        $(".btn-cadastrar-refeicao").css('cursor', 'pointer')
//    }
// });

$(".btn-cadastrar-refeicao").on("click", function () {
    $(".nome-refeicao2").text($(".nome-refeicao").val());
    $(".valor-refeicao2").text($(".valorRefeicao").val());
    $(".ingredientes2").text($(".ingredientes").val());
    $(".tipoRef2").text($(".tipoRef").val());
    $(".descricao2").text($(".descricao").val());

    // if($('input[name=combo]:checked', '.form-refeicao')){
    //     var check = $('input[name=combo]:checked', '.form-refeicao').val()
    //
    //     $(".part-combo2").text(check);
    // }
    //
    // if(check == 'Não'){
    //     $(".p-valor-combo-2").hide();
    // }else{
    //     $(".p-valor-combo-2").show();
    //     $(".valor-combo2").text($(".valComboPromo").val());
    // }
})

//Edição de dados do funcionário.

    $(".telFuncionario").mask('(00) 00000-0000');
    $(".fixoFuncionario").mask('(00) 0000-0000');
    $(".profileFuncionario").attr('readonly', 'true');
    $(".profileFuncionario").css('cursor', 'not-allowed');

    const nomeFunc = $(".nome-funcionario").val();
    const emailFunc = $(".empEmail2").val();
    const bairroFunc = $(".userDistrict").val();
    const sobrenomeFunc = $(".sobrenome-funcionario").val();
    const telFunc = $(".telFuncionario").val();
    const fixoFunc =  $(".fixoFuncionario").val();
    const enderecoFunc =  $(".enderecoFuncionario").val();
    const profileFunc =  $(".profileFuncionario").val();
    const refPoint =  $(".refPoint").val();
    const adNumber =  $(".adNumber").val();

    $(".salvar-alteracoes-func").on("click", function () {

        if(bairroFunc == $(".userDistrict").val() && refPoint == $(".refPoint").val() && adNumber == $(".adNumber").val() && emailFunc == $(".empEmail2").val() && nomeFunc == $(".nome-funcionario").val() && sobrenomeFunc == $(".sobrenome-funcionario").val() && telFunc == $(".telFuncionario").val() && fixoFunc == $(".fixoFuncionario").val() && enderecoFunc == $(".enderecoFuncionario").val() && profileFunc == $(".profileFuncionario").val() && $(".senhaFuncionario").val() == ''){

            $(".func-mudancas").text("Você não efetuou nenhuma alteração.");
            $(".func-mudancas").css('text-align', 'center');
            $(".imagem-alteracao").removeAttr('hidden');
            $(".botao-salvar").attr('hidden', 'true');
        }else{
            $(".func-mudancas").text('Revise as alterações antes de prosseguir com o salvamento.');
            $(".func-mudancas").css('text-align', 'left');
            $(".imagem-alteracao").attr('hidden', 'true');
            $(".botao-salvar").removeAttr('hidden', 'true');
        }

        if(nomeFunc != $(".nome-funcionario").val()){
            $(".div-nome-func").removeAttr('hidden', 'true');
            $(".novo-nome").text($(".nome-funcionario").val());
        }else{
            $(".div-nome-func").attr('hidden', 'true');
        }

        if(refPoint != $(".refPoint").val()){
            $(".div-refPoint").removeAttr('hidden', 'true');
            $(".novo-refPoint").text($(".refPoint").val());
        }else{
            $(".div-refPoint").attr('hidden', 'true');
        }

        if(adNumber != $(".adNumber").val()){
            $(".div-adNumber").removeAttr('hidden', 'true');
            $(".novo-adNumber").text($(".adNumber").val());
        }else{
            $(".div-adNumber").attr('hidden', 'true');
        }

        if(emailFunc != $(".empEmail2").val()){
            $(".div-email-func").removeAttr('hidden', 'true');
            $(".novo-email").text($(".empEmail2").val());
        }else{
            $(".div-email-func").attr('hidden', 'true');
        }

        if(bairroFunc != $(".userDistrict").val()){
            $(".div-bairro-func").removeAttr('hidden', 'true');
            $(".novo-bairro").text($(".userDistrict").val());
        }else{
            $(".div-bairro-func").attr('hidden', 'true');
        }

        if(sobrenomeFunc != $(".sobrenome-funcionario").val()){
            $(".div-sobrenome-func").removeAttr('hidden', 'true');
            $(".novo-Sobrenome").text($(".sobrenome-funcionario").val());

        }else{
            $(".div-sobrenome-func").attr('hidden', 'true');
        }

        if(telFunc != $(".telFuncionario").val()){
            $(".div-telefone-func").removeAttr('hidden', 'true');
            $(".novo-Telefone").text($(".telFuncionario").val());

        }else{
            $(".div-telefone-func").attr('hidden', 'true');
        }

        if(fixoFunc != $(".fixoFuncionario").val()){
            $(".div-telefoneFixo-func").removeAttr('hidden', 'true');

            if(fixoFunc == ''){
                $(".fixo-anterior").text('Não informado');
                $(".novo-telefoneFixo").text($(".fixoFuncionario").val());
            }else{
                $(".novo-telefoneFixo").text($(".fixoFuncionario").val());
            }

        }else{
            $(".div-telefoneFixo-func").attr('hidden', 'true');
        }

        if(enderecoFunc != $(".enderecoFuncionario").val()){
            $(".div-endereco-func").removeAttr('hidden', 'true');
            $(".novo-endereco").text($(".enderecoFuncionario").val());

        }else{
            $(".div-endereco-func").attr('hidden', 'true');
        }

        if(horarioFunc != $(".horarioFuncionario").val()){
            $(".div-horárioServico-func").removeAttr('hidden', 'true');
            $(".horario-servico").text($(".horarioFuncionario").val());

        }else{
            $(".div-horárioServico-func").attr('hidden', 'true');
        }

        if(profileFunc != $(".profileFuncionario").val()){
            $(".div-perfilUsuario-func").removeAttr('hidden', 'true');
            $(".perfil-usuario").text($(".profileFuncionario").val());

        }else{
            $(".div-perfilUsuario-func").attr('hidden', 'true');
        }

        if($(".senhaFuncionario").val() != ''){
            $(".div-senha-func").removeAttr('hidden', 'true');
            $(".senha-do-func").text('Você está alterando a senha deste funcionário. Caso queira desistir desta alteração, basta apagar tudo o que está no campo de senha.');
        }else{
            $(".div-senha-func").attr('hidden', 'true');
        }
    })

//Alerta de sucesso cadastro refeição.
    setTimeout(function () {
        $(".alerta-sucesso-ref").fadeOut('slow');
    }, 7000);

//Alerta de sucesso cadastro usuario.
    setTimeout(function () {
        $(".alerta-sucesso-user").fadeOut('slow');
    }, 4000);

//Verificação de alterações em refeições.
    $(".valorRefeicao-edit").on('keyup', function (){
        $(this).mask('000.00', {reverse: true});
    })

    // $(".valComboPromo-edit").on('keyup', function (){
    //     $(this).mask('000.00', {reverse: true});
    // })

    // $(".impComboNao").on('click', function () {
    //
    //     if($(this).val() == 'Não'){
    //         $(".valComboPromo-edit").val('Esta refeição não participará do combo.');
    //         $(".valComboPromo-edit").attr('readonly', 'true');
    //         $(".valComboPromo-edit").attr('title', 'Esta refeição não participará do combo.');
    //         $(".valComboPromo-edit").css('cursor', 'not-allowed');
    //         $(".verificaPreco").hide();
    //     }
    // })
    //
    // $(".impComboSim").on('click', function () {
    //     $(".valComboPromo-edit").val('');
    //     $(".valComboPromo-edit").removeAttr('readonly');
    //     $(".valComboPromo-edit").attr('title', 'Se a refeição for fazer parte do combo, você deverá inserir um valor menor do que o valor dela fora do combo, assim fazendo um valor promocional.');
    //     $(".valComboPromo-edit").css('cursor', 'initial')
    // });

    $(".links-adverts").on('click', function (){
        console.log('click');
    })

    // const nomeRef = $(".nome-refeicao-edit").val();
    // const valor = $(".valorRefeicao-edit").val();
    // const participaCombo = $("input:radio:checked").val();
    // const valorCombo =  $(".valComboPromo-edit").val();
    // const ingredientes =  $(".ingredientes-edit").val();
    // const sabores =  $(".sabores-edit").val();
    // const descricao =  $(".descricao-edit").val();
    // const bancoExtras =  $(".cameFromDB").val();
    // const atual =  $(".atual").val();
    //
    // if(valorCombo == 'Esta refeição não participará do combo.'){
    //     $(".valComboPromo-edit").attr('readonly', 'true');
    //     $(".valComboPromo-edit").css('cursor', 'not-allowed');
    // }
    //
    // $(".btn-alterar-refeicao").on("click", function () {
    //
    //     if(atual ==  $(".atual").val() && bancoExtras ==  $(".cameFromDB").val() && sabores == $(".sabores-edit").val() && nomeRef == $(".nome-refeicao-edit").val() && valor == $(".valorRefeicao-edit").val() && participaCombo == $("input:radio:checked").val() && valorCombo == $(".valComboPromo-edit").val() && ingredientes == $(".ingredientes-edit").val()  && descricao == $(".descricao-edit").val() ){
    //
    //         $(".a-mudancas").text("Você não efetuou nenhuma alteração.");
    //         $(".imagem-alteracao").removeAttr('hidden');
    //         $(".salvar-agora").attr('hidden', 'true');
    //     }else{
    //         $(".a-mudancas").text('Você está fazendo alterações neste anúncio. Por favor, revise as alterações antes de prosseguir com\n' +
    //             'o salvamento.');
    //         $(".imagem-alteracao").attr('hidden', 'true');
    //         $(".salvar-agora").removeAttr('hidden', 'true');
    //     }
    //
    //     if(nomeRef != $(".nome-refeicao-edit").val()){
    //         $(".div-novo-nome-2").removeAttr('hidden', 'true');
    //         $(".div-nome-ant").removeAttr('hidden', 'true');
    //         $(".nome-refeicao2-edit").text($(".nome-refeicao-edit").val());
    //     }else{
    //         $(".div-nome-ant").attr('hidden', 'true');
    //         $(".div-novo-nome-2").attr('hidden', 'true');
    //     }
    //
    //     if(valor != $(".valorRefeicao-edit").val()){
    //         $(".div-novo-valor-2").removeAttr('hidden', 'true');
    //         $(".div-valor-ant").removeAttr('hidden', 'true');
    //         $(".valor-refeicao2-edit").text($(".valorRefeicao-edit").val());
    //
    //     }else{
    //         $(".div-valor-ant").attr('hidden', 'true');
    //         $(".div-novo-valor-2").attr('hidden', 'true');
    //     }
    //
    //     if(participaCombo != $("input:radio:checked").val()){
    //         $(".partCombo").removeAttr('hidden', 'true');
    //         $(".div-novo-partCombo-2").removeAttr('hidden', 'true');
    //         $(".div-partCombo-ant").removeAttr('hidden', 'true');
    //         $(".partCombo-refeicao2-edit").text($("input:radio:checked").val());
    //
    //     }else{
    //         $(".div-partCombo-ant").attr('hidden', 'true');
    //         $(".partCombo").attr('hidden', 'true');
    //         $(".div-novo-partCombo-2").attr('hidden', 'true');
    //     }
    //
    //     if(valorCombo != $(".valComboPromo-edit").val()){
    //         $(".div-novo-valorPromo-2").removeAttr('hidden', 'true');
    //         $(".div-valorPromo-ant").removeAttr('hidden', 'true');
    //         $(".valorPromo-refeicao2-edit").text($(".valComboPromo-edit").val());
    //
    //     }else{
    //         $(".div-valorPromo-ant").attr('hidden', 'true');
    //         $(".div-novo-valorPromo-2").attr('hidden', 'true');
    //     }
    //
    //     if(ingredientes != $(".ingredientes-edit").val()){
    //         $(".div-novo-ingrediente-2").removeAttr('hidden', 'true');
    //         $(".div-ingrediente-ant").removeAttr('hidden', 'true');
    //         $(".ingrediente-refeicao2-edit").text($(".ingredientes-edit").val());
    //
    //     }else{
    //         $(".div-ingrediente-ant").attr('hidden', 'true');
    //         $(".div-novo-ingrediente-2").attr('hidden', 'true');
    //     }
    //
    //     if(sabores != $(".sabores-edit").val()){
    //         $(".div-novo-sabor-2").removeAttr('hidden', 'true');
    //         $(".div-sabor-ant").removeAttr('hidden', 'true');
    //         $(".sabores-refeicao2-edit").text($(".sabores-edit").val());
    //
    //     }else{
    //         $(".div-sabor-ant").attr('hidden', 'true');
    //         $(".div-novo-sabor-2").attr('hidden', 'true');
    //     }
    //
    //     if(descricao != $(".descricao-edit").val()){
    //         $(".div-novo-descricao-2").removeAttr('hidden', 'true');
    //         $(".div-descricao-ant").removeAttr('hidden', 'true');
    //         $(".descricao-refeicao2-edit").text($(".descricao-edit").val());
    //
    //     }else{
    //         $(".div-descricao-ant").attr('hidden', 'true');
    //         $(".div-novo-descricao-2").attr('hidden', 'true');
    //     }
    // })


$(".forma-entrega").on("change", function () {
    var retirada = $(".forma-entrega").val();
    var pagamento = $(".forma-pagamento").val();

    if(retirada == 'Retirada no restaurante'){

        $(".troco").removeAttr('required', 'true');
        $(".pagamento").hide('slow');
        $(".entrega").hide('slow');
        $(".local-entrega, .local-entrega-see").hide('slow');
        $(".val-entregue").hide('slow');
        $(".bairro-entrega").hide('slow');
        pagamento = 'Pagar no restaurante';
        $(".finalizar-pedido").removeAttr('disabled', 'true');
    }else{
        $(".pagamento, .local-entrega-see, .entrega").show('slow');
    }

    if(pagamento != 'Dinheiro'){
        $(".val-entregue").fadeOut('slow');
    }else {
        $(".val-entregue").fadeIn('slow');
    }
});

$(".forma-pagamento").on("change", function () {
    var pagamento = $(this).val();
    var troco2 = $(".troco").val()

    if(pagamento != 'Dinheiro'){
        $(".val-entregue").fadeOut('slow');
        $(".troco").removeAttr('required', 'true');
    }else {
        $(".val-entregue").fadeIn('slow');
        $(".troco").attr('required', 'true');

        // if (troco2 == ''){
        //     $(".finalizar-pedido").attr('disabled', 'true');
        // }
    }
});

//Verificação de troco.
$(".bairro-entrega, .local-entrega, .val-entregue").hide();

//Verificação de entrega
$(".end-entrega").attr('readonly', 'true');
$(".end-entrega").css('cursor', 'not-allowed');
$(".entregaCasa").attr('checked', 'true');
var local = $(".end-entrega").val();

$(".entregaFora").on("click", function () {
    $(".end-entrega").removeAttr('readonly', 'true');
    $(".bairro-entrega, .local-entrega").fadeIn('slow');
    $(".local-entrega-see").fadeOut('slow');
    $(".bairro-entrega").attr('required', true);
    $(".end-entrega").css('cursor', 'inherit');
    $(".end-entrega").val('');
});

$(".entregaCasa").on("click", function () {
    $(".end-entrega").attr('readonly', 'true');
    $(".local-entrega-see").fadeIn('slow');
    $(".bairro-entrega, .local-entrega").fadeOut('slow');
    $(".bairro-entrega").removeAttr('required', true);
    $(".end-entrega").css('cursor', 'not-allowed');
    $(".end-entrega").val(local);
});

//Inserção de máscara de valor a ser entregue:
    $(".troco, .compras-acima, .editar-valor-ent").keyup(function (){
        $(this).mask('000.00', {reverse: true});
    });

$(".ver-troco").hide();
//Alteração de valor de troco.
$(".editar-valor-ent").on('click', function (){
    $(".editar-valor-ent").css('cursor', 'initial');
})

$(".editar-valor-ent").on('keyup', function (){
    if (parseFloat($(".editar-valor-ent").val()) < parseFloat($(".bt-total").val())){
        $(".ver-troco").show('slow');
    }else{
        $(".ver-troco").hide('slow');
    }
});

    $(".finalizar-pedido").on("click", function (){
        if (parseFloat($(".editar-valor-ent").val()) < parseFloat($(".bt-total").val())){

            Swal.fire({
                icon: 'warning',
                text: 'Você inseriu um valor inválido para ser entregue no ato da compra.'
            });

            $(".finalizar-pedido").removeAttr('data-toggle', 'true');
        }else{
            $(".finalizar-pedido").removeAttr('title', 'true');
            $(".finalizar-pedido").attr('data-toggle', 'modal');
        }
    });


//Inserção de cupom para maiúscula.
    $(".cupomDesconto").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });

//Alteração do campo de andamento de pedido.
var status = $(".status").val();
var deliver = $(".deliverWay").val();

    $(".enviarPreparo").on("click", function () {
        $(".texto-mudar-status").removeClass('text-danger');
        $(".texto-mudar-status").text('Este pedido ficará com o status "Em preparo" e estará disponível para a equipe da cozinha começar a preparar. Deseja confirmar?');
    });

$(".cancelarPedido").on("click", function () {
   $(".texto-mudar-status").addClass('text-danger');
   $(".texto-mudar-status").text('Este pedido será cancelado e não estará mais disponível para ser preparado. Tem certeza que deseja prosseguir?' );
});


$(".pronto-retirar").on("click", function () {
    $(".texto-mudar-status").text('Este pedido ficará pronto para ser enviado/retirado na loja, deseja confirmar?');
});

$(".finalizar-ok").on("click", function () {
    $(".texto-mudar-status").text('Ao confirmar você informará que o pedido foi entregue com sucesso, deseja prosseguir?');
});

//Sumir feedback de pedido home.
    setTimeout(function () {
        $(".sumir-feedback").fadeOut('slow');
    },8000);

//Verificação de valor de troco.
var valorPedido = parseFloat($(".pg-val").val());
var clienteTroco = parseFloat($(".troco").val());
$(".verifica-val-troco").hide();

$(".finalizar-pedido").on("click", function (){

    if ($(".hasCoupon").val() == undefined){
        if ($(".entregaFora").is(':checked')){

            if ($(".end-entrega").val().length < 5){
                Swal.fire({
                    icon: 'warning',
                    text: 'Preencha o nome da rua a ser entregue, para que possamos encontrá-la corretamente.'
                });

                $(".finalizar-pedido").removeAttr('data-toggle', 'true');
            }else if($(".adDeliver").val().length < 1){
                Swal.fire({
                    icon: 'warning',
                    text: 'Preencha corretamente o número da residência a ser entregue, para que possamos identificá-la.'
                });

                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

            }else if($(".entregaDiff").val() == '' ){
                Swal.fire({
                    icon: 'warning',
                    text: 'Informe em qual bairro será entregue o seu pedido.'
                });

                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

            }else if($(".pontoRef").val().length < 5){
                Swal.fire({
                    icon: 'warning',
                    text: 'Preencha corretamente o ponto de referência para que possamos encontrar a residência.'
                });

                $(".finalizar-pedido").removeAttr('data-toggle', 'true');
            }else if ($(".forma-pagamento").val() == null){

                $(".troco").removeAttr('required', 'true');
                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                Swal.fire({
                    icon: 'warning',
                    text: 'Escolha uma forma de pagamento'
                });
            }else if ($(".forma-pagamento").val() == 'Dinheiro'){
                if ($(".troco").val() == ''){

                    $(".finalizar-pedido").attr('title', 'Você inseriu um valor de troco inferior ao valor do pedido.');
                    $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                    Swal.fire({
                        icon: 'warning',
                        text: 'Insira o valor a ser entregue no ato da compra.',
                    })
                }else if($(".troco").val() < valorPedido){

                    $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                    Swal.fire({
                        icon: 'warning',
                        text: 'O valor a ser pago não pode ser inferior ao valor do pedido.',
                    })
                }
            }else if ($(".forma-pagamento").val() == null){

                $(".troco").removeAttr('required', 'true');
                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                Swal.fire({
                    icon: 'warning',
                    text: 'Escolha uma forma de pagamento'
                });
            }else{
                $(".finalizar-pedido").removeAttr('title', 'true');
                $(".finalizar-pedido").attr('data-toggle', 'modal');
            }
        }else if ($(".forma-pagamento").val() == 'Dinheiro'){
            if ($(".troco").val() == ''){

                $(".finalizar-pedido").attr('title', 'Você inseriu um valor de troco inferior ao valor do pedido.');
                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                Swal.fire({
                    icon: 'warning',
                    text: 'Insira o valor a ser entregue no ato da compra.',
                })
            }else if($(".troco").val() < valorPedido){

                $(".finalizar-pedido").removeAttr('data-toggle', 'true');

                Swal.fire({
                    icon: 'warning',
                    text: 'O valor a ser pago não pode ser inferior ao valor do pedido.',
                })
            }
        }else if ($(".forma-pagamento").val() == null){

            $(".troco").removeAttr('required', 'true');
            $(".finalizar-pedido").removeAttr('data-toggle', 'true');

            Swal.fire({
                icon: 'warning',
                text: 'Escolha uma forma de pagamento'
            });
        }else{
            $(".finalizar-pedido").removeAttr('title', 'true');
            $(".finalizar-pedido").attr('data-toggle', 'modal');
        }
    }
})

$(".troco").on("keyup", function (){
    clienteTroco = parseFloat($(".troco").val());
    valorPedido = parseFloat($(".pg-val").val())

    if (isNaN(clienteTroco) || valorPedido > clienteTroco){
        $(".verifica-val-troco").fadeIn('slow');
        $(".finalizar-pedido").attr('title', 'Você inseriu um valor de troco inferior ao valor do pedido.');

        $(".mais-pedidos").on('click', function (e){
           e.preventDefault();
        });

        $(".cadastrar-pedido-agora").on('click', function (e){
            e.preventDefault();
        });

    }else{
        $(".verifica-val-troco").fadeOut('slow');
        $(".finalizar-pedido").removeAttr('title', 'true');
        $(".finalizar-pedido").attr('data-toggle', 'modal');

        $(".mais-pedidos").on('click', function (){
            $('#cadastrarPedido').submit();
        });

        $(".cadastrar-pedido-agora").on('click', function (){
            $('#cadastrarPedido').submit();
        });
    }
})

//Ajustes em pedido para pedir novo.
$('.verifica-outro').on("click", function (e){
    e.preventDefault();
})
$(".finalizar-pedido, .verifica-outro").attr("data-toggle", "modal");
$(".finalizar-pedido, .verifica-outro").attr("data-target", "#exampleModalCentercompra");

$(".finalizar-pedido").on("click", function (e){
    e.preventDefault();
})

    $(".mais-pedidos").on("click", function () {
        $(".valor-retorno").val('Pendente');
    })

//Ajuste para forma de pagamento campo troco.
$(".forma-pagamento").on("change", function (){

    if($(this).val() == 'Dinheiro'){
        $(".troco").attr('required', 'true');
    }else{
        $(".troco").removeAttr('required', 'true');
        $(".finalizar-pedido").removeAttr('disabled', 'true');
    }
})


//Verificações de criação de refeições.
$(".tipoRef").on("change", function () {

    if ($(this).val() == 'Bebida'){
        $(".sizes, .cmsizes").fadeOut('slow');
        $('.tastes').fadeIn('slow');

    }else if ($(this).val() == 'Pizza'){

        $(".tastes").fadeOut('slow')
        $(".sizes, .cmsizes").fadeIn('slow');

    }else if ($(this).val('Sobremesa')){

        $(".sizes, .cmsizes").fadeOut('slow');
        $(".tastes").fadeOut('slow');
        $(".descricao").val('');
    }else{
        $(".igr").fadeIn('slow');
        $(".itr").fadeIn('slow');
    }

})


//Estilo para cards dashboard.
  $(".card-dash1").mouseenter(function () {
      $(this).animate({'bottom':'15px'}, 'slow');
      $(this).css('cursor', 'pointer');
  })

  $(".card-dash1").mouseleave(function () {
     $(this).animate({'bottom':'0px'}, 'slow');
  })

    $(".card-dash2").mouseenter(function () {
        $(this).animate({'bottom':'15px'}, 'slow');
        $(this).css('cursor', 'pointer');
    })

    $(".card-dash2").mouseleave(function () {
        $(this).animate({'bottom':'0px'}, 'slow');
    })

    $(".card-dash3").mouseenter(function () {
        $(this).animate({'bottom':'15px'}, 'slow');
        $(this).css('cursor', 'pointer');
    })

    $(".card-dash3").mouseleave(function () {
        $(this).animate({'bottom':'0px'}, 'slow');
    })

    $(".card-dash4").mouseenter(function () {
        $(this).animate({'bottom':'15px'}, 'slow');
        $(this).css('cursor', 'pointer');
    })

    $(".card-dash4").mouseleave(function () {
        $(this).animate({'bottom':'0px'}, 'slow');
    })

//Recolhimento de menu principal
$(".botao-recolher-menu").click();

//Modal de mudança de mês em informações financeiras.

$(".mesVenda").on('change', function () {
    $(".mes").text($(this).val().toLowerCase());
    $("#modalConsulta").modal();
})

$(".anoVenda").on('change', function () {
    $(".ano").text($(this).val().toLowerCase());
    $("#modalAno").modal();
})

//Inserção de máscara em cadastro de item adicional.
$(".valor-item-add-edit").on('keyup', function (){
    $(this).mask('000.00', {reverse: true});
});

$(".valor-item-add").mask('000.00', {reverse: true});

    $(".edit-extras-items").on('click', function (){
        $("#modalDeItens").modal('close');
    });

//Escondendo botão de cupom.
    $(".aplicar-cupom").hide();
    $(".cupomDesconto").keyup(function (){
        let size = $(this).val();
        if (size.length != 0){
            $(".aplicar-cupom").fadeIn('slow');
        }else{
            $(".aplicar-cupom").fadeOut('slow');
        }
    });

//Spinner de item sendo adicionado.
$(".adicionar-bandeja, .cad-horario, .buscar-entregas, .send-asset, .cadastrar-ref, .salvar-alt-client, .send-aval, .edit-item-add, .cadastrar-item-add, .toggle-aval, .delete-item, .salvar-agora, .buscar-dados, .deletar-func, .cadastrar-cupom, .botao-salvar, .cadastrar-funcionario, .toggleAdvert, .atualizar-msg-emergencia, .alterar-local-cupom, .editar-area ,.aplicar-cupom, .cancelar-pedido, .cadastrar-pedido-agora, .mais-pedidos, .cadastrar-taxa").on('click', function (){
  $(this).html('<div class="spinner-border text-light" role="status"></div>');

  setTimeout(function (){
      $('.cadastrar-taxa').text('Cadastrar');
      $('.cadastrar-ref').text('Cadastrar refeição');
      $('.botao-salvar').text('Salvar alterações');
      $('.send-asset').text('Enviar avaliação');
      $('.cadastrar-cupom').text('Cadastrar cupom');
      $('.cad-horario').text('Salvar');
      $('.cadastrar-cupom, .salvar-alt-client').text('Salvar alterações');
      $('.cadastrar-funcionario').html('<i class="fas fa-user-plus mr-2"></i>Cadastrar funcionário');
      $('.cadastrar-item-add').html('<i class="fas fa-plus mr-2"></i>Cadastrar');
  }, 3000);

  setTimeout(function(){
      $(".close-here").click();
      $(".close-here").click();
  }, 1000);
});

var size = '';
$(".pizzaSize").on('change', function (){
    size = $(".pizzaSize").val();

    $(".descricao, .descricao-edit").val('Deliciosa ' + $(".nome-refeicao").val().toLowerCase() + ' quentinha para você. Pizza ' + size.toLowerCase() + ' de ' + $(".cmsize").val() + ' cm que serve ' + $(".cmpieces").val() + ' pedaços.');
});



$(".nome-refeicao, .cmsize, .cmpieces").on('keyup', function (){

    $(".descricao-edit").val('Deliciosa ' + $(".nome-refeicao").val().toLowerCase() + ' quentinha para você. Pizza ' + size + ' de ' + $(".cmsize").val() + ' cm que serve ' + $(".cmpieces").val() + ' pedaços.');

    if ($(".tipoRef").val() == 'Bebida'){

        $(".descricao, .descricao-edit").val('Deliciosa ' + $(this).val().toLowerCase() + ' geladinha, pronta para lhe acompanhar nos seus pedidos!')
    }else if($(".tipoRef").val() == 'Pizza'){

        $(".descricao").val('Deliciosa ' + $(".nome-refeicao").val().toLowerCase() + ' quentinha para você. Pizza ' + size + ' de ' + $(".cmsize").val() + ' cm que serve ' + $(".cmpieces").val() + ' pedaços.');
    }
});

if ($(".diff-day").val() == 'sim'){
    $(".text-entregas").show();

    setTimeout(function (){
        $(".text-entregas").hide('slow');
    }, 8000)
}
});
