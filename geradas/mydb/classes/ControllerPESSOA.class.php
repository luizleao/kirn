<?php
class ControllerPESSOA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PESSOA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPESSOA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPESSOA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oPESSOA = new PESSOA($id,$nome,$cpf,$nascimento,$oPERFILACESSO);
		$oPESSOABD = new PESSOABD();
		if(!$oPESSOABD->cadastrar($oPESSOA)){
			$this->msg = $oPESSOABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PESSOA
	 *
	 * @access public
	 * @param PESSOA $oPESSOA
	 * @return bool
	 */
	public function alterar($oPESSOA = NULL){
		if($oPESSOA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPESSOA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPESSOA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oPESSOA = new PESSOA($id,$nome,$cpf,$nascimento,$oPERFILACESSO);
		}		
		$oPESSOABD = new PESSOABD();
		if(!$oPESSOABD->alterar($oPESSOA)){
			$this->msg = $oPESSOABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PESSOA
	 *
	 * @access public
	 * @param integer $idPESSOA
	 * @return bool
	 */
	public function excluir($idPESSOA){		
		$oPESSOABD = new PESSOABD();		
		if(!$oPESSOABD->excluir($idPESSOA)){
			$this->msg = $oPESSOABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PESSOA
	 *
	 * @access public
	 * @param integer $id
	 * @return PESSOA
	 */
	public function get($id){
		$oPESSOABD = new PESSOABD();
		if($oPESSOABD->msg != ''){
			$this->msg = $oPESSOABD->msg;
			return false;
		}
		if(!$obj = $oPESSOABD->get($id)){
		    $this->msg = $oPESSOABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PESSOA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PESSOA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPESSOABD = new PESSOABD();
			$aux = $oPESSOABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPESSOABD->msg != ''){
				$this->msg = $oPESSOABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PESSOA
	 *
	 * @access public
	 * @param string $valor
	 * @return PESSOA
	 */
	public function consultar($valor){
		$oPESSOABD = new PESSOABD();	
		return $oPESSOABD->consultar($valor);
	}

	/**
	 * Total de registros de PESSOA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPESSOABD = new PESSOABD();
		return $oPESSOABD->totalColecao();
	}

}