$(function () {

// Ajuste de imagem de usuário no menu lateral.

$(".div-img-user").hide();

$(".hamburger").click(function () {

    setTimeout(function () {
        $(".div-img-user").toggle('medium');
    }, 300)

})

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

//Inserção de máscara na view de cupons

    $(".compras-acima").mask('00.00');

//Inserção de máscara na view de cadastro de funcionários.

    $(".empHour").mask('00:00 - 00:00');

//Verificações adicionais na view de novo funcionário.


//Inserção de máscara na view de cadastro de usuário.

    $(".user-Phone").mask('(00) 00000-0000');
    $(".userFixedPhone").mask('(00) 0000-0000');


//Verificação e inserção de máscara em cadastro de alimentos.

$(".verificaPreco").hide();

$(".impComboNao").on('click', function () {

    if($(this).val() == 'Não'){
        $(".valComboPromo").val('Esta refeição não participará do combo.');
        $(".valComboPromo").attr('readonly', 'true');
        $(".valComboPromo").css('cursor', 'not-allowed');
        $(".verificaPreco").hide();
    }
})

$(".impComboSim").on('click', function () {
    $(".valComboPromo").val('');
    $(".valComboPromo").removeAttr('readonly');
    $(".valComboPromo").css('cursor', 'initial')
})

    //Inserção de máscara de preço na view de cadastro de anuncio.
    $(".valorRefeicao, .valComboPromo, .valComboPromo-edit").keyup(function (){
        $(this).mask('000.00', {reverse: true});
    })

$(".valComboPromo, .valComboPromo-edit").on('keyup', function () {

    if(parseInt($(".valComboPromo, .valComboPromo-edit").val()) >= parseInt($(".valorRefeicao, .valorRefeicao-edit").val())){
        $(".verificaPreco").fadeIn('slow');
    }else{
        $(".verificaPreco").fadeOut('slow');
    }
});

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
            $(".p-mudancas").text('Você está fazendo alterações neste cupom. Por favor, revise as alterações antes de prosseguir com\n' +
                'o salvamento.');
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

    if (dateToday.getDate() < 10){
        dateToday = dateToday.getFullYear() + '-' + '0'+ (dateToday.getMonth() + 1) + '-' + '0'+ dateToday.getDate();
    }else{
        dateToday = dateToday.getFullYear() + '-' + '0'+ (dateToday.getMonth() + 1) + '-' + dateToday.getDate();
    }

    //Verificando data de novo cupom.
    $(".data-exp-cupom, .data-exp").on("change", function (){

        var teste = $(".data-exp-cupom, .data-exp").val();
        if(parseInt(teste.replace(/-/g,""),10) < parseInt(dateToday.replace(/-/g,""),10)){
            $(".cupom-expire2").fadeIn('slow');
            $(".cupom-expire").fadeOut();
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").attr('disabled', 'true')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'not-allowed')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").attr('title', 'Verifique a data de expiração do cupom.')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom, .botao-salvar").on("click", function (e){
                e.preventDefault();
            })
        }else if (parseInt(teste.replace(/-/g,""),10) == parseInt(dateToday.replace(/-/g,""),10)){
            $(".cupom-expire2").fadeOut();
            $(".cupom-expire").fadeIn('slow');
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").attr('disabled', 'true')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'not-allowed')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").attr('title', 'Verifique a data de expiração do cupom.')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom, .botao-salvar").on("click", function (e){
                e.preventDefault();
            })
        }else{
            $(".cupom-expire").fadeOut('slow');
            $(".cupom-expire2").fadeOut('slow');
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").removeAttr('disabled', 'true')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").removeAttr('title', 'true')
            $(".cadatrar-cupom, .salvamento-alteracoes-cupom").css('cursor', 'pointer')
            $(".cadatrar-cupom, .botao-salvar").on("click", function (e){
                $(".cupom-sub").submit();
            })
        }
    })

