<?php
class ControllerSEMANA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar SEMANA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSEMANA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSEMANA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oSEMANA = new SEMANA($dia_semana,$oPERFILACESSO);
		$oSEMANABD = new SEMANABD();
		if(!$oSEMANABD->cadastrar($oSEMANA)){
			$this->msg = $oSEMANABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de SEMANA
	 *
	 * @access public
	 * @param SEMANA $oSEMANA
	 * @return bool
	 */
	public function alterar($oSEMANA = NULL){
		if($oSEMANA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSEMANA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSEMANA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oSEMANA = new SEMANA($dia_semana,$oPERFILACESSO);
		}		
		$oSEMANABD = new SEMANABD();
		if(!$oSEMANABD->alterar($oSEMANA)){
			$this->msg = $oSEMANABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir SEMANA
	 *
	 * @access public
	 * @param integer $idSEMANA
	 * @return bool
	 */
	public function excluir($idSEMANA){		
		$oSEMANABD = new SEMANABD();		
		if(!$oSEMANABD->excluir($idSEMANA)){
			$this->msg = $oSEMANABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de SEMANA
	 *
	 * @access public

	 * @return SEMANA
	 */
	public function get(){
		$oSEMANABD = new SEMANABD();
		if($oSEMANABD->msg != ''){
			$this->msg = $oSEMANABD->msg;
			return false;
		}
		if(!$obj = $oSEMANABD->get()){
		    $this->msg = $oSEMANABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de SEMANA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return SEMANA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSEMANABD = new SEMANABD();
			$aux = $oSEMANABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSEMANABD->msg != ''){
				$this->msg = $oSEMANABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de SEMANA
	 *
	 * @access public
	 * @param string $valor
	 * @return SEMANA
	 */
	public function consultar($valor){
		$oSEMANABD = new SEMANABD();	
		return $oSEMANABD->consultar($valor);
	}

	/**
	 * Total de registros de SEMANA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSEMANABD = new SEMANABD();
		return $oSEMANABD->totalColecao();
	}

}