<?php
class ControllerUNIFORME extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar UNIFORME
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formUNIFORME($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormUNIFORME($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($TIME_id);
		$oUNIFORME = new UNIFORME($idUNIFORME,$camisa,$shot,$meia,$UNIFORMEcol,$oTIME);
		$oUNIFORMEBD = new UNIFORMEBD();
		if(!$oUNIFORMEBD->cadastrar($oUNIFORME)){
			$this->msg = $oUNIFORMEBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de UNIFORME
	 *
	 * @access public
	 * @param UNIFORME $oUNIFORME
	 * @return bool
	 */
	public function alterar($oUNIFORME = NULL){
		if($oUNIFORME == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formUNIFORME(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormUNIFORME($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($TIME_id);
			$oUNIFORME = new UNIFORME($idUNIFORME,$camisa,$shot,$meia,$UNIFORMEcol,$oTIME);
		}		
		$oUNIFORMEBD = new UNIFORMEBD();
		if(!$oUNIFORMEBD->alterar($oUNIFORME)){
			$this->msg = $oUNIFORMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir UNIFORME
	 *
	 * @access public
	 * @param integer $idUNIFORME
	 * @return bool
	 */
	public function excluir($idUNIFORME){		
		$oUNIFORMEBD = new UNIFORMEBD();		
		if(!$oUNIFORMEBD->excluir($idUNIFORME)){
			$this->msg = $oUNIFORMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de UNIFORME
	 *
	 * @access public
	 * @param integer $idUNIFORME
	 * @param integer $TIME_id
	 * @return UNIFORME
	 */
	public function get($idUNIFORME,$TIME_id){
		$oUNIFORMEBD = new UNIFORMEBD();
		if($oUNIFORMEBD->msg != ''){
			$this->msg = $oUNIFORMEBD->msg;
			return false;
		}
		if(!$obj = $oUNIFORMEBD->get($idUNIFORME,$TIME_id)){
		    $this->msg = $oUNIFORMEBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de UNIFORME
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return UNIFORME[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oUNIFORMEBD = new UNIFORMEBD();
			$aux = $oUNIFORMEBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oUNIFORMEBD->msg != ''){
				$this->msg = $oUNIFORMEBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de UNIFORME
	 *
	 * @access public
	 * @param string $valor
	 * @return UNIFORME
	 */
	public function consultar($valor){
		$oUNIFORMEBD = new UNIFORMEBD();	
		return $oUNIFORMEBD->consultar($valor);
	}

	/**
	 * Total de registros de UNIFORME
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oUNIFORMEBD = new UNIFORMEBD();
		return $oUNIFORMEBD->totalColecao();
	}

}