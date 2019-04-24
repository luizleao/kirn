<?php
class ControllerTELA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar TELA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTELA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTELA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTELA = new TELA($id,$nome);
		$oTELABD = new TELABD();
		if(!$oTELABD->cadastrar($oTELA)){
			$this->msg = $oTELABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de TELA
	 *
	 * @access public
	 * @param TELA $oTELA
	 * @return bool
	 */
	public function alterar($oTELA = NULL){
		if($oTELA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTELA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTELA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTELA = new TELA($id,$nome);
		}		
		$oTELABD = new TELABD();
		if(!$oTELABD->alterar($oTELA)){
			$this->msg = $oTELABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir TELA
	 *
	 * @access public
	 * @param integer $idTELA
	 * @return bool
	 */
	public function excluir($idTELA){		
		$oTELABD = new TELABD();		
		if(!$oTELABD->excluir($idTELA)){
			$this->msg = $oTELABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de TELA
	 *
	 * @access public
	 * @param integer $id
	 * @return TELA
	 */
	public function get($id){
		$oTELABD = new TELABD();
		if($oTELABD->msg != ''){
			$this->msg = $oTELABD->msg;
			return false;
		}
		if(!$obj = $oTELABD->get($id)){
		    $this->msg = $oTELABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de TELA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return TELA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTELABD = new TELABD();
			$aux = $oTELABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTELABD->msg != ''){
				$this->msg = $oTELABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de TELA
	 *
	 * @access public
	 * @param string $valor
	 * @return TELA
	 */
	public function consultar($valor){
		$oTELABD = new TELABD();	
		return $oTELABD->consultar($valor);
	}

	/**
	 * Total de registros de TELA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTELABD = new TELABD();
		return $oTELABD->totalColecao();
	}

}