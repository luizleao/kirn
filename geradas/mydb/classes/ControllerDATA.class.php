<?php
class ControllerDATA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar DATA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formDATA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormDATA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oDATA = new DATA($data_inicio,$data_fim,$oPERFILACESSO);
		$oDATABD = new DATABD();
		if(!$oDATABD->cadastrar($oDATA)){
			$this->msg = $oDATABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de DATA
	 *
	 * @access public
	 * @param DATA $oDATA
	 * @return bool
	 */
	public function alterar($oDATA = NULL){
		if($oDATA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formDATA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormDATA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oDATA = new DATA($data_inicio,$data_fim,$oPERFILACESSO);
		}		
		$oDATABD = new DATABD();
		if(!$oDATABD->alterar($oDATA)){
			$this->msg = $oDATABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir DATA
	 *
	 * @access public
	 * @param integer $idDATA
	 * @return bool
	 */
	public function excluir($idDATA){		
		$oDATABD = new DATABD();		
		if(!$oDATABD->excluir($idDATA)){
			$this->msg = $oDATABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de DATA
	 *
	 * @access public

	 * @return DATA
	 */
	public function get(){
		$oDATABD = new DATABD();
		if($oDATABD->msg != ''){
			$this->msg = $oDATABD->msg;
			return false;
		}
		if(!$obj = $oDATABD->get()){
		    $this->msg = $oDATABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de DATA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return DATA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oDATABD = new DATABD();
			$aux = $oDATABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oDATABD->msg != ''){
				$this->msg = $oDATABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de DATA
	 *
	 * @access public
	 * @param string $valor
	 * @return DATA
	 */
	public function consultar($valor){
		$oDATABD = new DATABD();	
		return $oDATABD->consultar($valor);
	}

	/**
	 * Total de registros de DATA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oDATABD = new DATABD();
		return $oDATABD->totalColecao();
	}

}