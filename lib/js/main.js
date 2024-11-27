/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidebar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

$(document).ready(function() { // transforma os select em select2
    $('#idCliente, #idRepresentante').select2({
        width: '100%',   
        language: "pt-BR",
        theme: 'bootstrap4',
        minimumInputLength: 3 
        });
});

function shorten_url(long_urlField, shorten_urlField) { // função para encurtar links através do bitly --- variáveis: nome do campo da url original, nome do campo do url curto
   
    var url = document.getElementById(long_urlField).value;

    console.log(long_urlField);
    console.log(shorten_urlField);

    if (url == "") {
        alert("O campo de link deve ser preenchido.");
        $("#"+long_urlField).focus();
        return false;
    }

    var accessToken = "a8b12bd7f754fc167efe63824ee78b74bfcb45bf"; // tojen fornecido pelo bitly
    var params = {
        "long_url" : url           
    };

    $.ajax({
        url: "https://api-ssl.bitly.com/v4/shorten",
        cache: false,
        dataType: "json",
        method: "POST",
        contentType: "application/json",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + accessToken);
        },
        data: JSON.stringify(params)
    }).done(function(data) {
        console.log(data);        
        var result = Object.values(data.link).join('');
        document.getElementById(shorten_urlField).value = result;
        $("#"+shorten_urlField).select();

    }).fail(function(data) {
        console.log(data);
        alert("Ocorreu um erro. Verifique o link digitado.");
    }); 
}

function whatsapp_url(celWhatsApp, linkWhatsApp) { // função para encurtar links através do bitly --- variáveis: nome do campo da url original, nome do campo do url curto
   
    var numberCel = document.getElementById('whatsappLink').value;

    if (numberCel == "") {
        alert("O campo do celular deve ser preenchido.");
        $("#"+celWhatsApp).focus();
        return false;
    }    

    var result = 'https://api.whatsapp.com/send?phone=55'+apenasNumeros(numberCel);
    document.getElementById(linkWhatsApp).value = result;
    $("#"+linkWhatsApp).select();    
}

function apenasNumeros(string) { // remove todos os caracteres que não sejam números
    var numsStr = string.replace(/[^0-9]/g, '');
    return parseInt(numsStr);
}

function selecionaEmail(tipoEmail) { // função deprecated -- descontinuada

	console.log("Selecionou: "+tipoEmail.value);

	var assunto = tipoEmail.value;
	var val = document.getElementById("selEmail").innerText;
    
	console.log(val);

	document.getElementById("assunto").value = (assunto); // preenche o campo

	// função para escrever no tinyMCE
	tinymce.get('mensagem').setContent('<p>'+assunto+'</p>');
}

function alteraPacote(tipoPacote) {     

    var cntrol = $(tipoPacote); // definimos onde buscar a quantidade de dias -- control
    var pacote = cntrol.find(':selected').data("tipopacote"); // captura o valor do segundo valor de controle e armazena em variável
    //var idPacote = cntrol.find(':selected').data("value");
    
    document.getElementById('postsPacote').style.display = 'none';
    document.getElementById('start_date').disabled = true; 
    document.getElementById('end_date').disabled = true; 
    document.getElementById('diasSemana').disabled = true;

    if(cntrol.val() != "")  { 
        if (pacote == "posts") {
            document.getElementById('postsPacote').style.display = 'block';            
            document.getElementById('start_date').disabled = false; 
            document.getElementById('end_date').disabled = false; 
            document.getElementById('diasSemana').disabled = false; 
        }
    } else {
        document.getElementById('postsPacote').style.display = 'none';
    }

    console.log(pacote);
}

