<?php
class ControllerEVENTOS INTERNOS extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar EVENTOS INTERNOS
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formEVENTOS INTERNOS($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormEVENTOS INTERNOS($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oEVENTOS INTERNOS = new EVENTOS INTERNOS();
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();
		if(!$oEVENTOS INTERNOSBD->cadastrar($oEVENTOS INTERNOS)){
			$this->msg = $oEVENTOS INTERNOSBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de EVENTOS INTERNOS
	 *
	 * @access public
	 * @param EVENTOS INTERNOS $oEVENTOS INTERNOS
	 * @return bool
	 */
	public function alterar($oEVENTOS INTERNOS = NULL){
		if($oEVENTOS INTERNOS == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formEVENTOS INTERNOS(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormEVENTOS INTERNOS($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oEVENTOS INTERNOS = new EVENTOS INTERNOS();
		}		
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();
		if(!$oEVENTOS INTERNOSBD->alterar($oEVENTOS INTERNOS)){
			$this->msg = $oEVENTOS INTERNOSBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir EVENTOS INTERNOS
	 *
	 * @access public
	 * @param integer $idEVENTOS INTERNOS
	 * @return bool
	 */
	public function excluir($idEVENTOS INTERNOS){		
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();		
		if(!$oEVENTOS INTERNOSBD->excluir($idEVENTOS INTERNOS)){
			$this->msg = $oEVENTOS INTERNOSBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de EVENTOS INTERNOS
	 *
	 * @access public

	 * @return EVENTOS INTERNOS
	 */
	public function get(){
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();
		if($oEVENTOS INTERNOSBD->msg != ''){
			$this->msg = $oEVENTOS INTERNOSBD->msg;
			return false;
		}
		if(!$obj = $oEVENTOS INTERNOSBD->get()){
		    $this->msg = $oEVENTOS INTERNOSBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de EVENTOS INTERNOS
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return EVENTOS INTERNOS[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();
			$aux = $oEVENTOS INTERNOSBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oEVENTOS INTERNOSBD->msg != ''){
				$this->msg = $oEVENTOS INTERNOSBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de EVENTOS INTERNOS
	 *
	 * @access public
	 * @param string $valor
	 * @return EVENTOS INTERNOS
	 */
	public function consultar($valor){
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();	
		return $oEVENTOS INTERNOSBD->consultar($valor);
	}

	/**
	 * Total de registros de EVENTOS INTERNOS
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oEVENTOS INTERNOSBD = new EVENTOS INTERNOSBD();
		return $oEVENTOS INTERNOSBD->totalColecao();
	}

}