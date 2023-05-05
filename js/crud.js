$(document).ready(function(){
    var dadosBranco    = {host:"", login:"", senha: ""};   
    var dadosMysql 	   = {host:"localhost", login:"root", senha:"@1234567890#"};    
    var dadosSqlServer = {host:"172.16.107.88", login:"sa", senha:"cgti*2013"};    
    var dadosPostgre   = {host:"localhost", login:"postgres", senha:"postgres"};
    
    var modalExcluir  = M.Modal.getInstance($('#modalExcluir'));
	var modalResposta = M.Modal.getInstance($('#modalResposta'));
	var modalUrl 	  = M.Modal.getInstance($('#modalUrl'));
	
	if($('#database').length)
		var database 	  = M.FormSelect.getInstance($('#database'));
    var tempoTimeout  = 1000000;
	
    $('#btnGerar').addClass("disabled");
    
    /**
     * Funcao selecionar SGBD
     * 
     */
    $("#sgbd").change(function (){
        //alert($("#sgbd").val());
        switch($("#sgbd").val()){
            case "mysql":     objFormTemp = dadosMysql; break;
            case "sqlserver": objFormTemp = dadosSqlServer; break;
            case "postgre":   objFormTemp = dadosPostgre; break;            
            default:          objFormTemp = dadosBranco; break;
        }
        
        $("#host").val(objFormTemp.host);
        $("#login").val(objFormTemp.login);
        $("#senha").val(objFormTemp.senha);
        
        $("#host").focus();
        $("#login").focus();
        $("#senha").focus();
    });
    
    /**
     * Funcao Conectar BD
     * 
     */
    $("#btnConectar").click(function(){
    	//console.log(database.getSelectedValues());
    	//console.log($("#sgbd").val());
    	
		$('#divLoading').removeClass('hide');
        if($("#sgbd").val() === '' || $("#sgbd").val() == null){
            $('#divLoading').addClass('hide');
            $('#modalResposta').find('.modal-content').html('<img src="img/ico_alert.png" /> Choose a DBMS');
            modalResposta.open();
            $("#sgbd").focus();
        }
        else if($("#login").val() == ''){
            $('#divLoading').addClass('hide');
            $('#modalResposta').find('.modal-content').html('<img src="img/ico_alert.png" /> Enter a Login');
            modalResposta.open();
            $("#login").focus();
        } else {
            $.ajax({
                type      : "post",
                url       : "conectar.php",
                data      : retornaParametros(document.forms[0]),
                dataType  : "json",
                beforeSend: function(){
                    $('#divLoading').removeClass('hide');
                },
                timeout   : tempoTimeout,
                success   : function(json){
                    //$('#modalResposta').find('.modal-content').html('<pre> '+json +'</pre>');
                    //modalResposta.open();
                	if(json.toString() === 'false'){
                        $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> Erro na conexão com o SGBD '+$("#sgbd").val());
                        modalResposta.open();
                        $('#divLoading').addClass('hide');
                    }
                	else if(json.toString() === ''){
                        $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> Nenhum Database encontrado');
                        modalResposta.open();
                        $('#divLoading').addClass('hide');
                    } else {
                        //alert(json);
                        $('#divLoading').addClass('hide');
                        $("#database").empty();
                        //console.log(json);
                        $.each(json, function(chave, valor){
                            $("#database").append('<option value="'+valor+'">'+valor+'</option>');
                        });
                        $('#database').formSelect();
                    }
                },
                error: function (response){
                	console.log(response);
                    $('#divLoading').addClass('hide');
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+response.responseText);
                    modalResposta.open();
                }
            });
        }
    });
    
    	
    /**
     * 
     * Funcao Gerar XML
     * 
     * @author luizleao
     */
    $("#btnGerarXml").click(function () {
        $.ajax({
            url       : 'index.php?acao=xml',
            type      : 'post',
            data      : retornaParametros(document.forms[0]),
            dataType  : 'html',
            beforeSend: function(){
                $('#divLoading').removeClass('hide');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#divLoading').addClass('hide');

                if(retorno !== '')
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_success.png" /> XML gerado com sucesso');
                modalResposta.open();
            },
            error: function (event, jqXHR, ajaxSettings){
                $('#divLoading').addClass('hide');
                $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+event +'-' +jqXHR +'-' +ajaxSettings);
                modalResposta.open();
            }
        });
    });
    
    
    /**
     * 
     * Funcao Download aplicacao
     * 
     * @author luizleao
     */
    $("a#download").click(function () {  	
        $.ajax({
            url       : 'index.php?acao=download&app='+$(this).data("app"),
            type      : 'post',
            data      : retornaParametros(document.forms[0]),
            dataType  : 'html',
            beforeSend: function(){
                $('#divLoading').removeClass('hide');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#divLoading').addClass('hide');
/*
                if(retorno !== '')
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_success.png" /> XML gerado com sucesso');
                modalResposta.open();
*/
            },
            error: function (event, jqXHR, ajaxSettings){
                $('#divLoading').addClass('hide');
                $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+event +'-' +jqXHR +'-' +ajaxSettings);
                modalResposta.open();
            }
        });
    });
    
    /**
     * 
     * Funcao Gerar Json
     * 
     * @author luizleao
     */
    $("#btnGerarJson").click(function () {
        $.ajax({
            url       : 'index.php?acao=json',
            type      : 'post',
            data      : retornaParametros(document.forms[0]),
            dataType  : 'html',
            beforeSend: function(){
                $('#divLoading').removeClass('hide');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
                //print_r(document.forms[0]);
                $('#divLoading').addClass('hide');

                if(retorno !== '')
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_success.png" /> Json gerado com sucesso');
                modalResposta.open();
            },
            error: function (event, jqXHR, ajaxSettings){
                $('#divLoading').addClass('hide');
                $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+event +'-' +jqXHR +'-' +ajaxSettings);
                modalResposta.open();
            }
        });
    });    
    
    /**
     * 
     * Funcao Gerar Artefatos
     * 
     * @author luizleao
     */
    $("a#btnGerarArtefatos").click(function () {
    //$("ul.dropdown-menu > li > a#btnGerarArtefatos").click(function () {
         $.ajax({
            url       : 'index.php?acao=gerar',
            type      : 'post',
            data      : 'xml='+$(this).data("xml")+'&gui='+$(this).data("gui"),           
            dataType  : 'html',
            beforeSend: function(){
                $('#divLoading').removeClass('hide');
            },
            timeout   : tempoTimeout,
            success   : function(retorno){
				$('#divLoading').addClass('hide');
                $('#modalResposta').find('.modal-content').html('<img src="img/ico_info.png" /> <br /> '+retorno);
                modalResposta.open();
            },
            error    : function(retorno){
				$('#divLoading').addClass('hide');
                $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
                modalResposta.open();
            }
        });
    });
    
    /**
     * 
     * Funcao Excluir XML
     * 
     * @author luizleao
     */
    $("a#btnExcluirXML").click(function () {
    	arquivoXml = $(this).data("xml");
        $('#modalExcluir').find('.modal-content').html('<img src="img/ico_question.png" /> Deseja excluir o arquivo "'+arquivoXml+'.xml"?');
    	modalExcluir.open();
    	
        $('#btnSim').click(function () {
            $.ajax({
            	url       : 'index.php?acao=excluirXML',
                type      : 'post',
                data      : 'xml='+arquivoXml,
                dataType  : 'html',
                timeout    : tempoTimeout,
                beforeSend: function(){
                    $('#divLoading').removeClass('hide');
                },
                success    : function(retorno){
                	//alert(retorno);
                    modalExcluir.close();
                    $('#modalResposta').find('.modal-content').html((retorno !== '' && retorno !== '1') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> XML excluido com sucesso');
                    modalResposta.open();
                },
                error	   : function(retorno){
                    modalExcluir.close();
                    $('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
                    modalResposta.open();
                }
            });
        });
    });
    
	/**
	 * Abrir tela Settings
	 * 
	 * @author luizleao
	 */
	$("a#btnSettings").click(function () {
	    $('#modalUrl').find('.modal-content').load('settings.php');
	    modalUrl.open();
	});	
});