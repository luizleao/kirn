<?php
class ControllerCODIGOACESSO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CODIGOACESSO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCODIGOACESSO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCODIGOACESSO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPESSOA = new PESSOA($PESSOA_id);
		$oCODIGOACESSO = new CODIGOACESSO($codigo,$oPESSOA);
		$oCODIGOACESSOBD = new CODIGOACESSOBD();
		if(!$oCODIGOACESSOBD->cadastrar($oCODIGOACESSO)){
			$this->msg = $oCODIGOACESSOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CODIGOACESSO
	 *
	 * @access public
	 * @param CODIGOACESSO $oCODIGOACESSO
	 * @return bool
	 */
	public function alterar($oCODIGOACESSO = NULL){
		if($oCODIGOACESSO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCODIGOACESSO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCODIGOACESSO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPESSOA = new PESSOA($PESSOA_id);
			$oCODIGOACESSO = new CODIGOACESSO($codigo,$oPESSOA);
		}		
		$oCODIGOACESSOBD = new CODIGOACESSOBD();
		if(!$oCODIGOACESSOBD->alterar($oCODIGOACESSO)){
			$this->msg = $oCODIGOACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CODIGOACESSO
	 *
	 * @access public
	 * @param integer $idCODIGOACESSO
	 * @return bool
	 */
	public function excluir($idCODIGOACESSO){		
		$oCODIGOACESSOBD = new CODIGOACESSOBD();		
		if(!$oCODIGOACESSOBD->excluir($idCODIGOACESSO)){
			$this->msg = $oCODIGOACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CODIGOACESSO
	 *
	 * @access public

	 * @return CODIGOACESSO
	 */
	public function get(){
		$oCODIGOACESSOBD = new CODIGOACESSOBD();
		if($oCODIGOACESSOBD->msg != ''){
			$this->msg = $oCODIGOACESSOBD->msg;
			return false;
		}
		if(!$obj = $oCODIGOACESSOBD->get()){
		    $this->msg = $oCODIGOACESSOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CODIGOACESSO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CODIGOACESSO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCODIGOACESSOBD = new CODIGOACESSOBD();
			$aux = $oCODIGOACESSOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCODIGOACESSOBD->msg != ''){
				$this->msg = $oCODIGOACESSOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CODIGOACESSO
	 *
	 * @access public
	 * @param string $valor
	 * @return CODIGOACESSO
	 */
	public function consultar($valor){
		$oCODIGOACESSOBD = new CODIGOACESSOBD();	
		return $oCODIGOACESSOBD->consultar($valor);
	}

	/**
	 * Total de registros de CODIGOACESSO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCODIGOACESSOBD = new CODIGOACESSOBD();
		return $oCODIGOACESSOBD->totalColecao();
	}

}