<?php
class ControllerTELAPERMISSAO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar TELAPERMISSAO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTELAPERMISSAO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTELAPERMISSAO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTELA = new TELA($TELA_id);
		$oPERMISSAO = new PERMISSAO($PERMISSAO_id);
		$oPERFIL = new PERFIL($PERFIL_id);
		$oTELAPERMISSAO = new TELAPERMISSAO($oTELA,$oPERMISSAO,$oPERFIL);
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();
		if(!$oTELAPERMISSAOBD->cadastrar($oTELAPERMISSAO)){
			$this->msg = $oTELAPERMISSAOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de TELAPERMISSAO
	 *
	 * @access public
	 * @param TELAPERMISSAO $oTELAPERMISSAO
	 * @return bool
	 */
	public function alterar($oTELAPERMISSAO = NULL){
		if($oTELAPERMISSAO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTELAPERMISSAO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTELAPERMISSAO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTELA = new TELA($TELA_id);
			$oPERMISSAO = new PERMISSAO($PERMISSAO_id);
			$oPERFIL = new PERFIL($PERFIL_id);
			$oTELAPERMISSAO = new TELAPERMISSAO($oTELA,$oPERMISSAO,$oPERFIL);
		}		
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();
		if(!$oTELAPERMISSAOBD->alterar($oTELAPERMISSAO)){
			$this->msg = $oTELAPERMISSAOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir TELAPERMISSAO
	 *
	 * @access public
	 * @param integer $idTELAPERMISSAO
	 * @return bool
	 */
	public function excluir($idTELAPERMISSAO){		
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();		
		if(!$oTELAPERMISSAOBD->excluir($idTELAPERMISSAO)){
			$this->msg = $oTELAPERMISSAOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de TELAPERMISSAO
	 *
	 * @access public

	 * @return TELAPERMISSAO
	 */
	public function get(){
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();
		if($oTELAPERMISSAOBD->msg != ''){
			$this->msg = $oTELAPERMISSAOBD->msg;
			return false;
		}
		if(!$obj = $oTELAPERMISSAOBD->get()){
		    $this->msg = $oTELAPERMISSAOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de TELAPERMISSAO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return TELAPERMISSAO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTELAPERMISSAOBD = new TELAPERMISSAOBD();
			$aux = $oTELAPERMISSAOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTELAPERMISSAOBD->msg != ''){
				$this->msg = $oTELAPERMISSAOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de TELAPERMISSAO
	 *
	 * @access public
	 * @param string $valor
	 * @return TELAPERMISSAO
	 */
	public function consultar($valor){
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();	
		return $oTELAPERMISSAOBD->consultar($valor);
	}

	/**
	 * Total de registros de TELAPERMISSAO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTELAPERMISSAOBD = new TELAPERMISSAOBD();
		return $oTELAPERMISSAOBD->totalColecao();
	}

}