function alteraMateria(dias) { //altera o prazo em dias baseado na seleção da matéria

    // primeiro, vamos contar as matérias que já existam
    var idMateria = document.getElementById("idMateria").value;        
    var idContrato = $("#idContrato").get(0);
    var $campoContaMaterias = $("input[name='contaMaterias']");
    var $campoUltimaData = $("input[name='ultimaData']");

    var cntrol = $(dias); // definimos onde buscar a quantidade de dias -- control
    var materia = cntrol.find(':selected').data("value"); // captura o valor do segundo valor de controle e armazena em variável
    var prazoDiasCtN = document.getElementById("prazoCt").value; // armazena o prazo do contrato em uma variável
    var prazoDiasCt = Number(prazoDiasCtN); // transforma a string em número

    var expiracao = 'Expiração (+'+prazoDiasCt+' Dias)';
    var finalvalueExp = expiracao;
    $('#lblDataExpiracao').text(finalvalueExp);

    if(cntrol.val() != "")  {  

        document.getElementById('prazo').value = prazoDiasCt; // define o período da matéria -- baseado no contrato
  
        $.getJSON('function_retorna-materia.php', {
            // estas são as variáveis que fazem o filtro no arquivo function_retorna-materia.php?idContrato=1&idMateria=1
            idMateria: $("#idMateria").val(),  idContrato: idContrato.value
            
        }, function (json){
            
            // carregando JSON, que conta as matérias...
            $campoContaMaterias.val(json.resultado); // preenche o campo de contagem de matérias
            $campoUltimaData.val(json.ultimoRegistro); // preenche o campo de contagem de matérias

            // defino as variáveis conforme o resultado do json
            qtdMaterias = json.resultado;
            ultimaData = json.ultimoRegistro;

            // captura o valor do segundo valor de controle e armazena em variável
            var prazoDias = cntrol.find(':selected').data("prazo");

            // data de registro do contrato            
            dataRegistroCt = document.getElementById("dataCt").value; // armazena a data de registro do contrato, sem formatação em uma variável
            acao = document.getElementById("acao").value; // qual a ação de edição?
            
            // exibe as contagens no console
            console.log('A data de registro do contrato é: '+dataRegistroCt); // exibe a data de registro do contrato, sem formatação 
            console.log('Quantas Matérias Repetidas: '+qtdMaterias);        
            console.log('Matéria: '+idMateria);
            console.log('Prazo de Produção: '+prazoDias+ ' dias');
            console.log(acao);
            
            if (qtdMaterias >= 1 && (idMateria == 4 || idMateria == 19)) {

                dataLimite2 = document.getElementById("dataLimite2").value; // qual a data limite já salva?
                console.log("A data limite do registro atual é: "+dataLimite2 ); // exibe a data de registro do contrato, sem formatação
                console.log("A data limite do último registro é: "+ultimaData ); // exibe a data de registro do contrato, sem formatação

                // este if será por conta de não permitir a edição e recálculo das datas
                if (acao == 'edit') {

                    var intervalo = 0;

                    // data limite                    
                    var dataLim = new Date(dataLimite2); // a data a ser tratada: a data de registro
                    dataLim.setDate(dataLim.getDate() + intervalo); // a data a ser tratada + a quantidade de dias

                    // data da produção                    
                    var dataProd = new Date(dataLimite2); // a data a ser tratada: a data de registro
                    dataProd.setDate(dataProd.getDate() + intervalo - 2); // a data a ser tratada + prazo em dias - 2 dias de antecedência para produção

                } else if (acao == 'add') { 

                    var intervalo = 90;
                    alert('Adicionaremos 90 dias após o último prazo. Já temos '+ qtdMaterias +' matéria(s) cadastrada(s).');
                    
                    // data limite
                    var dataLim = new Date(ultimaData); // a data a ser tratada: a data de registro
                    dataLim.setDate(dataLim.getDate() + intervalo); // a data a ser tratada + a quantidade de dias

                    // data da produção
                    var dataProd = new Date(ultimaData); // a data a ser tratada: a data de registro
                    dataProd.setDate(dataProd.getDate() + intervalo - 2); // a data a ser tratada + prazo em dias - 2 dias de antecedência para produção 

                }                 

            } else {
                
                // data limite
                var dataLim = new Date(dataRegistroCt); // a data a ser tratada: a data de registro
                dataLim.setDate(dataLim.getDate() + prazoDias); // a data a ser tratada + a quantidade de dias

                // data da produção
                var dataProd = new Date(dataRegistroCt); // a data a ser tratada: a data de registro
                dataProd.setDate(dataProd.getDate() + prazoDias - 2); // a data a ser tratada + prazo em dias - 2 dias de antecedência para produção                

            }

            if (idMateria == 4 || idMateria == 17 || idMateria == 18) {

                document.getElementById('divIdPublicacao').style.display = 'none';
                document.getElementById('idPublicacao').disabled = true;
                document.getElementById('prazo').disabled = true;
                document.getElementById('prazo').value = ''; // define o período da matéria
                // data da expiração
                var dataExp = new Date(''); // a data a ser tratada: nenhuma                  
                dataExp.setDate(dataExp.getDate() + prazoDias + prazoDiasCt); // a data a ser tratada + o período em dias do contrato

            } else if (idMateria == 19) { // Anúncio Classificado
                
                document.getElementById('divIdPublicacao').style.display = 'block';
                document.getElementById('idPublicacao').disabled = false;
                document.getElementById('prazo').disabled = false;                
                document.getElementById('prazo').value = '90'; // define o período da matéria

                document.getElementById('dataProducao').disabled = true;  
                document.getElementById('dataLimite').disabled = true;  
                document.getElementById('dataExpiracao').disabled = true; 

                var prazoField = document.getElementById('prazo').value;
                var prazo = Number(prazoField);

                // redefinimos a label da quantidade de dias para expirar
                var expiracaoLbl = 'Expiração: (+'+prazo+' Dias)';
                var finalvalueExp = expiracaoLbl;
                $('#lblDataExpiracao').text(finalvalueExp);                

                if (qtdMaterias >= 1) {                    
                    // data da expiração
                    var dataExp = new Date(ultimaData); // a data a ser tratada: nenhuma                  
                    dataExp.setDate(dataExp.getDate() + intervalo + prazo); // a data a ser tratada (última data) + o período em dias da validade dos classificados                    
                    
                } else {
                    // data da expiração
                    var dataExp = new Date(dataRegistroCt); // a data a ser tratada: nenhuma                  
                    dataExp.setDate(dataExp.getDate() + prazo + prazoDias); // a data a ser tratada (data do contrato) + o período em dias da validade dos classificados 
                }
            
            } else if (idMateria == 5 || idMateria == 15 || idMateria == 20 ) {

                document.getElementById('divIdPublicacao').style.display = 'none';
                document.getElementById('idPublicacao').disabled = true;
                document.getElementById('prazo').disabled = false;                
                //document.getElementById('prazo').value = '90'; // define o período da matéria

                document.getElementById('dataProducao').disabled = true;  
                document.getElementById('dataLimite').disabled = true;  
                document.getElementById('dataExpiracao').disabled = true; 

                var prazoField = document.getElementById('prazo').value;
                var prazo = Number(prazoField);
                 // data da expiração
                var dataExp = new Date(dataRegistroCt); // a data a ser tratada: a data de registro
                dataExp.setDate(dataExp.getDate() + prazo + prazoDias); // a data a ser tratada + o período em dias do contrato

            } else if (idMateria == 9 || idMateria == 10 || idMateria == 11 || idMateria == 12 || idMateria == 13 || idMateria == 14) {

                document.getElementById('divIdPublicacao').style.display = 'block';
                document.getElementById('idPublicacao').disabled = false;
                document.getElementById('prazo').disabled = false;                
                document.getElementById('prazo').value = '90'; // define o período da matéria

                document.getElementById('dataProducao').disabled = false;  
                document.getElementById('dataLimite').disabled = false;  
                document.getElementById('dataExpiracao').disabled = false;

                var prazoField = document.getElementById('prazo').value;
                var prazo = Number(prazoField);
                 // data da expiração
                var dataExp = new Date(dataRegistroCt); // a data a ser tratada: a data de registro
                dataExp.setDate(dataExp.getDate() + prazo + prazoDias); // a data a ser tratada + o período em dias do contrato 
            }

            else {

                document.getElementById('divIdPublicacao').style.display = 'block';
                document.getElementById('idPublicacao').disabled = false;
                document.getElementById('prazo').disabled = false;

                document.getElementById('dataProducao').disabled = true;  
                document.getElementById('dataLimite').disabled = true;  
                document.getElementById('dataExpiracao').disabled = true;

                var prazoField = document.getElementById('prazo').value;
                var prazo = Number(prazoField);
                 // data da expiração
                var dataExp = new Date(dataRegistroCt); // a data a ser tratada: a data de registro
                dataExp.setDate(dataExp.getDate() + prazo + prazoDias); // a data a ser tratada + o período em dias do contrato
            }

            // definindo a variável do prazo em dias
            var dataLimiteLbl = 'Data Limite (+' +prazoDias+ ' Dias)';
            var finalvalue = dataLimiteLbl;

            $('#lblDataLimite').text(finalvalue);
            console.log("O prazo de produção desta matéria em dias são: "+prazoDiasCt );

            // tratando as datas obtidas em formato javascript para o formato YYYY-MM-DD
            // data limite
            var dd = ('0' + dataLim.getDate()).slice(-2);
            var mm = ('0' + dataLim.getMonth() + 1).slice(-2); // 0 é janeiro, então adicionamos 1
            var yyyy = dataLim.getFullYear();
            var dataLimiteFinal;            
            dataLimiteFinal = dataLim.getFullYear() + '-' + ('0' + (dataLim.getMonth()+1)).slice(-2) + '-' + ('0' + dataLim.getDate()).slice(-2);

            // data da produção
            var dd = ('0' + dataProd.getDate()).slice(-2);
            var mm = ('0' + dataProd.getMonth() + 1).slice(-2); // 0 é janeiro, então adicionamos 1
            var yyyy = dataProd.getFullYear();
            var dataProducaoFinal; 
            dataProducaoFinal = dataProd.getFullYear() + '-' + ('0' + (dataProd.getMonth()+1)).slice(-2) + '-' + ('0' + dataProd.getDate()).slice(-2);
            
            // data da expiração
            var dd = ('0' + dataExp.getDate()).slice(-2);
            var mm = ('0' + dataExp.getMonth() + 1).slice(-2); // 0 é janeiro, então adicionamos 1
            var yyyy = dataExp.getFullYear();
            var dataExpiracaoFinal;
            dataExpiracaoFinal = dataExp.getFullYear() + '-' + ('0' + (dataExp.getMonth()+1)).slice(-2) + '-' + ('0' + dataExp.getDate()).slice(-2);
            
            // vemos as datas que acabamos de criar
            console.log('Limite: '+dataLimiteFinal);
            console.log('Produção: '+dataProducaoFinal);
            console.log('Expiração: '+dataExpiracaoFinal);            
            console.log('-----------');  

            // preenchemos os campos finalmente
            document.getElementById("dataLimite").value = (dataLimiteFinal); // preenche o campo
            document.getElementById("dataProducao").value = (dataProducaoFinal); // preenche o campo
            document.getElementById("dataExpiracao").value = (dataExpiracaoFinal); // preenche o campo        
            document.getElementById("dataExpiracaoCt").value = (dataExpiracaoFinal); // preenche o campo

        }); // fechando dentro da função json  
    
    } else {
        finalvalue = "Data Limite";        
        $('#lblDataLimite').text(finalvalue);
        document.getElementById("dataLimite").value = ''; // preenche o campo
        document.getElementById("dataProducao").value = ''; // preenche o campo
        document.getElementById("dataExpiracao").value = ''; // preenche o campo
        document.getElementById('idPublicacao').disabled = true; // desativa o selecionador de publicacoes
        document.getElementById('prazo').disabled = true; // desativa o selecionador de prazo
        document.getElementById('prazo').value = prazoDiasCt; // define o prazo padrão do selecionador de prazo
        document.getElementById('divIdPublicacao').style.display = 'none'; // oculta a div do seletor de publicação
    }
}

