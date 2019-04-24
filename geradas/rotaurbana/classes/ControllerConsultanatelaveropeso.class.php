<?php
class ControllerConsultanatelaveropeso extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Consultanatelaveropeso
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formConsultanatelaveropeso($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormConsultanatelaveropeso($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oConsultanatelaveropeso = new Consultanatelaveropeso($cont,$oIndicador);
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();
		if(!$oConsultanatelaveropesoBD->cadastrar($oConsultanatelaveropeso)){
			$this->msg = $oConsultanatelaveropesoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Consultanatelaveropeso
	 *
	 * @access public
	 * @param Consultanatelaveropeso $oConsultanatelaveropeso
	 * @return bool
	 */
	public function alterar($oConsultanatelaveropeso = NULL){
		if($oConsultanatelaveropeso == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formConsultanatelaveropeso(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormConsultanatelaveropeso($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oConsultanatelaveropeso = new Consultanatelaveropeso($cont,$oIndicador);
		}		
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();
		if(!$oConsultanatelaveropesoBD->alterar($oConsultanatelaveropeso)){
			$this->msg = $oConsultanatelaveropesoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Consultanatelaveropeso
	 *
	 * @access public
	 * @param integer $idConsultanatelaveropeso
	 * @return bool
	 */
	public function excluir($idConsultanatelaveropeso){		
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();		
		if(!$oConsultanatelaveropesoBD->excluir($idConsultanatelaveropeso)){
			$this->msg = $oConsultanatelaveropesoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Consultanatelaveropeso
	 *
	 * @access public
	 * @param integer $id
	 * @return Consultanatelaveropeso
	 */
	public function get($id){
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();
		if($oConsultanatelaveropesoBD->msg != ''){
			$this->msg = $oConsultanatelaveropesoBD->msg;
			return false;
		}
		if(!$obj = $oConsultanatelaveropesoBD->get($id)){
		    $this->msg = $oConsultanatelaveropesoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Consultanatelaveropeso
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Consultanatelaveropeso[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();
			$aux = $oConsultanatelaveropesoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oConsultanatelaveropesoBD->msg != ''){
				$this->msg = $oConsultanatelaveropesoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Consultanatelaveropeso
	 *
	 * @access public
	 * @param string $valor
	 * @return Consultanatelaveropeso
	 */
	public function consultar($valor){
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();	
		return $oConsultanatelaveropesoBD->consultar($valor);
	}

	/**
	 * Total de registros de Consultanatelaveropeso
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oConsultanatelaveropesoBD = new ConsultanatelaveropesoBD();
		return $oConsultanatelaveropesoBD->totalColecao();
	}

}