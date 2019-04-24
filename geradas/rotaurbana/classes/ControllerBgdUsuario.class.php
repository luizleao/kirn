<?php
class ControllerBgdUsuario extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdUsuario
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdUsuario($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdUsuario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdUsuario = new BgdUsuario($id,$email,$nome);
		$oBgdUsuarioBD = new BgdUsuarioBD();
		if(!$oBgdUsuarioBD->cadastrar($oBgdUsuario)){
			$this->msg = $oBgdUsuarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdUsuario
	 *
	 * @access public
	 * @param BgdUsuario $oBgdUsuario
	 * @return bool
	 */
	public function alterar($oBgdUsuario = NULL){
		if($oBgdUsuario == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdUsuario(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdUsuario($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdUsuario = new BgdUsuario($id,$email,$nome);
		}		
		$oBgdUsuarioBD = new BgdUsuarioBD();
		if(!$oBgdUsuarioBD->alterar($oBgdUsuario)){
			$this->msg = $oBgdUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdUsuario
	 *
	 * @access public
	 * @param integer $idBgdUsuario
	 * @return bool
	 */
	public function excluir($idBgdUsuario){		
		$oBgdUsuarioBD = new BgdUsuarioBD();		
		if(!$oBgdUsuarioBD->excluir($idBgdUsuario)){
			$this->msg = $oBgdUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdUsuario
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdUsuario
	 */
	public function get($id){
		$oBgdUsuarioBD = new BgdUsuarioBD();
		if($oBgdUsuarioBD->msg != ''){
			$this->msg = $oBgdUsuarioBD->msg;
			return false;
		}
		if(!$obj = $oBgdUsuarioBD->get($id)){
		    $this->msg = $oBgdUsuarioBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdUsuario
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdUsuario[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdUsuarioBD = new BgdUsuarioBD();
			$aux = $oBgdUsuarioBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdUsuarioBD->msg != ''){
				$this->msg = $oBgdUsuarioBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdUsuario
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdUsuario
	 */
	public function consultar($valor){
		$oBgdUsuarioBD = new BgdUsuarioBD();	
		return $oBgdUsuarioBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdUsuario
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdUsuarioBD = new BgdUsuarioBD();
		return $oBgdUsuarioBD->totalColecao();
	}

}