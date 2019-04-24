<?php
class ControllerEstado extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Estado
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formEstado($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormEstado($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPais = new Pais($pais_id);
		$oEstado = new Estado($id,$nome,$uf,$oPais);
		$oEstadoBD = new EstadoBD();
		if(!$oEstadoBD->cadastrar($oEstado)){
			$this->msg = $oEstadoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Estado
	 *
	 * @access public
	 * @param Estado $oEstado
	 * @return bool
	 */
	public function alterar($oEstado = NULL){
		if($oEstado == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formEstado(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormEstado($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPais = new Pais($pais_id);
			$oEstado = new Estado($id,$nome,$uf,$oPais);
		}		
		$oEstadoBD = new EstadoBD();
		if(!$oEstadoBD->alterar($oEstado)){
			$this->msg = $oEstadoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Estado
	 *
	 * @access public
	 * @param integer $idEstado
	 * @return bool
	 */
	public function excluir($idEstado){		
		$oEstadoBD = new EstadoBD();		
		if(!$oEstadoBD->excluir($idEstado)){
			$this->msg = $oEstadoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Estado
	 *
	 * @access public
	 * @param integer $id
	 * @return Estado
	 */
	public function get($id){
		$oEstadoBD = new EstadoBD();
		if($oEstadoBD->msg != ''){
			$this->msg = $oEstadoBD->msg;
			return false;
		}
		if(!$obj = $oEstadoBD->get($id)){
		    $this->msg = $oEstadoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Estado
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Estado[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oEstadoBD = new EstadoBD();
			$aux = $oEstadoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oEstadoBD->msg != ''){
				$this->msg = $oEstadoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Estado
	 *
	 * @access public
	 * @param string $valor
	 * @return Estado
	 */
	public function consultar($valor){
		$oEstadoBD = new EstadoBD();	
		return $oEstadoBD->consultar($valor);
	}

	/**
	 * Total de registros de Estado
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oEstadoBD = new EstadoBD();
		return $oEstadoBD->totalColecao();
	}

}