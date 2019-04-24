<?php
class ControllerSession extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Session
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSession($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSession($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSession = new Session($id,$ident);
		$oSessionBD = new SessionBD();
		if(!$oSessionBD->cadastrar($oSession)){
			$this->msg = $oSessionBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Session
	 *
	 * @access public
	 * @param Session $oSession
	 * @return bool
	 */
	public function alterar($oSession = NULL){
		if($oSession == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSession(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSession($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSession = new Session($id,$ident);
		}		
		$oSessionBD = new SessionBD();
		if(!$oSessionBD->alterar($oSession)){
			$this->msg = $oSessionBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Session
	 *
	 * @access public
	 * @param integer $idSession
	 * @return bool
	 */
	public function excluir($idSession){		
		$oSessionBD = new SessionBD();		
		if(!$oSessionBD->excluir($idSession)){
			$this->msg = $oSessionBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Session
	 *
	 * @access public
	 * @param integer $id
	 * @return Session
	 */
	public function get($id){
		$oSessionBD = new SessionBD();
		if($oSessionBD->msg != ''){
			$this->msg = $oSessionBD->msg;
			return false;
		}
		if(!$obj = $oSessionBD->get($id)){
		    $this->msg = $oSessionBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Session
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Session[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSessionBD = new SessionBD();
			$aux = $oSessionBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSessionBD->msg != ''){
				$this->msg = $oSessionBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Session
	 *
	 * @access public
	 * @param string $valor
	 * @return Session
	 */
	public function consultar($valor){
		$oSessionBD = new SessionBD();	
		return $oSessionBD->consultar($valor);
	}

	/**
	 * Total de registros de Session
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSessionBD = new SessionBD();
		return $oSessionBD->totalColecao();
	}

}