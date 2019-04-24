<?php
class ControllerCLIENTE extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CLIENTE
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCLIENTE($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCLIENTE($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPESSOA = new PESSOA($PESSOA_id);
		$oENDERECO = new ENDERECO($ENDERECO_id);
		$oCLIENTE = new CLIENTE($id,$status,$oPESSOA,$oENDERECO);
		$oCLIENTEBD = new CLIENTEBD();
		if(!$oCLIENTEBD->cadastrar($oCLIENTE)){
			$this->msg = $oCLIENTEBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CLIENTE
	 *
	 * @access public
	 * @param CLIENTE $oCLIENTE
	 * @return bool
	 */
	public function alterar($oCLIENTE = NULL){
		if($oCLIENTE == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCLIENTE(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCLIENTE($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPESSOA = new PESSOA($PESSOA_id);
			$oENDERECO = new ENDERECO($ENDERECO_id);
			$oCLIENTE = new CLIENTE($id,$status,$oPESSOA,$oENDERECO);
		}		
		$oCLIENTEBD = new CLIENTEBD();
		if(!$oCLIENTEBD->alterar($oCLIENTE)){
			$this->msg = $oCLIENTEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CLIENTE
	 *
	 * @access public
	 * @param integer $idCLIENTE
	 * @return bool
	 */
	public function excluir($idCLIENTE){		
		$oCLIENTEBD = new CLIENTEBD();		
		if(!$oCLIENTEBD->excluir($idCLIENTE)){
			$this->msg = $oCLIENTEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CLIENTE
	 *
	 * @access public
	 * @param integer $id
	 * @return CLIENTE
	 */
	public function get($id){
		$oCLIENTEBD = new CLIENTEBD();
		if($oCLIENTEBD->msg != ''){
			$this->msg = $oCLIENTEBD->msg;
			return false;
		}
		if(!$obj = $oCLIENTEBD->get($id)){
		    $this->msg = $oCLIENTEBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CLIENTE
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CLIENTE[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCLIENTEBD = new CLIENTEBD();
			$aux = $oCLIENTEBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCLIENTEBD->msg != ''){
				$this->msg = $oCLIENTEBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CLIENTE
	 *
	 * @access public
	 * @param string $valor
	 * @return CLIENTE
	 */
	public function consultar($valor){
		$oCLIENTEBD = new CLIENTEBD();	
		return $oCLIENTEBD->consultar($valor);
	}

	/**
	 * Total de registros de CLIENTE
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCLIENTEBD = new CLIENTEBD();
		return $oCLIENTEBD->totalColecao();
	}

}