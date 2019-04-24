<?php
class ControllerAcessoSession extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar AcessoSession
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formAcessoSession($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormAcessoSession($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oAcesso = new Acesso($oIndicador);
		$oAcessoSession = new AcessoSession($oAcesso,$sessions_id);
		$oAcessoSessionBD = new AcessoSessionBD();
		if(!$oAcessoSessionBD->cadastrar($oAcessoSession)){
			$this->msg = $oAcessoSessionBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de AcessoSession
	 *
	 * @access public
	 * @param AcessoSession $oAcessoSession
	 * @return bool
	 */
	public function alterar($oAcessoSession = NULL){
		if($oAcessoSession == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formAcessoSession(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormAcessoSession($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oAcesso = new Acesso($oIndicador);
			$oAcessoSession = new AcessoSession($oAcesso,$sessions_id);
		}		
		$oAcessoSessionBD = new AcessoSessionBD();
		if(!$oAcessoSessionBD->alterar($oAcessoSession)){
			$this->msg = $oAcessoSessionBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir AcessoSession
	 *
	 * @access public
	 * @param integer $idAcessoSession
	 * @return bool
	 */
	public function excluir($idAcessoSession){		
		$oAcessoSessionBD = new AcessoSessionBD();		
		if(!$oAcessoSessionBD->excluir($idAcessoSession)){
			$this->msg = $oAcessoSessionBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de AcessoSession
	 *
	 * @access public
	 * @param integer $sessions_id
	 * @return AcessoSession
	 */
	public function get($sessions_id){
		$oAcessoSessionBD = new AcessoSessionBD();
		if($oAcessoSessionBD->msg != ''){
			$this->msg = $oAcessoSessionBD->msg;
			return false;
		}
		if(!$obj = $oAcessoSessionBD->get($sessions_id)){
		    $this->msg = $oAcessoSessionBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de AcessoSession
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return AcessoSession[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oAcessoSessionBD = new AcessoSessionBD();
			$aux = $oAcessoSessionBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oAcessoSessionBD->msg != ''){
				$this->msg = $oAcessoSessionBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de AcessoSession
	 *
	 * @access public
	 * @param string $valor
	 * @return AcessoSession
	 */
	public function consultar($valor){
		$oAcessoSessionBD = new AcessoSessionBD();	
		return $oAcessoSessionBD->consultar($valor);
	}

	/**
	 * Total de registros de AcessoSession
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oAcessoSessionBD = new AcessoSessionBD();
		return $oAcessoSessionBD->totalColecao();
	}

}