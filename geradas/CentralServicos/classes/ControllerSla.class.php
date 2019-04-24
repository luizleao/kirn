<?php
class ControllerSla extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Sla
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSla($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSla($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSla = new Sla($idSla,$descricao,$status);
		$oSlaBD = new SlaBD();
		if(!$oSlaBD->cadastrar($oSla)){
			$this->msg = $oSlaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Sla
	 *
	 * @access public
	 * @param Sla $oSla
	 * @return bool
	 */
	public function alterar($oSla = NULL){
		if($oSla == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSla(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSla($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSla = new Sla($idSla,$descricao,$status);
		}		
		$oSlaBD = new SlaBD();
		if(!$oSlaBD->alterar($oSla)){
			$this->msg = $oSlaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Sla
	 *
	 * @access public
	 * @param integer $idSla
	 * @return bool
	 */
	public function excluir($idSla){		
		$oSlaBD = new SlaBD();		
		if(!$oSlaBD->excluir($idSla)){
			$this->msg = $oSlaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Sla
	 *
	 * @access public
	 * @param integer $idSla
	 * @return Sla
	 */
	public function get($idSla){
		$oSlaBD = new SlaBD();
		if($oSlaBD->msg != ''){
			$this->msg = $oSlaBD->msg;
			return false;
		}
		if(!$obj = $oSlaBD->get($idSla)){
		    $this->msg = $oSlaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Sla
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Sla[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSlaBD = new SlaBD();
			$aux = $oSlaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSlaBD->msg != ''){
				$this->msg = $oSlaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Sla
	 *
	 * @access public
	 * @param string $valor
	 * @return Sla
	 */
	public function consultar($valor){
		$oSlaBD = new SlaBD();	
		return $oSlaBD->consultar($valor);
	}

	/**
	 * Total de registros de Sla
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSlaBD = new SlaBD();
		return $oSlaBD->totalColecao();
	}

}