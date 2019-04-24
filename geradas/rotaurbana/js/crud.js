$(document).ready(function(){
    var classe = $("#classe").val();
    var timeout = 5000;
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
            timeout: timeout,
            success: function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Cadastrado com sucesso');
                $('#modalResposta').modal('show');            
            },
            error: function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
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
            timeout: timeout,
            success: function(retorno){
                $('#btnEditar').button('reset');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Editado com sucesso');
                $('#modalResposta').modal('show');
            },
            error: function(retorno){
            	console.log(retorno);
                $('#btnEditar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> Erro!!: '+retorno.status+' - '+retorno.statusText);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
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
	    $('#modalExcluir').find('.modal-body').html('Deseja excluir '+ classe +'?');

	    $('#btnSim').click(function () {
	        $.ajax({
	            url        : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
	            type       : 'get',
	            beforeSend : function(){
	                $('#btnCadastrar').button('loading');
	            },
	            timeout    : timeout,
	            success    : function(retorno){
	                $('#modalExcluir').modal('hide');
	                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Excluido com sucesso');
	                $('#modalResposta').modal('show');
	                $('#modalResposta').on('hide.bs.modal', function () {
	                    window.location = 'adm'+classe+'.php';
	                });
	            },
	            error	   : function(retorno){
	                $('#modalExcluir').modal('hide');
	                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
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
            timeout: timeout,
            success: function(retorno){
                $('#btnLogar').button('reset');

                if(retorno !== ''){
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                    $('#modalResposta').modal('show');
                } else{
                    window.location = 'home.php';
                }
            },
            error: function(retorno){
                $('#btnLogar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> Erro: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });
    
    // Mascaramento de dados
    $('.date').mask('11/11/1111');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.telefone').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});