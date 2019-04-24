<?php
class ControllerPERFILACESSO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PERFILACESSO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPERFILACESSO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPERFILACESSO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($id,$nome,$se_semana);
		$oPERFILACESSOBD = new PERFILACESSOBD();
		if(!$oPERFILACESSOBD->cadastrar($oPERFILACESSO)){
			$this->msg = $oPERFILACESSOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PERFILACESSO
	 *
	 * @access public
	 * @param PERFILACESSO $oPERFILACESSO
	 * @return bool
	 */
	public function alterar($oPERFILACESSO = NULL){
		if($oPERFILACESSO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPERFILACESSO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPERFILACESSO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($id,$nome,$se_semana);
		}		
		$oPERFILACESSOBD = new PERFILACESSOBD();
		if(!$oPERFILACESSOBD->alterar($oPERFILACESSO)){
			$this->msg = $oPERFILACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PERFILACESSO
	 *
	 * @access public
	 * @param integer $idPERFILACESSO
	 * @return bool
	 */
	public function excluir($idPERFILACESSO){		
		$oPERFILACESSOBD = new PERFILACESSOBD();		
		if(!$oPERFILACESSOBD->excluir($idPERFILACESSO)){
			$this->msg = $oPERFILACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PERFILACESSO
	 *
	 * @access public
	 * @param integer $id
	 * @return PERFILACESSO
	 */
	public function get($id){
		$oPERFILACESSOBD = new PERFILACESSOBD();
		if($oPERFILACESSOBD->msg != ''){
			$this->msg = $oPERFILACESSOBD->msg;
			return false;
		}
		if(!$obj = $oPERFILACESSOBD->get($id)){
		    $this->msg = $oPERFILACESSOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PERFILACESSO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PERFILACESSO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPERFILACESSOBD = new PERFILACESSOBD();
			$aux = $oPERFILACESSOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPERFILACESSOBD->msg != ''){
				$this->msg = $oPERFILACESSOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PERFILACESSO
	 *
	 * @access public
	 * @param string $valor
	 * @return PERFILACESSO
	 */
	public function consultar($valor){
		$oPERFILACESSOBD = new PERFILACESSOBD();	
		return $oPERFILACESSOBD->consultar($valor);
	}

	/**
	 * Total de registros de PERFILACESSO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPERFILACESSOBD = new PERFILACESSOBD();
		return $oPERFILACESSOBD->totalColecao();
	}

}