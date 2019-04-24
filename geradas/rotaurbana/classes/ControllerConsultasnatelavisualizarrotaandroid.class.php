<?php
class ControllerConsultasnatelavisualizarrotaandroid extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formConsultasnatelavisualizarrotaandroid($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormConsultasnatelavisualizarrotaandroid($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oConsultasnatelavisualizarrotaandroid = new Consultasnatelavisualizarrotaandroid($id,$contador,$idAndroid);
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();
		if(!$oConsultasnatelavisualizarrotaandroidBD->cadastrar($oConsultasnatelavisualizarrotaandroid)){
			$this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @param Consultasnatelavisualizarrotaandroid $oConsultasnatelavisualizarrotaandroid
	 * @return bool
	 */
	public function alterar($oConsultasnatelavisualizarrotaandroid = NULL){
		if($oConsultasnatelavisualizarrotaandroid == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formConsultasnatelavisualizarrotaandroid(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormConsultasnatelavisualizarrotaandroid($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oConsultasnatelavisualizarrotaandroid = new Consultasnatelavisualizarrotaandroid($id,$contador,$idAndroid);
		}		
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();
		if(!$oConsultasnatelavisualizarrotaandroidBD->alterar($oConsultasnatelavisualizarrotaandroid)){
			$this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @param integer $idConsultasnatelavisualizarrotaandroid
	 * @return bool
	 */
	public function excluir($idConsultasnatelavisualizarrotaandroid){		
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();		
		if(!$oConsultasnatelavisualizarrotaandroidBD->excluir($idConsultasnatelavisualizarrotaandroid)){
			$this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @param integer $id
	 * @return Consultasnatelavisualizarrotaandroid
	 */
	public function get($id){
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();
		if($oConsultasnatelavisualizarrotaandroidBD->msg != ''){
			$this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
			return false;
		}
		if(!$obj = $oConsultasnatelavisualizarrotaandroidBD->get($id)){
		    $this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Consultasnatelavisualizarrotaandroid[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();
			$aux = $oConsultasnatelavisualizarrotaandroidBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oConsultasnatelavisualizarrotaandroidBD->msg != ''){
				$this->msg = $oConsultasnatelavisualizarrotaandroidBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @param string $valor
	 * @return Consultasnatelavisualizarrotaandroid
	 */
	public function consultar($valor){
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();	
		return $oConsultasnatelavisualizarrotaandroidBD->consultar($valor);
	}

	/**
	 * Total de registros de Consultasnatelavisualizarrotaandroid
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oConsultasnatelavisualizarrotaandroidBD = new ConsultasnatelavisualizarrotaandroidBD();
		return $oConsultasnatelavisualizarrotaandroidBD->totalColecao();
	}

}