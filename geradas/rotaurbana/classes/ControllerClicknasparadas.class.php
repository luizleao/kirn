<?php
class ControllerClicknasparadas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Clicknasparadas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formClicknasparadas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormClicknasparadas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oClicknasparadas = new Clicknasparadas($cont,$oIndicador);
		$oClicknasparadasBD = new ClicknasparadasBD();
		if(!$oClicknasparadasBD->cadastrar($oClicknasparadas)){
			$this->msg = $oClicknasparadasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Clicknasparadas
	 *
	 * @access public
	 * @param Clicknasparadas $oClicknasparadas
	 * @return bool
	 */
	public function alterar($oClicknasparadas = NULL){
		if($oClicknasparadas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formClicknasparadas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormClicknasparadas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oClicknasparadas = new Clicknasparadas($cont,$oIndicador);
		}		
		$oClicknasparadasBD = new ClicknasparadasBD();
		if(!$oClicknasparadasBD->alterar($oClicknasparadas)){
			$this->msg = $oClicknasparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Clicknasparadas
	 *
	 * @access public
	 * @param integer $idClicknasparadas
	 * @return bool
	 */
	public function excluir($idClicknasparadas){		
		$oClicknasparadasBD = new ClicknasparadasBD();		
		if(!$oClicknasparadasBD->excluir($idClicknasparadas)){
			$this->msg = $oClicknasparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Clicknasparadas
	 *
	 * @access public
	 * @param integer $id
	 * @return Clicknasparadas
	 */
	public function get($id){
		$oClicknasparadasBD = new ClicknasparadasBD();
		if($oClicknasparadasBD->msg != ''){
			$this->msg = $oClicknasparadasBD->msg;
			return false;
		}
		if(!$obj = $oClicknasparadasBD->get($id)){
		    $this->msg = $oClicknasparadasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Clicknasparadas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Clicknasparadas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oClicknasparadasBD = new ClicknasparadasBD();
			$aux = $oClicknasparadasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oClicknasparadasBD->msg != ''){
				$this->msg = $oClicknasparadasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Clicknasparadas
	 *
	 * @access public
	 * @param string $valor
	 * @return Clicknasparadas
	 */
	public function consultar($valor){
		$oClicknasparadasBD = new ClicknasparadasBD();	
		return $oClicknasparadasBD->consultar($valor);
	}

	/**
	 * Total de registros de Clicknasparadas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oClicknasparadasBD = new ClicknasparadasBD();
		return $oClicknasparadasBD->totalColecao();
	}

}