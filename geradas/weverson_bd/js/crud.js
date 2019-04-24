$(document).ready(function(){
	var classe = $("#classe").val();
	var modalResposta = M.Modal.getInstance($('#modalResposta'));
	var modalExcluir  = M.Modal.getInstance($('#modalExcluir'));
	var modalRemote   = M.Modal.getInstance($('#modalRemote'));
	
	var tempo = 5000;
	var msg = "";
	
	//modalExcluir.option = {onCloseStart: function (){alert('teste')}};
	
	//console.log(modalExcluir);
	/**
	 * Função Logar
	 * 
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
				$('#divLoading').removeClass('hide');
			},
			timeout: tempo,
			success: function(retorno){
				console.log(retorno);
				$('#divLoading').addClass('hide');

				if(retorno != ''){
					$('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
					modalResposta.open();
				} else{
					window.location = 'home.php';
				}
			},
			error: function(retorno){
				console.log(retorno);
				$('#divLoading').addClass('hide');
				$('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> Erro: '+retorno);
				modalResposta.open();
			}
		});
	});
	
	/**
	 * Funcao Cadastrar
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
				$('#divLoading').removeClass('hide');
			},
			timeout: tempo,
			success: function(retorno){
				$('#divLoading').addClass('hide');
				msg = (retorno != '')  ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" />Cadastrado com sucesso';  
				$('#modalResposta').find('.modal-content').html(msg);
				modalResposta.open();
			},
			error: function(retorno){
				console.log(retorno);
				$('#divLoading').addClass('hide');
				$('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> '+retorno);
				modalResposta.open();
			}
		});
	});

	/**
	 * Funcao Editar
	 * 
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
				$('#divLoading').removeClass('hide');
			},
			timeout: tempo,
			success: function(retorno){
				$('#divLoading').addClass('hide');
				msg = (retorno != '')  ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" />Editado com sucesso';
				$('#modalResposta').find('.modal-content').html(msg);
				modalResposta.open();
			},
			error: function(erro){
				//console.log(erro);
				$('#divLoading').addClass('hide');
				$('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> Erro!!');
				modalResposta.open();
			}
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
		
		$('#modalExcluir').find('.modal-content').html('<img src="img/ico_question.png" /> Deseja excluir '+ classe +'?');
		modalExcluir.open();
		
		$('#btnSim').click(function () {
			$.ajax({
				url  	   : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
				type 	   : 'get',
				beforeSend : function(){
					$('#divLoading').removeClass('hide');
				},
				timeout	: tempo,
				success : function(retorno){
					$('#divLoading').addClass('hide');
					modalExcluir.close();
					msg = (retorno != '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Excluido com sucesso';  
					$('#modalResposta').find('.modal-content').html(msg);
					modalResposta.open();
					
					modalResposta.options.onCloseEnd = function (){
						window.location = 'adm'+classe+'.php';
			        };
					//console.log(modalResposta);			
				},
				error : function(retorno){
					modalExcluir.close();
					$('#modalResposta').find('.modal-content').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
					modalResposta.open();
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
	    $('#modalRemote').find('.modal-content').load('detail'+classe+'.php?id='+$(this).data("id"));
	    modalRemote.open();
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