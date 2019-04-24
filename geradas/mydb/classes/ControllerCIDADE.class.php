<?php
class ControllerCIDADE extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CIDADE
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCIDADE($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCIDADE($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oESTADO = new ESTADO($ESTADO_id);
		$oCIDADE = new CIDADE($id,$nome,$oESTADO);
		$oCIDADEBD = new CIDADEBD();
		if(!$oCIDADEBD->cadastrar($oCIDADE)){
			$this->msg = $oCIDADEBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CIDADE
	 *
	 * @access public
	 * @param CIDADE $oCIDADE
	 * @return bool
	 */
	public function alterar($oCIDADE = NULL){
		if($oCIDADE == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCIDADE(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCIDADE($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oESTADO = new ESTADO($ESTADO_id);
			$oCIDADE = new CIDADE($id,$nome,$oESTADO);
		}		
		$oCIDADEBD = new CIDADEBD();
		if(!$oCIDADEBD->alterar($oCIDADE)){
			$this->msg = $oCIDADEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CIDADE
	 *
	 * @access public
	 * @param integer $idCIDADE
	 * @return bool
	 */
	public function excluir($idCIDADE){		
		$oCIDADEBD = new CIDADEBD();		
		if(!$oCIDADEBD->excluir($idCIDADE)){
			$this->msg = $oCIDADEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CIDADE
	 *
	 * @access public
	 * @param integer $id
	 * @return CIDADE
	 */
	public function get($id){
		$oCIDADEBD = new CIDADEBD();
		if($oCIDADEBD->msg != ''){
			$this->msg = $oCIDADEBD->msg;
			return false;
		}
		if(!$obj = $oCIDADEBD->get($id)){
		    $this->msg = $oCIDADEBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CIDADE
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CIDADE[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCIDADEBD = new CIDADEBD();
			$aux = $oCIDADEBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCIDADEBD->msg != ''){
				$this->msg = $oCIDADEBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CIDADE
	 *
	 * @access public
	 * @param string $valor
	 * @return CIDADE
	 */
	public function consultar($valor){
		$oCIDADEBD = new CIDADEBD();	
		return $oCIDADEBD->consultar($valor);
	}

	/**
	 * Total de registros de CIDADE
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCIDADEBD = new CIDADEBD();
		return $oCIDADEBD->totalColecao();
	}

}