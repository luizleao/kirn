<?php
class ControllerCadastrodeparadas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Cadastrodeparadas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCadastrodeparadas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCadastrodeparadas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oCadastrodeparadas = new Cadastrodeparadas($cont,$oIndicador);
		$oCadastrodeparadasBD = new CadastrodeparadasBD();
		if(!$oCadastrodeparadasBD->cadastrar($oCadastrodeparadas)){
			$this->msg = $oCadastrodeparadasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Cadastrodeparadas
	 *
	 * @access public
	 * @param Cadastrodeparadas $oCadastrodeparadas
	 * @return bool
	 */
	public function alterar($oCadastrodeparadas = NULL){
		if($oCadastrodeparadas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCadastrodeparadas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCadastrodeparadas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oCadastrodeparadas = new Cadastrodeparadas($cont,$oIndicador);
		}		
		$oCadastrodeparadasBD = new CadastrodeparadasBD();
		if(!$oCadastrodeparadasBD->alterar($oCadastrodeparadas)){
			$this->msg = $oCadastrodeparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Cadastrodeparadas
	 *
	 * @access public
	 * @param integer $idCadastrodeparadas
	 * @return bool
	 */
	public function excluir($idCadastrodeparadas){		
		$oCadastrodeparadasBD = new CadastrodeparadasBD();		
		if(!$oCadastrodeparadasBD->excluir($idCadastrodeparadas)){
			$this->msg = $oCadastrodeparadasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Cadastrodeparadas
	 *
	 * @access public
	 * @param integer $id
	 * @return Cadastrodeparadas
	 */
	public function get($id){
		$oCadastrodeparadasBD = new CadastrodeparadasBD();
		if($oCadastrodeparadasBD->msg != ''){
			$this->msg = $oCadastrodeparadasBD->msg;
			return false;
		}
		if(!$obj = $oCadastrodeparadasBD->get($id)){
		    $this->msg = $oCadastrodeparadasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Cadastrodeparadas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Cadastrodeparadas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCadastrodeparadasBD = new CadastrodeparadasBD();
			$aux = $oCadastrodeparadasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCadastrodeparadasBD->msg != ''){
				$this->msg = $oCadastrodeparadasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Cadastrodeparadas
	 *
	 * @access public
	 * @param string $valor
	 * @return Cadastrodeparadas
	 */
	public function consultar($valor){
		$oCadastrodeparadasBD = new CadastrodeparadasBD();	
		return $oCadastrodeparadasBD->consultar($valor);
	}

	/**
	 * Total de registros de Cadastrodeparadas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCadastrodeparadasBD = new CadastrodeparadasBD();
		return $oCadastrodeparadasBD->totalColecao();
	}

}