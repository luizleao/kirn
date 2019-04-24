<?php
class ControllerConsultanatelainicial extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Consultanatelainicial
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formConsultanatelainicial($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormConsultanatelainicial($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oConsultanatelainicial = new Consultanatelainicial($cont,$oIndicador);
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();
		if(!$oConsultanatelainicialBD->cadastrar($oConsultanatelainicial)){
			$this->msg = $oConsultanatelainicialBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Consultanatelainicial
	 *
	 * @access public
	 * @param Consultanatelainicial $oConsultanatelainicial
	 * @return bool
	 */
	public function alterar($oConsultanatelainicial = NULL){
		if($oConsultanatelainicial == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formConsultanatelainicial(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormConsultanatelainicial($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oConsultanatelainicial = new Consultanatelainicial($cont,$oIndicador);
		}		
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();
		if(!$oConsultanatelainicialBD->alterar($oConsultanatelainicial)){
			$this->msg = $oConsultanatelainicialBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Consultanatelainicial
	 *
	 * @access public
	 * @param integer $idConsultanatelainicial
	 * @return bool
	 */
	public function excluir($idConsultanatelainicial){		
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();		
		if(!$oConsultanatelainicialBD->excluir($idConsultanatelainicial)){
			$this->msg = $oConsultanatelainicialBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Consultanatelainicial
	 *
	 * @access public
	 * @param integer $id
	 * @return Consultanatelainicial
	 */
	public function get($id){
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();
		if($oConsultanatelainicialBD->msg != ''){
			$this->msg = $oConsultanatelainicialBD->msg;
			return false;
		}
		if(!$obj = $oConsultanatelainicialBD->get($id)){
		    $this->msg = $oConsultanatelainicialBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Consultanatelainicial
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Consultanatelainicial[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oConsultanatelainicialBD = new ConsultanatelainicialBD();
			$aux = $oConsultanatelainicialBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oConsultanatelainicialBD->msg != ''){
				$this->msg = $oConsultanatelainicialBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Consultanatelainicial
	 *
	 * @access public
	 * @param string $valor
	 * @return Consultanatelainicial
	 */
	public function consultar($valor){
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();	
		return $oConsultanatelainicialBD->consultar($valor);
	}

	/**
	 * Total de registros de Consultanatelainicial
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oConsultanatelainicialBD = new ConsultanatelainicialBD();
		return $oConsultanatelainicialBD->totalColecao();
	}

}