function alteraDataRegistro() { // altera a data de registro do contrato

    var dataRegistro = document.getElementById("dataRegistro").value; // obtém a data de registro
    var dataExpiracao = document.getElementById("dataExpiracao").value; // obtém a data de expiração
    console.log(dataRegistro);
    console.log(dataExpiracao);
    alert("Atenção: A data de expiração será alterada. Se já houverem matérias, estas precisam ser recadastradas para gerar um novo calendário.");    
}

function alteraPrazoContrato(dias) { // altera o prazo do contrato
    
    if (dias) {// qualquer escopo
         var diasExpiracao = dias.value; // captura o valor de this no campo de prazo e transforma em variável         
         console.log(dias.value);
    } else {
         var diasExpiracao = document.getElementById("prazoDias").value; // captura o valor do prazo já definido
         console.log(diasExpiracao);
    }

    var d = Number(diasExpiracao); // transforma a string em número
    var dataRegistro = document.getElementById("dataRegistro").value; // armazena a data de registro em uma variável    
    var dataExp = new Date(dataRegistro); // a data a ser tratada: a data de registro
    dataExp.setDate(dataExp.getDate() + d); // a data a ser tratada + a quantidade de dias

    console.log("A quantidade de dias é: "+d );
    console.log("A data de registro é: "+dataRegistro );
    
    // So you can see the output
    var dd = ('0' + dataExp.getDate()).slice(-2);
    var mm = ('0' + dataExp.getMonth() + 1).slice(-2); // 0 é janeiro, então adicionamos 1
    var yyyy = dataExp.getFullYear();    
    var dateString = dataExp.getFullYear() + '-' + ('0' + (dataExp.getMonth()+1)).slice(-2) + '-' + ('0' + dataExp.getDate()).slice(-2);
    
    document.getElementById("dataExpiracao").value = (dateString); // preenche o campo
    document.getElementById("prazoDias").value = (d); // preenche o campo // altera o prazo em dias baseado na seleção do período do contrato
}

