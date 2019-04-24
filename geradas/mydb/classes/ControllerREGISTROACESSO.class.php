<?php
class ControllerREGISTROACESSO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar REGISTROACESSO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formREGISTROACESSO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormREGISTROACESSO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPESSOA = new PESSOA($PESSOA_id);
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oREGISTROACESSO = new REGISTROACESSO($id,$data,$hora,$sentido,$permissao,$oPESSOA,$oPERFILACESSO);
		$oREGISTROACESSOBD = new REGISTROACESSOBD();
		if(!$oREGISTROACESSOBD->cadastrar($oREGISTROACESSO)){
			$this->msg = $oREGISTROACESSOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de REGISTROACESSO
	 *
	 * @access public
	 * @param REGISTROACESSO $oREGISTROACESSO
	 * @return bool
	 */
	public function alterar($oREGISTROACESSO = NULL){
		if($oREGISTROACESSO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formREGISTROACESSO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormREGISTROACESSO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPESSOA = new PESSOA($PESSOA_id);
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oREGISTROACESSO = new REGISTROACESSO($id,$data,$hora,$sentido,$permissao,$oPESSOA,$oPERFILACESSO);
		}		
		$oREGISTROACESSOBD = new REGISTROACESSOBD();
		if(!$oREGISTROACESSOBD->alterar($oREGISTROACESSO)){
			$this->msg = $oREGISTROACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir REGISTROACESSO
	 *
	 * @access public
	 * @param integer $idREGISTROACESSO
	 * @return bool
	 */
	public function excluir($idREGISTROACESSO){		
		$oREGISTROACESSOBD = new REGISTROACESSOBD();		
		if(!$oREGISTROACESSOBD->excluir($idREGISTROACESSO)){
			$this->msg = $oREGISTROACESSOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de REGISTROACESSO
	 *
	 * @access public
	 * @param integer $id
	 * @return REGISTROACESSO
	 */
	public function get($id){
		$oREGISTROACESSOBD = new REGISTROACESSOBD();
		if($oREGISTROACESSOBD->msg != ''){
			$this->msg = $oREGISTROACESSOBD->msg;
			return false;
		}
		if(!$obj = $oREGISTROACESSOBD->get($id)){
		    $this->msg = $oREGISTROACESSOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de REGISTROACESSO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return REGISTROACESSO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oREGISTROACESSOBD = new REGISTROACESSOBD();
			$aux = $oREGISTROACESSOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oREGISTROACESSOBD->msg != ''){
				$this->msg = $oREGISTROACESSOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de REGISTROACESSO
	 *
	 * @access public
	 * @param string $valor
	 * @return REGISTROACESSO
	 */
	public function consultar($valor){
		$oREGISTROACESSOBD = new REGISTROACESSOBD();	
		return $oREGISTROACESSOBD->consultar($valor);
	}

	/**
	 * Total de registros de REGISTROACESSO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oREGISTROACESSOBD = new REGISTROACESSOBD();
		return $oREGISTROACESSOBD->totalColecao();
	}

}