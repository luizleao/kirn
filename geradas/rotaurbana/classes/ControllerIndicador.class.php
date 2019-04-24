<?php
class ControllerIndicador extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Indicador
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formIndicador($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormIndicador($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oIndicadorBD = new IndicadorBD();
		if(!$oIndicadorBD->cadastrar($oIndicador)){
			$this->msg = $oIndicadorBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Indicador
	 *
	 * @access public
	 * @param Indicador $oIndicador
	 * @return bool
	 */
	public function alterar($oIndicador = NULL){
		if($oIndicador == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formIndicador(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormIndicador($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
		}		
		$oIndicadorBD = new IndicadorBD();
		if(!$oIndicadorBD->alterar($oIndicador)){
			$this->msg = $oIndicadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Indicador
	 *
	 * @access public
	 * @param integer $idIndicador
	 * @return bool
	 */
	public function excluir($idIndicador){		
		$oIndicadorBD = new IndicadorBD();		
		if(!$oIndicadorBD->excluir($idIndicador)){
			$this->msg = $oIndicadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Indicador
	 *
	 * @access public
	 * @param integer $id
	 * @return Indicador
	 */
	public function get($id){
		$oIndicadorBD = new IndicadorBD();
		if($oIndicadorBD->msg != ''){
			$this->msg = $oIndicadorBD->msg;
			return false;
		}
		if(!$obj = $oIndicadorBD->get($id)){
		    $this->msg = $oIndicadorBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Indicador
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Indicador[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oIndicadorBD = new IndicadorBD();
			$aux = $oIndicadorBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oIndicadorBD->msg != ''){
				$this->msg = $oIndicadorBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Indicador
	 *
	 * @access public
	 * @param string $valor
	 * @return Indicador
	 */
	public function consultar($valor){
		$oIndicadorBD = new IndicadorBD();	
		return $oIndicadorBD->consultar($valor);
	}

	/**
	 * Total de registros de Indicador
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oIndicadorBD = new IndicadorBD();
		return $oIndicadorBD->totalColecao();
	}

}