//Verificação de cadastro de refeição.

    $(".verifica-ingredientes").hide();

    $(".valComboPromo, .nome-refeicao, .impComboSim, .impComboNao, .descricao, .valorRefeicao, .sabores-edit, .ingredientes-edit, .nome-refeicao-edit, .valorRefeicao-edi, .valComboPromo-edit, .descricao-edit").on("click", function (){
        $(".verifica-ingredientes").fadeOut('slow');
    })

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

    $(".lbl-alerta, .total-char").hide();

$(".descricao, .descricao-edit").on("click", function (){
    $(".lbl-alerta, .total-char").fadeIn('slow');

    setTimeout(function (){
        $(".lbl-alerta").fadeOut('slow');
    },10000)
});

$(".descricao, .descricao-edit").on("keyup", function (){

   var text = $(".descricao, .descricao-edit").val();
   var totalChar = text.length;

   if(totalChar < 70 || totalChar > 90){
       $(".contagem").text(totalChar);
       $(".contagem").css('color', 'red');
       $(".btn-cadastrar-refeicao").attr('disabled', 'disabled')
       $(".btn-cadastrar-refeicao").css('cursor', 'not-allowed');
   }else{
       $(".contagem").text(totalChar);
       $(".contagem").css('color', '#5cb85c');
       $(".btn-cadastrar-refeicao").removeAttr('disabled', 'disabled')
       $(".btn-cadastrar-refeicao").css('cursor', 'pointer')
   }
});

$(".btn-cadastrar-refeicao").on("click", function () {
    $(".nome-refeicao2").text($(".nome-refeicao").val());
    $(".valor-refeicao2").text($(".valorRefeicao").val());
    $(".ingredientes2").text($(".ingredientes").val());
    $(".tipoRef2").text($(".tipoRef").val());

    if($('input[name=combo]:checked', '.form-refeicao')){
        var check = $('input[name=combo]:checked', '.form-refeicao').val()

        $(".part-combo2").text(check);
    }

    if(check == 'Não'){
        $(".p-valor-combo-2").hide();
    }else{
        $(".p-valor-combo-2").show();
        $(".valor-combo2").text($(".valComboPromo").val());
    }

    $(".descricao2").text($(".descricao").val());
})


