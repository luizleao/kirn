<?php
class ControllerAcompanhamento extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Acompanhamento
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formAcompanhamento($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormAcompanhamento($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTicket = new Ticket($idTicket);
		$oAcompanhamento = new Acompanhamento($idAcompanhamento,$oTicket,$descricao,$dataHora,$usuario,$status);
		$oAcompanhamentoBD = new AcompanhamentoBD();
		if(!$oAcompanhamentoBD->cadastrar($oAcompanhamento)){
			$this->msg = $oAcompanhamentoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Acompanhamento
	 *
	 * @access public
	 * @param Acompanhamento $oAcompanhamento
	 * @return bool
	 */
	public function alterar($oAcompanhamento = NULL){
		if($oAcompanhamento == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formAcompanhamento(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormAcompanhamento($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTicket = new Ticket($idTicket);
			$oAcompanhamento = new Acompanhamento($idAcompanhamento,$oTicket,$descricao,$dataHora,$usuario,$status);
		}		
		$oAcompanhamentoBD = new AcompanhamentoBD();
		if(!$oAcompanhamentoBD->alterar($oAcompanhamento)){
			$this->msg = $oAcompanhamentoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Acompanhamento
	 *
	 * @access public
	 * @param integer $idAcompanhamento
	 * @return bool
	 */
	public function excluir($idAcompanhamento){		
		$oAcompanhamentoBD = new AcompanhamentoBD();		
		if(!$oAcompanhamentoBD->excluir($idAcompanhamento)){
			$this->msg = $oAcompanhamentoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Acompanhamento
	 *
	 * @access public
	 * @param integer $idAcompanhamento
	 * @return Acompanhamento
	 */
	public function get($idAcompanhamento){
		$oAcompanhamentoBD = new AcompanhamentoBD();
		if($oAcompanhamentoBD->msg != ''){
			$this->msg = $oAcompanhamentoBD->msg;
			return false;
		}
		if(!$obj = $oAcompanhamentoBD->get($idAcompanhamento)){
		    $this->msg = $oAcompanhamentoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Acompanhamento
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Acompanhamento[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oAcompanhamentoBD = new AcompanhamentoBD();
			$aux = $oAcompanhamentoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oAcompanhamentoBD->msg != ''){
				$this->msg = $oAcompanhamentoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Acompanhamento
	 *
	 * @access public
	 * @param string $valor
	 * @return Acompanhamento
	 */
	public function consultar($valor){
		$oAcompanhamentoBD = new AcompanhamentoBD();	
		return $oAcompanhamentoBD->consultar($valor);
	}

	/**
	 * Total de registros de Acompanhamento
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oAcompanhamentoBD = new AcompanhamentoBD();
		return $oAcompanhamentoBD->totalColecao();
	}

}