function alteraPrazoMateria(dias) { // altera o prazo da matéria
    
    if (dias) {// qualquer escopo
         var diasExpiracao = dias.value; // captura o valor de this no campo de prazo e transforma em variável         
         console.log(dias.value);
    } else {
         var diasExpiracao = document.getElementById("prazoDias").value; // captura o valor do prazo já definido
         console.log(diasExpiracao);
    }

    var d = Number(diasExpiracao); // transforma a string em número    
    var dataLimite = document.getElementById("dataLimite").value; // armazena a data de registro em uma variável    
    var dataExp = new Date(dataLimite); // a data a ser tratada: a data de registro
    dataExp.setDate(dataExp.getDate() + d + 1); // a data a ser tratada + a quantidade de dias (adiciono um dia para arredondar a data)

    console.log("A quantidade de dias é: "+d );
    console.log("A data limite da matéria é: "+dataLimite );
    
    // So you can see the output
    var dd = ('0' + dataExp.getDate()).slice(-2);
    var mm = ('0' + dataExp.getMonth() + 1).slice(-2); // 0 é janeiro, então adicionamos 1
    var yyyy = dataExp.getFullYear();     
    var dateString = dataExp.getFullYear() + '-' + ('0' + (dataExp.getMonth()+1)).slice(-2) + '-' + ('0' + dataExp.getDate()).slice(-2);
      
    document.getElementById("dataExpiracao").value = (dateString); // preenche o campo
    document.getElementById("prazoDias").value = (d); // preenche o campo // altera o prazo em dias baseado na seleção do período do contrato

    // redefinimos a label da quantidade de dias para expirar
    var expiracao = 'Expiração: (+'+d+' Dias)';
    var finalvalueExp = expiracao;
    $('#lblDataExpiracao').text(finalvalueExp);

    console.log("A data de expiração da matéria é: "+dateString );        
}

