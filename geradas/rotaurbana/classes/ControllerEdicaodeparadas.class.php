<?php
class ControllerEdicaodeparadas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Edicaodeparadas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formEdicaodeparadas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormEdicaodeparadas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oEdicaodeparadas = new Edicaodeparadas($cont,$oIndicador);
		$oEdicaodeparadasBD = new EdicaodeparadasBD();
		if(!$oEdicaodeparadasBD->cadastrar($oEdicaodeparadas)){
			$this->msg = $oEdicaodeparadasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Edicaodeparadas
	 *
	 * @access public
	 * @param Edicaodeparadas $oEdicaodeparadas
	 * @return bool
	 */
	public function alterar($oEdicaodeparadas = NULL){
		if($oEdicaodeparadas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formEdicaodeparadas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormEdicaodeparadas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oEdicaodeparadas = new Edicaodeparadas($cont,$oIndicador);
		}		
		$oEdicaodeparadasBD = new EdicaodeparadasBD();
		if(!$oEdicaodeparadasBD->alterar($oEdicaodeparadas)){
			$this->msg = $oEdicaodeparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Edicaodeparadas
	 *
	 * @access public
	 * @param integer $idEdicaodeparadas
	 * @return bool
	 */
	public function excluir($idEdicaodeparadas){		
		$oEdicaodeparadasBD = new EdicaodeparadasBD();		
		if(!$oEdicaodeparadasBD->excluir($idEdicaodeparadas)){
			$this->msg = $oEdicaodeparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Edicaodeparadas
	 *
	 * @access public
	 * @param integer $id
	 * @return Edicaodeparadas
	 */
	public function get($id){
		$oEdicaodeparadasBD = new EdicaodeparadasBD();
		if($oEdicaodeparadasBD->msg != ''){
			$this->msg = $oEdicaodeparadasBD->msg;
			return false;
		}
		if(!$obj = $oEdicaodeparadasBD->get($id)){
		    $this->msg = $oEdicaodeparadasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Edicaodeparadas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Edicaodeparadas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oEdicaodeparadasBD = new EdicaodeparadasBD();
			$aux = $oEdicaodeparadasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oEdicaodeparadasBD->msg != ''){
				$this->msg = $oEdicaodeparadasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Edicaodeparadas
	 *
	 * @access public
	 * @param string $valor
	 * @return Edicaodeparadas
	 */
	public function consultar($valor){
		$oEdicaodeparadasBD = new EdicaodeparadasBD();	
		return $oEdicaodeparadasBD->consultar($valor);
	}

	/**
	 * Total de registros de Edicaodeparadas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oEdicaodeparadasBD = new EdicaodeparadasBD();
		return $oEdicaodeparadasBD->totalColecao();
	}

}