//Edição de dados do funcionário.

    $(".telFuncionario").mask('(00) 00000-0000');
    $(".fixoFuncionario").mask('(00) 0000-0000');
    $(".horarioFuncionario").mask('00:00 - 00:00');
    $(".profileFuncionario").attr('readonly', 'true');
    $(".profileFuncionario").css('cursor', 'not-allowed');



    const nomeFunc = $(".nome-funcionario").val();
    const sobrenomeFunc = $(".sobrenome-funcionario").val();
    const telFunc = $(".telFuncionario").val();
    const fixoFunc =  $(".fixoFuncionario").val();
    const enderecoFunc =  $(".enderecoFuncionario").val();
    const horarioFunc =  $(".horarioFuncionario").val();
    const profileFunc =  $(".profileFuncionario").val();

    $(".salvar-alteracoes-func").on("click", function () {

        if(nomeFunc == $(".nome-funcionario").val() && sobrenomeFunc == $(".sobrenome-funcionario").val() && telFunc == $(".telFuncionario").val() && fixoFunc == $(".fixoFuncionario").val() && enderecoFunc == $(".enderecoFuncionario").val() && horarioFunc == $(".horarioFuncionario").val() && profileFunc == $(".profileFuncionario").val() && $(".senhaFuncionario").val() == ''){

            $(".func-mudancas").text("Você não efetuou nenhuma alteração.");
            $(".func-mudancas").css('text-align', 'center');
            $(".imagem-alteracao").removeAttr('hidden');
            $(".botao-salvar").attr('hidden', 'true');
        }else{
            $(".func-mudancas").text('Você está fazendo alterações nos dados cadastrais deste funcionário. Por favor, revise as alterações antes de prosseguir com\n' +
                'o salvamento. Suas alterações são:');
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

    $(".valorRefeicao-edit").mask('00.00');

    if ($.isNumeric($(".valComboPromo-edit").val())){
        $(".valComboPromo-edit").mask('00.00');
    }

    $(".impComboNao").on('click', function () {

        if($(this).val() == 'Não'){
            $(".valComboPromo-edit").val('Esta refeição não participará do combo.');
            $(".valComboPromo-edit").attr('readonly', 'true');
            $(".valComboPromo-edit").attr('title', 'Esta refeição não participará do combo.');
            $(".valComboPromo-edit").css('cursor', 'not-allowed');
            $(".verificaPreco").hide();
        }
    })

    $(".impComboSim").on('click', function () {
        $(".valComboPromo-edit").val('');
        $(".valComboPromo-edit").removeAttr('readonly');
        $(".valComboPromo-edit").attr('title', 'Se a refeição for fazer parte do combo, você deverá inserir um valor menor do que o valor dela fora do combo, assim fazendo um valor promocional.');
        $(".valComboPromo-edit").css('cursor', 'initial')
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


//Toast de item adicionado à bandeja

    $(".disparo-ham").on("click", function (){
        $.toast({
            heading: '<b><span style="font-size: 16px">Legal!</span></b>',
            text: '<b><span style="font-size: 14px">Item adicionado ao pedido!</span></b>',
            showHideTransition: 'slide',
            hideAfter: 3500,
            icon: 'success',
            position : 'top-right'
        })
    });

    $(".disparo-ham").click();

//Toast de finalização de pedido

    $(".disparo-fim").on("click", function (){
        $.toast({
            text: '<b style="font-size: 14px">Vamos revisar para pedir tudo certinho, ok?</b>',
            heading: '<b style="font-size: 17px">Quase lá!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 6000
        })
    });

    $(".disparo-fim").click();

//Toast de remoção de item.

    $(".disparo-removeCombo").on("click", function (){
        $.toast({
            text: '<b style="font-size: 14px">Item adicional removido do seu pedido.</b>',
            heading: '<b style="font-size: 17px">Que pena!</b>',
            showHideTransition: 'slide',
            bgColor : 'red',
            position : 'top-right',
            hideAfter: 6000
        })
    });

    $(".disparo-removeCombo").click();

    //Toast de remoção de pedido pendente.

    $(".disparo-removePendente").on("click", function (){
        $.toast({
            text: '<b style="font-size: 14px">Pedido removido dos pendentes.</b>',
            heading: '<b style="font-size: 17px">Que pena :(</b>',
            showHideTransition: 'slide',
            bgColor : 'red',
            position : 'top-right',
            hideAfter: 6000
        })
    });

    $(".disparo-removePendente").click();


    //Toast de remoção de item.

    $(".disparo-addCombo").on("click", function (){
        $.toast({
            text: '<b style="font-size: 14px">Adicionais inseridos no sanduíche!</b>',
            heading: '<b style="font-size: 17px">Tudo certo!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 6000
        })
    });

    $(".disparo-addCombo").click();


//Toast de item removido do pedido avulso.

    $(".disparo-rem").on("click", function (){
        $.toast({
            text: '<b>Item removido do pedido!</b>',
            heading: '<b>Poxa!</b>',
            showHideTransition: 'slide',
            bgColor : '#ff3333',
            position : 'top-right',
            hideAfter: 5000
        })
    });

    $(".disparo-rem").click();

    //Toast de item editado do pedido avulso.

    $(".disparo-edits").on("click", function (){
        $.toast({
            text: '<b>Item editado com sucesso!</b>',
            heading: '<b>Tudo certo!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 5000
        })
    });

    $(".disparo-edits").click();

//Toast de pedido cadastrado com sucesso e novo pedido poder ser feito.

    $(".disparo-msg").on("click", function (){
        $.toast({
            text: '<b>Seu pedido foi feito e ESTÁ NA ABA PEDIDOS PENDENTES. Você pode escolher novos itens para seu novo pedido.</b>',
            heading: '<b>Atenção aqui!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 15000
        })
    });

    $(".disparo-msg").click();

//Toast de pedido cadastrado com sucesso e novo pedido poder ser feito.

    $(".disparo-ok").on("click", function (){
        $.toast({
            text: '<b>Pedidos cadastrados! Agora basta acompanhar o andamento por aqui. A tela será atualizada automaticamente.</b>',
            heading: '<b>Tudo certo!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 10000
        })
    });

    $(".disparo-ok").click();

    $(".disparo-ok-one").on("click", function (){
        $.toast({
            text: '<b>Pedido cadastrado! Agora basta acompanhar o andamento por aqui. A tela será atualizada automaticamente.</b>',
            heading: '<b>Tudo certo!</b>',
            showHideTransition: 'slide',
            bgColor : '#38C172',
            position : 'top-right',
            hideAfter: 10000
        })
    });

    $(".disparo-ok-one").click();

//Tratativas de finalização de compra.
$(".finalizar-pedido").attr('disabled', 'true');

$(".forma-entrega").on("change", function () {
    var retirada = $(".forma-entrega").val();
    var pagamento = $(".forma-pagamento").val();

    if(retirada == 'Retirada no restaurante'){

        $(".troco").removeAttr('required', 'true');
        $(".pagamento").hide('slow');
        $(".entrega").hide('slow');
        $(".local-entrega").hide('slow');
        $(".val-entregue").hide('slow');
        pagamento = 'Pagar no restaurante';
        $(".finalizar-pedido").removeAttr('disabled', 'true');
    }else{
        $(".pagamento").show('slow');
        $(".entrega").show('slow');
        $(".local-entrega").show('slow');
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

        if (troco2 == ''){
            $(".finalizar-pedido").attr('disabled', 'true');
        }
    }
});

//Verificação de troco.

    $(".verifica-troco").hide();

$(".troco").on("click", function () {
    $(".verifica-troco").fadeIn('slow');

    setTimeout(function () {
        $(".verifica-troco").fadeOut('slow');
    }, 8000)
});

//Verificação de entrega
$(".end-entrega").attr('readonly', 'true');
$(".end-entrega").css('cursor', 'not-allowed');
$(".entregaCasa").attr('checked', 'true');
var local = $(".end-entrega").val();

$(".entregaFora").on("click", function () {
    $(".end-entrega").removeAttr('readonly', 'true');
    $(".end-entrega").css('cursor', 'inherit');
    $(".end-entrega").val('');
})

$(".entregaCasa").on("click", function () {
    $(".end-entrega").attr('readonly', 'true');
    $(".end-entrega").css('cursor', 'not-allowed');
    $(".end-entrega").val(local);
})

//Inserção de máscara de valor a ser entregue:

    $(".troco, .compras-acima").keyup(function (){
        $(this).mask('000.00', {reverse: true});
    })


//Inserção de cupom para maiúscula.
    $(".cupomDesconto").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    })

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
    },8000)

//Verificação de valor de troco.
var valorPedido = parseFloat($(".total-val").text());
var clienteTroco = $(".troco").val()
$(".verifica-val-troco").hide();


$(".troco").on("keyup", function (){
    clienteTroco = parseInt($(".troco").val());

    if (isNaN(clienteTroco) || valorPedido > clienteTroco){
        $(".verifica-val-troco").fadeIn('slow');
        $(".finalizar-pedido").attr('disabled', 'true');
    }else{
        $(".verifica-val-troco").fadeOut('slow');
        $(".finalizar-pedido").removeAttr('disabled', 'true');
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
        $(".igr").hide();
        $(".itr").hide();
        $('.tastes').fadeIn('slow');
        $(".comb").addClass('col-md-8');

    }else if ($(this).val() == 'Hamburguer'){

        $('.tastes').fadeOut('slow')
        $(".igr").fadeIn('slow');
        $(".itr").fadeIn('slow');
        $(".comb").removeClass('col-md-8');

    }else if ($(this).val() == 'Sobremesa' || $(this).val() == 'Acompanhamento'){

        $(".igr").hide();
        $(".itr").hide();
        $(".tastes").fadeOut('slow');
        $(".comb").addClass('col-md-8');

    }else{
        $(".igr").fadeIn('slow');
        $(".itr").fadeIn('slow');
        $(".comb").removeClass('col-md-8');
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

$(".valor-item-add").mask('00.00');
$(".valor-item-add-edit").mask('00.00');
$(".cadastrar-item-add").attr('disabled', 'true');
$(".cadastrar-item-add").css('cursor', 'not-allowed');
$(".cadastrar-item-add").attr('title', 'Preencha todos os campos corretamente');

    $(".valor-item-add").on('keyup',function () {
        var valorItem = $(".valor-item-add").val();

        if (valorItem.length < 5){
            $(".cadastrar-item-add").attr('disabled', 'true');
            $(".cadastrar-item-add").css('cursor', 'not-allowed');
        }else{
            $(".cadastrar-item-add").removeAttr('disabled', 'true');
            $(".cadastrar-item-add").css('cursor', 'pointer');
        }
    })

    $(".nome-item-add").on('keyup',function () {
        var nomeItem = $(".nome-item-add").val();

        if (nomeItem.length < 3){
            $(".cadastrar-item-add").attr('disabled', 'true');
            $(".cadastrar-item-add").css('cursor', 'not-allowed');
        }else{
            $(".cadastrar-item-add").removeAttr('disabled', 'true');
            $(".cadastrar-item-add").css('cursor', 'pointer');
        }
    })

    $(".valor-item-add-edit").on('keyup',function () {
        var valorItem2 = $(".valor-item-add-edit").val();

        if (valorItem2.length < 5){
            $(".edit-item-add").attr('disabled', 'true');
            $(".edit-item-add").css('cursor', 'not-allowed');
        }else{
            $(".edit-item-add").removeAttr('disabled', 'true');
            $(".edit-item-add").css('cursor', 'pointer');
        }
    })

    $(".nome-item-add-edit").on('keyup',function () {
        var nomeItem2 = $(".nome-item-add-edit").val();

        if (nomeItem2.length < 3){
            $(".edit-item-add").attr('disabled', 'true');
            $(".edit-item-add").css('cursor', 'not-allowed');
        }else{
            $(".edit-item-add").removeAttr('disabled', 'true');
            $(".edit-item-add").css('cursor', 'pointer');
        }
    });

//Configurações ao adicionar item à bandeja.
$(".adicionar-bandeja").on('click', function (){
    $(this).html('<div class="spinner-border text-white" role="status"></div>');

    setTimeout(function (){
        $(".aditionals").removeAttr('checked');
        $(".cancela-personalizar").click();

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Item adicionado ao pedido.'
        })
    }, 700)
});

    $(".remove-item").on('click', function (){
        setTimeout(function (){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Item removido do pedido.'
            })
        }, 800)
    });

//Copiando informações de entrega.
$(".copiado").hide();

$(".copiar").on("click", function () {

    var idPedido = $(".idPedido").text();

    var clientePedido = $(".clientePedido").text();
    var itensPedido = $(".itensPedido").text();
    var valorPedido = $(".valorPedido").text();

    // if ($(".pagamentoCartao").text() != '') {
    //     var pagamento = 'Pagamento em cartão: ' + $(".pagamentoCartao").text()
    // } else {
    //     var pagamento = 'Troco para: ' + $(".trocoPedido").text();
    // }
})
//
//     var enderecoPedido = $(".enderecoPedido").text();
//
//     var informacoes = 'Id: ' + idPedido + "\n" + 'Cliente: ' + clientePedido
//     + "\n" + 'Itens: ' + itensPedido + "\n" + 'Valor total: ' + valorPedido + "\n" +
//     pagamento + "\n" + 'Endereço:' + enderecoPedido;
//
//     console.log(informacoes);
//
//     $(".copiado").fadeIn('slow');
//
//     setTimeout(function (){
//         $(".copiado").fadeOut('slow');
//     }, 3000)




// });


});
