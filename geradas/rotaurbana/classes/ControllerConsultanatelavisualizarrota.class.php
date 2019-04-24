<?php
class ControllerConsultanatelavisualizarrota extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Consultanatelavisualizarrota
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formConsultanatelavisualizarrota($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormConsultanatelavisualizarrota($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oConsultanatelavisualizarrota = new Consultanatelavisualizarrota($cont,$oIndicador);
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();
		if(!$oConsultanatelavisualizarrotaBD->cadastrar($oConsultanatelavisualizarrota)){
			$this->msg = $oConsultanatelavisualizarrotaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Consultanatelavisualizarrota
	 *
	 * @access public
	 * @param Consultanatelavisualizarrota $oConsultanatelavisualizarrota
	 * @return bool
	 */
	public function alterar($oConsultanatelavisualizarrota = NULL){
		if($oConsultanatelavisualizarrota == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formConsultanatelavisualizarrota(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormConsultanatelavisualizarrota($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oConsultanatelavisualizarrota = new Consultanatelavisualizarrota($cont,$oIndicador);
		}		
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();
		if(!$oConsultanatelavisualizarrotaBD->alterar($oConsultanatelavisualizarrota)){
			$this->msg = $oConsultanatelavisualizarrotaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Consultanatelavisualizarrota
	 *
	 * @access public
	 * @param integer $idConsultanatelavisualizarrota
	 * @return bool
	 */
	public function excluir($idConsultanatelavisualizarrota){		
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();		
		if(!$oConsultanatelavisualizarrotaBD->excluir($idConsultanatelavisualizarrota)){
			$this->msg = $oConsultanatelavisualizarrotaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Consultanatelavisualizarrota
	 *
	 * @access public
	 * @param integer $id
	 * @return Consultanatelavisualizarrota
	 */
	public function get($id){
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();
		if($oConsultanatelavisualizarrotaBD->msg != ''){
			$this->msg = $oConsultanatelavisualizarrotaBD->msg;
			return false;
		}
		if(!$obj = $oConsultanatelavisualizarrotaBD->get($id)){
		    $this->msg = $oConsultanatelavisualizarrotaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Consultanatelavisualizarrota
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Consultanatelavisualizarrota[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();
			$aux = $oConsultanatelavisualizarrotaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oConsultanatelavisualizarrotaBD->msg != ''){
				$this->msg = $oConsultanatelavisualizarrotaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Consultanatelavisualizarrota
	 *
	 * @access public
	 * @param string $valor
	 * @return Consultanatelavisualizarrota
	 */
	public function consultar($valor){
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();	
		return $oConsultanatelavisualizarrotaBD->consultar($valor);
	}

	/**
	 * Total de registros de Consultanatelavisualizarrota
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oConsultanatelavisualizarrotaBD = new ConsultanatelavisualizarrotaBD();
		return $oConsultanatelavisualizarrotaBD->totalColecao();
	}

}