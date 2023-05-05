$(document).ready(function(){
	var classe = $("#classe").val();

    /**
     * 
     * Ação Cadastrar
     * 
     * @author luizleao
     */
    $("#btnCadastrar").click(function () {
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'frm'+classe+'.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnCadastrar').button('loading');
            },
            timeout: 3000,
            success: function(retorno){
                $('#btnCadastrar').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-body').html('<img src="img/ico_success.png" />Cadastrado com sucesso');
                $('#modalResposta').modal('show');
            },
            error: function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });

    /**
     * 
     * Ação Editar
     * @author luizleao
     */
    $("#btnEditar").click(function () {
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'frm'+classe+'.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnEditar').button('loading');
            },
            timeout: 3000,
            success: function(retorno){
                $('#btnEditar').button('reset');

                if(retorno !== '')
                    $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                else
                    $('#modalResposta > .modal-body').html('<img src="img/ico_success.png" /> Editado com sucesso');
                $('#modalResposta').modal('show');
            },
            error: function(){
                $('#btnEditar').button('reset');
                $('#modalResposta > .modal-body').html('Erro!!');
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
    
    /**
	 * Funcao Excluir
	 * 
	 * @author luizleao
	 */
	$("a#btnExcluir").click(function () {
		var campo = $(this).data("id");
		var valor = $(this).data("id-valor");
		
	    $('#modalExcluir').modal('show');
	    $('#modalExcluir > .modal-body').html('Deseja excluir '+ classe +'?');

	    $('#btnSim').click(function () {
	        $.ajax({
	            url  	   : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
	            type 	   : 'get',
	            beforeSend : function(){
	                    $('#btnCadastrar').button('loading');
	            },
	            timeout	   : 3000,
	            success	   : function(retorno){
	                $('#modalExcluir').modal('hide');
	                if(retorno !== ''){
	                    $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
	                    $('#modalResposta').modal('show');
	                }
	                else{
	                    $('#modalResposta > .modal-body').html('<img src="img/ico_success.png" /> Excluido com sucesso');
	                    $('#modalResposta').modal('show');
	                    $('#modalResposta').on('hide', function () {
	                        window.location = 'adm'+classe+'.php';
	                    });
	                }
	            },
	            error	   : function(retorno){
	                $('#modalExcluir').modal('hide');
	                $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
	                $('#modalResposta').modal('show');
	            }
	        });
	    });
	});
	
	/**
	 * Funcao ver detalhes
	 * 
	 * @author luizleao
	 */
	$("a#btnDetalhes").click(function () {
	    $('#modalRemote').find('.modal-body').load('detail'+classe+'.php?id='+$(this).data("id"));
	    $('#modalRemote').modal('show');
	});
	
    /**
     * 
     * Ação Logar
     * @author luizleao
     */
    $('#btnLogar').click(function(){
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'index.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnLogar').button('loading');
            },
            timeout: 3000,
            success: function(retorno){
                $('#btnLogar').button('reset');

                if(retorno !== ''){
                    $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                    $('#modalResposta').modal('show');
                } else{
                    window.location = 'home.php';
                }
            },
            error: function(retorno){
                $('#btnLogar').button('reset');
                $('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> Erro: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown', function (){
            $('#modalResposta > .modal-footer > #btnFechar').focus();
        });
    });
	
    // Mascaramento de dados    
    $('.cep').mask('00000-000');
    $('.telefone').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});