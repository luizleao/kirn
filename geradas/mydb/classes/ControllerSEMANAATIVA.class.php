<?php
class ControllerSEMANAATIVA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar SEMANAATIVA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSEMANAATIVA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSEMANAATIVA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oSEMANAATIVA = new SEMANAATIVA($semana,$oPERFILACESSO);
		$oSEMANAATIVABD = new SEMANAATIVABD();
		if(!$oSEMANAATIVABD->cadastrar($oSEMANAATIVA)){
			$this->msg = $oSEMANAATIVABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de SEMANAATIVA
	 *
	 * @access public
	 * @param SEMANAATIVA $oSEMANAATIVA
	 * @return bool
	 */
	public function alterar($oSEMANAATIVA = NULL){
		if($oSEMANAATIVA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSEMANAATIVA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSEMANAATIVA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oSEMANAATIVA = new SEMANAATIVA($semana,$oPERFILACESSO);
		}		
		$oSEMANAATIVABD = new SEMANAATIVABD();
		if(!$oSEMANAATIVABD->alterar($oSEMANAATIVA)){
			$this->msg = $oSEMANAATIVABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir SEMANAATIVA
	 *
	 * @access public
	 * @param integer $idSEMANAATIVA
	 * @return bool
	 */
	public function excluir($idSEMANAATIVA){		
		$oSEMANAATIVABD = new SEMANAATIVABD();		
		if(!$oSEMANAATIVABD->excluir($idSEMANAATIVA)){
			$this->msg = $oSEMANAATIVABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de SEMANAATIVA
	 *
	 * @access public

	 * @return SEMANAATIVA
	 */
	public function get(){
		$oSEMANAATIVABD = new SEMANAATIVABD();
		if($oSEMANAATIVABD->msg != ''){
			$this->msg = $oSEMANAATIVABD->msg;
			return false;
		}
		if(!$obj = $oSEMANAATIVABD->get()){
		    $this->msg = $oSEMANAATIVABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de SEMANAATIVA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return SEMANAATIVA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSEMANAATIVABD = new SEMANAATIVABD();
			$aux = $oSEMANAATIVABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSEMANAATIVABD->msg != ''){
				$this->msg = $oSEMANAATIVABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de SEMANAATIVA
	 *
	 * @access public
	 * @param string $valor
	 * @return SEMANAATIVA
	 */
	public function consultar($valor){
		$oSEMANAATIVABD = new SEMANAATIVABD();	
		return $oSEMANAATIVABD->consultar($valor);
	}

	/**
	 * Total de registros de SEMANAATIVA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSEMANAATIVABD = new SEMANAATIVABD();
		return $oSEMANAATIVABD->totalColecao();
	}

}