function dataMaior() { // checa se a data é maior do que a definida - deprecated

    var dataExpiracaoCt = document.getElementById("dataExpiracaoCt").value;
    var dataExpiracao = document.getElementById("dataExpiracao").value; // armazena a data de registro do contrato, sem formatação em uma variável
      
    if (dataExpiracao > dataExpiracaoCt) {
        alert("A data tem que ser menor que a data de expiração do contrato.");
        document.getElementById("botaoSubmit").disabled = true;       
        return false;
    }
    document.getElementById("botaoSubmit").disabled = false;
    return true;
}

function ocultaTabs(idMateria) { // ocultando as tabs dependendo da matéria selecionada

    if (document.getElementById("idMateria") !== null) {
        var idMateria = document.getElementById("idMateria").value;
    } else {        
        return;
    }

    console.log("A matéria selecionada é... "+idMateria );

    // variáveis das tabs
    var a = document.getElementById("informacoes-tab");
    var b = document.getElementById("contato-tab");
    var c = document.getElementById("redessociais-tab");
    var d = document.getElementById("midias-tab");
    var e = document.getElementById("maisinformacoes-tab");
    var f = document.getElementById("localizacao-tab");
    var g = document.getElementById("postagens-tab");
    var h = document.getElementById("googleads-tab");

    var i = document.getElementById("btnPostsCliente");
    var j = document.getElementById("btnPostsPortal");

    switch(idMateria) {       
        
        case '1': // Plano Premium
        case '2': // Plano Plus
        case '3': // Plano Light
        case '19': // Anúncio Classificado
            a.style.display = "block";
            b.style.display = "block";
            c.style.display = "block";
            d.style.display = "block";
            e.style.display = "block";
            f.style.display = "block";
            g.style.display = "none";
            h.style.display = "none";
        break;

        case '4': // Peça Mídia Social
        case '9': // Super Banner
        case '10': // Banner Faixa 
        case '11': // Banner Pop Up
        case '12': // Banner Quad
        case '13': // Banner Quad
        case '14': // Banner Quad
        case '17': // Vídeo Institucional
        case '18': // Cartão Virtual
        case '21': // WhatsApp Marketing
            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "block";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "none";
            h.style.display = "none";
        break;

        case '5': // Postagem em Redes Sociais (Portal)

            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "block";
            h.style.display = "none";

            i.style.display = "none";
            j.style.display = "block";
        break;

        case '20': // Postagem em Redes Sociais (Cliente)

            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "block";
            h.style.display = "none";

            i.style.display = "block";
            j.style.display = "none";
        break;

        case '6': // Plano Prata
        case '7': // Plano Ouro
        case '8': // Plano Diamante        
            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "block";
            h.style.display = "none";
        break;

         case '15': // Google Ads
            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "none";
            h.style.display = "block";
        break;

        default:
            a.style.display = "none";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
            e.style.display = "none";
            f.style.display = "none";
            g.style.display = "none";
            h.style.display = "none";
        break;            
    }    
}

