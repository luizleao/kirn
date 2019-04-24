<?php
class ControllerSessionIndicador extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar SessionIndicador
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSessionIndicador($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSessionIndicador($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSession = new Session($session_id);
		$oSessionIndicador = new SessionIndicador($oSession,$indicadores_id);
		$oSessionIndicadorBD = new SessionIndicadorBD();
		if(!$oSessionIndicadorBD->cadastrar($oSessionIndicador)){
			$this->msg = $oSessionIndicadorBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de SessionIndicador
	 *
	 * @access public
	 * @param SessionIndicador $oSessionIndicador
	 * @return bool
	 */
	public function alterar($oSessionIndicador = NULL){
		if($oSessionIndicador == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSessionIndicador(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSessionIndicador($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSession = new Session($session_id);
			$oSessionIndicador = new SessionIndicador($oSession,$indicadores_id);
		}		
		$oSessionIndicadorBD = new SessionIndicadorBD();
		if(!$oSessionIndicadorBD->alterar($oSessionIndicador)){
			$this->msg = $oSessionIndicadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir SessionIndicador
	 *
	 * @access public
	 * @param integer $idSessionIndicador
	 * @return bool
	 */
	public function excluir($idSessionIndicador){		
		$oSessionIndicadorBD = new SessionIndicadorBD();		
		if(!$oSessionIndicadorBD->excluir($idSessionIndicador)){
			$this->msg = $oSessionIndicadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de SessionIndicador
	 *
	 * @access public
	 * @param integer $indicadores_id
	 * @return SessionIndicador
	 */
	public function get($indicadores_id){
		$oSessionIndicadorBD = new SessionIndicadorBD();
		if($oSessionIndicadorBD->msg != ''){
			$this->msg = $oSessionIndicadorBD->msg;
			return false;
		}
		if(!$obj = $oSessionIndicadorBD->get($indicadores_id)){
		    $this->msg = $oSessionIndicadorBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de SessionIndicador
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return SessionIndicador[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSessionIndicadorBD = new SessionIndicadorBD();
			$aux = $oSessionIndicadorBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSessionIndicadorBD->msg != ''){
				$this->msg = $oSessionIndicadorBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de SessionIndicador
	 *
	 * @access public
	 * @param string $valor
	 * @return SessionIndicador
	 */
	public function consultar($valor){
		$oSessionIndicadorBD = new SessionIndicadorBD();	
		return $oSessionIndicadorBD->consultar($valor);
	}

	/**
	 * Total de registros de SessionIndicador
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSessionIndicadorBD = new SessionIndicadorBD();
		return $oSessionIndicadorBD->totalColecao();
	}

}