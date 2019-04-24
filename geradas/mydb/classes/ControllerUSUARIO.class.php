<?php
class ControllerUSUARIO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar USUARIO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formUSUARIO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormUSUARIO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPESSOA = new PESSOA($PESSOA_id);
		$oPERFIL = new PERFIL($PERFIL_id);
		$oUSUARIO = new USUARIO($login,$senha,$oPESSOA,$oPERFIL);
		$oUSUARIOBD = new USUARIOBD();
		if(!$oUSUARIOBD->cadastrar($oUSUARIO)){
			$this->msg = $oUSUARIOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de USUARIO
	 *
	 * @access public
	 * @param USUARIO $oUSUARIO
	 * @return bool
	 */
	public function alterar($oUSUARIO = NULL){
		if($oUSUARIO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formUSUARIO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormUSUARIO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPESSOA = new PESSOA($PESSOA_id);
			$oPERFIL = new PERFIL($PERFIL_id);
			$oUSUARIO = new USUARIO($login,$senha,$oPESSOA,$oPERFIL);
		}		
		$oUSUARIOBD = new USUARIOBD();
		if(!$oUSUARIOBD->alterar($oUSUARIO)){
			$this->msg = $oUSUARIOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir USUARIO
	 *
	 * @access public
	 * @param integer $idUSUARIO
	 * @return bool
	 */
	public function excluir($idUSUARIO){		
		$oUSUARIOBD = new USUARIOBD();		
		if(!$oUSUARIOBD->excluir($idUSUARIO)){
			$this->msg = $oUSUARIOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de USUARIO
	 *
	 * @access public

	 * @return USUARIO
	 */
	public function get(){
		$oUSUARIOBD = new USUARIOBD();
		if($oUSUARIOBD->msg != ''){
			$this->msg = $oUSUARIOBD->msg;
			return false;
		}
		if(!$obj = $oUSUARIOBD->get()){
		    $this->msg = $oUSUARIOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de USUARIO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return USUARIO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oUSUARIOBD = new USUARIOBD();
			$aux = $oUSUARIOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oUSUARIOBD->msg != ''){
				$this->msg = $oUSUARIOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de USUARIO
	 *
	 * @access public
	 * @param string $valor
	 * @return USUARIO
	 */
	public function consultar($valor){
		$oUSUARIOBD = new USUARIOBD();	
		return $oUSUARIOBD->consultar($valor);
	}

	/**
	 * Total de registros de USUARIO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oUSUARIOBD = new USUARIOBD();
		return $oUSUARIOBD->totalColecao();
	}

}