function removeCampo() { // oculta as divs de pessoa fisica ou jurídica - form clientes
    if (document.getElementById('p-fisica').checked) {
        document.getElementById('div-pf').style.display = 'block';
        document.getElementById('div-pj').style.display = 'none';
    } else {
        document.getElementById('div-pf').style.display = 'none';
        document.getElementById('div-pj').style.display = 'block';
    }
}

function removeCampoMaterias() { // oculta a div de incluir materias - form templates de emails
    if (document.getElementById('incluiMaterias-sim').checked) {
        document.getElementById('selMaterias').style.display = 'block';
    } else {
        document.getElementById('selMaterias').style.display = 'none';
    }
}

function lowerCase(a){ // função para transformar o texto em minúsculas
    setTimeout(function(){
        a.value = a.value.toLowerCase();
    }, 1);
}

function alteraCliente(idCliente) {
	var idCliente = document.getElementById("idCliente").value; // obtém o id do cliente e transforma em variável
    document.getElementById("idCliente2").value = (idCliente); // preenche o valor do campo com id idCliente2
}

function limiting(obj, limit, counter) { // função para contar e limitar caracteres -- (qual contar, limite de caracteres, onde exibir resultado)
    var cnt = $(counter);    
    var txt = $(obj).val(); 
    var len = txt.length;
    
    // check if the current length is over the limit
    if(len > limit){
       $(obj).val(txt.substr(0,limit));
       $(cnt).html(len-1+'/'+limit);
    } 
    else { 
    $(cnt).html(len+'/'+limit); // como exibe o contador
    }
}

function youtubeDownload(linkVideo) {
    var linkVideo = document.getElementById("linkVideo").value;
    console.log(linkVideo);
    window.open("http://"+host+"/portaldenegocios/manager/cadastros/contratos/materias/youtube.php?video_link="+linkVideo,'youtube_popup','width=800,height=800');
}

$(document).ready(function() { // função utilizada no gerenciador de Permissões. Ainda utilizada? Provavelmente não.

    // Check/Un-check All checkboxes in a User Row
    $(".checkall").click(function(){
        $(this).parents('tr')
               .find(':checkbox')
               .prop('checked', this.checked)
               .change();// trigger change event
});

    // Make AJAX Request to Update User Permission setting in Backend Database
    $(".flipswitch").change(function () {
        var flip = $(this).closest('td');
        console.log("idAcesso="+this.id+"&"+this.name+"="+this.checked);
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: "idAcesso="+this.id+"&"+this.name+"="+this.checked,
            success: function() {
                flip.effect("highlight", {color:"#12D812"}, 2000)
            }
        });
    });

});


