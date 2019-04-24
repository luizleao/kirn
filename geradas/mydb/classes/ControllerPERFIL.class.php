<?php
class ControllerPERFIL extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PERFIL
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPERFIL($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPERFIL($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFIL = new PERFIL($id,$nome);
		$oPERFILBD = new PERFILBD();
		if(!$oPERFILBD->cadastrar($oPERFIL)){
			$this->msg = $oPERFILBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PERFIL
	 *
	 * @access public
	 * @param PERFIL $oPERFIL
	 * @return bool
	 */
	public function alterar($oPERFIL = NULL){
		if($oPERFIL == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPERFIL(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPERFIL($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFIL = new PERFIL($id,$nome);
		}		
		$oPERFILBD = new PERFILBD();
		if(!$oPERFILBD->alterar($oPERFIL)){
			$this->msg = $oPERFILBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PERFIL
	 *
	 * @access public
	 * @param integer $idPERFIL
	 * @return bool
	 */
	public function excluir($idPERFIL){		
		$oPERFILBD = new PERFILBD();		
		if(!$oPERFILBD->excluir($idPERFIL)){
			$this->msg = $oPERFILBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PERFIL
	 *
	 * @access public
	 * @param integer $id
	 * @return PERFIL
	 */
	public function get($id){
		$oPERFILBD = new PERFILBD();
		if($oPERFILBD->msg != ''){
			$this->msg = $oPERFILBD->msg;
			return false;
		}
		if(!$obj = $oPERFILBD->get($id)){
		    $this->msg = $oPERFILBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PERFIL
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PERFIL[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPERFILBD = new PERFILBD();
			$aux = $oPERFILBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPERFILBD->msg != ''){
				$this->msg = $oPERFILBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PERFIL
	 *
	 * @access public
	 * @param string $valor
	 * @return PERFIL
	 */
	public function consultar($valor){
		$oPERFILBD = new PERFILBD();	
		return $oPERFILBD->consultar($valor);
	}

	/**
	 * Total de registros de PERFIL
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPERFILBD = new PERFILBD();
		return $oPERFILBD->totalColecao();
	}

}