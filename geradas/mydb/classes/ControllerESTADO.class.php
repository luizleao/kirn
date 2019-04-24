<?php
class ControllerESTADO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar ESTADO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formESTADO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormESTADO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPAIS = new PAIS($PAIS_id);
		$oESTADO = new ESTADO($id,$nome,$oPAIS,$uf);
		$oESTADOBD = new ESTADOBD();
		if(!$oESTADOBD->cadastrar($oESTADO)){
			$this->msg = $oESTADOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de ESTADO
	 *
	 * @access public
	 * @param ESTADO $oESTADO
	 * @return bool
	 */
	public function alterar($oESTADO = NULL){
		if($oESTADO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formESTADO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormESTADO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPAIS = new PAIS($PAIS_id);
			$oESTADO = new ESTADO($id,$nome,$oPAIS,$uf);
		}		
		$oESTADOBD = new ESTADOBD();
		if(!$oESTADOBD->alterar($oESTADO)){
			$this->msg = $oESTADOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir ESTADO
	 *
	 * @access public
	 * @param integer $idESTADO
	 * @return bool
	 */
	public function excluir($idESTADO){		
		$oESTADOBD = new ESTADOBD();		
		if(!$oESTADOBD->excluir($idESTADO)){
			$this->msg = $oESTADOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de ESTADO
	 *
	 * @access public
	 * @param integer $id
	 * @return ESTADO
	 */
	public function get($id){
		$oESTADOBD = new ESTADOBD();
		if($oESTADOBD->msg != ''){
			$this->msg = $oESTADOBD->msg;
			return false;
		}
		if(!$obj = $oESTADOBD->get($id)){
		    $this->msg = $oESTADOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de ESTADO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return ESTADO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oESTADOBD = new ESTADOBD();
			$aux = $oESTADOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oESTADOBD->msg != ''){
				$this->msg = $oESTADOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de ESTADO
	 *
	 * @access public
	 * @param string $valor
	 * @return ESTADO
	 */
	public function consultar($valor){
		$oESTADOBD = new ESTADOBD();	
		return $oESTADOBD->consultar($valor);
	}

	/**
	 * Total de registros de ESTADO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oESTADOBD = new ESTADOBD();
		return $oESTADOBD->totalColecao();
	}

}