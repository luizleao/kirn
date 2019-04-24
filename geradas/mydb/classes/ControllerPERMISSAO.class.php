<?php
class ControllerPERMISSAO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PERMISSAO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPERMISSAO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPERMISSAO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERMISSAO = new PERMISSAO($id,$alteracao,$insercao,$exclusao,$visualizacao);
		$oPERMISSAOBD = new PERMISSAOBD();
		if(!$oPERMISSAOBD->cadastrar($oPERMISSAO)){
			$this->msg = $oPERMISSAOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PERMISSAO
	 *
	 * @access public
	 * @param PERMISSAO $oPERMISSAO
	 * @return bool
	 */
	public function alterar($oPERMISSAO = NULL){
		if($oPERMISSAO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPERMISSAO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPERMISSAO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERMISSAO = new PERMISSAO($id,$alteracao,$insercao,$exclusao,$visualizacao);
		}		
		$oPERMISSAOBD = new PERMISSAOBD();
		if(!$oPERMISSAOBD->alterar($oPERMISSAO)){
			$this->msg = $oPERMISSAOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PERMISSAO
	 *
	 * @access public
	 * @param integer $idPERMISSAO
	 * @return bool
	 */
	public function excluir($idPERMISSAO){		
		$oPERMISSAOBD = new PERMISSAOBD();		
		if(!$oPERMISSAOBD->excluir($idPERMISSAO)){
			$this->msg = $oPERMISSAOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PERMISSAO
	 *
	 * @access public
	 * @param integer $id
	 * @return PERMISSAO
	 */
	public function get($id){
		$oPERMISSAOBD = new PERMISSAOBD();
		if($oPERMISSAOBD->msg != ''){
			$this->msg = $oPERMISSAOBD->msg;
			return false;
		}
		if(!$obj = $oPERMISSAOBD->get($id)){
		    $this->msg = $oPERMISSAOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PERMISSAO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PERMISSAO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPERMISSAOBD = new PERMISSAOBD();
			$aux = $oPERMISSAOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPERMISSAOBD->msg != ''){
				$this->msg = $oPERMISSAOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PERMISSAO
	 *
	 * @access public
	 * @param string $valor
	 * @return PERMISSAO
	 */
	public function consultar($valor){
		$oPERMISSAOBD = new PERMISSAOBD();	
		return $oPERMISSAOBD->consultar($valor);
	}

	/**
	 * Total de registros de PERMISSAO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPERMISSAOBD = new PERMISSAOBD();
		return $oPERMISSAOBD->totalColecao();
	}

}