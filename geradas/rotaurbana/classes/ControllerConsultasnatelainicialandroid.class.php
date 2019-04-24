<?php
class ControllerConsultasnatelainicialandroid extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Consultasnatelainicialandroid
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formConsultasnatelainicialandroid($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormConsultasnatelainicialandroid($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oConsultasnatelainicialandroid = new Consultasnatelainicialandroid($id,$contador,$idAndroid);
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();
		if(!$oConsultasnatelainicialandroidBD->cadastrar($oConsultasnatelainicialandroid)){
			$this->msg = $oConsultasnatelainicialandroidBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Consultasnatelainicialandroid
	 *
	 * @access public
	 * @param Consultasnatelainicialandroid $oConsultasnatelainicialandroid
	 * @return bool
	 */
	public function alterar($oConsultasnatelainicialandroid = NULL){
		if($oConsultasnatelainicialandroid == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formConsultasnatelainicialandroid(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormConsultasnatelainicialandroid($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oConsultasnatelainicialandroid = new Consultasnatelainicialandroid($id,$contador,$idAndroid);
		}		
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();
		if(!$oConsultasnatelainicialandroidBD->alterar($oConsultasnatelainicialandroid)){
			$this->msg = $oConsultasnatelainicialandroidBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Consultasnatelainicialandroid
	 *
	 * @access public
	 * @param integer $idConsultasnatelainicialandroid
	 * @return bool
	 */
	public function excluir($idConsultasnatelainicialandroid){		
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();		
		if(!$oConsultasnatelainicialandroidBD->excluir($idConsultasnatelainicialandroid)){
			$this->msg = $oConsultasnatelainicialandroidBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Consultasnatelainicialandroid
	 *
	 * @access public
	 * @param integer $id
	 * @return Consultasnatelainicialandroid
	 */
	public function get($id){
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();
		if($oConsultasnatelainicialandroidBD->msg != ''){
			$this->msg = $oConsultasnatelainicialandroidBD->msg;
			return false;
		}
		if(!$obj = $oConsultasnatelainicialandroidBD->get($id)){
		    $this->msg = $oConsultasnatelainicialandroidBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Consultasnatelainicialandroid
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Consultasnatelainicialandroid[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();
			$aux = $oConsultasnatelainicialandroidBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oConsultasnatelainicialandroidBD->msg != ''){
				$this->msg = $oConsultasnatelainicialandroidBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Consultasnatelainicialandroid
	 *
	 * @access public
	 * @param string $valor
	 * @return Consultasnatelainicialandroid
	 */
	public function consultar($valor){
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();	
		return $oConsultasnatelainicialandroidBD->consultar($valor);
	}

	/**
	 * Total de registros de Consultasnatelainicialandroid
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oConsultasnatelainicialandroidBD = new ConsultasnatelainicialandroidBD();
		return $oConsultasnatelainicialandroidBD->totalColecao();
	}

}