<?php
class ControllerPAIS extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PAIS
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPAIS($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPAIS($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPAIS = new PAIS($id,$nome,$sigla);
		$oPAISBD = new PAISBD();
		if(!$oPAISBD->cadastrar($oPAIS)){
			$this->msg = $oPAISBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PAIS
	 *
	 * @access public
	 * @param PAIS $oPAIS
	 * @return bool
	 */
	public function alterar($oPAIS = NULL){
		if($oPAIS == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPAIS(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPAIS($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPAIS = new PAIS($id,$nome,$sigla);
		}		
		$oPAISBD = new PAISBD();
		if(!$oPAISBD->alterar($oPAIS)){
			$this->msg = $oPAISBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PAIS
	 *
	 * @access public
	 * @param integer $idPAIS
	 * @return bool
	 */
	public function excluir($idPAIS){		
		$oPAISBD = new PAISBD();		
		if(!$oPAISBD->excluir($idPAIS)){
			$this->msg = $oPAISBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PAIS
	 *
	 * @access public
	 * @param integer $id
	 * @return PAIS
	 */
	public function get($id){
		$oPAISBD = new PAISBD();
		if($oPAISBD->msg != ''){
			$this->msg = $oPAISBD->msg;
			return false;
		}
		if(!$obj = $oPAISBD->get($id)){
		    $this->msg = $oPAISBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PAIS
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PAIS[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPAISBD = new PAISBD();
			$aux = $oPAISBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPAISBD->msg != ''){
				$this->msg = $oPAISBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PAIS
	 *
	 * @access public
	 * @param string $valor
	 * @return PAIS
	 */
	public function consultar($valor){
		$oPAISBD = new PAISBD();	
		return $oPAISBD->consultar($valor);
	}

	/**
	 * Total de registros de PAIS
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPAISBD = new PAISBD();
		return $oPAISBD->totalColecao();
	}

}