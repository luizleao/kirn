<?php
class ControllerTIME extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar TIME
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTIME($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTIME($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($id,$pais,$tecnico);
		$oTIMEBD = new TIMEBD();
		if(!$oTIMEBD->cadastrar($oTIME)){
			$this->msg = $oTIMEBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de TIME
	 *
	 * @access public
	 * @param TIME $oTIME
	 * @return bool
	 */
	public function alterar($oTIME = NULL){
		if($oTIME == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTIME(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTIME($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($id,$pais,$tecnico);
		}		
		$oTIMEBD = new TIMEBD();
		if(!$oTIMEBD->alterar($oTIME)){
			$this->msg = $oTIMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir TIME
	 *
	 * @access public
	 * @param integer $idTIME
	 * @return bool
	 */
	public function excluir($idTIME){		
		$oTIMEBD = new TIMEBD();		
		if(!$oTIMEBD->excluir($idTIME)){
			$this->msg = $oTIMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de TIME
	 *
	 * @access public
	 * @param integer $id
	 * @return TIME
	 */
	public function get($id){
		$oTIMEBD = new TIMEBD();
		if($oTIMEBD->msg != ''){
			$this->msg = $oTIMEBD->msg;
			return false;
		}
		if(!$obj = $oTIMEBD->get($id)){
		    $this->msg = $oTIMEBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de TIME
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return TIME[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTIMEBD = new TIMEBD();
			$aux = $oTIMEBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTIMEBD->msg != ''){
				$this->msg = $oTIMEBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de TIME
	 *
	 * @access public
	 * @param string $valor
	 * @return TIME
	 */
	public function consultar($valor){
		$oTIMEBD = new TIMEBD();	
		return $oTIMEBD->consultar($valor);
	}

	/**
	 * Total de registros de TIME
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTIMEBD = new TIMEBD();
		return $oTIMEBD->totalColecao();
	}

}