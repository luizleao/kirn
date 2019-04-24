<?php
class ControllerTrechocomentario extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Trechocomentario
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTrechocomentario($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTrechocomentario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oLinha = new Linha($linha_id);
		$oTrechocomentario = new Trechocomentario($id,$comentario,$oLinha);
		$oTrechocomentarioBD = new TrechocomentarioBD();
		if(!$oTrechocomentarioBD->cadastrar($oTrechocomentario)){
			$this->msg = $oTrechocomentarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Trechocomentario
	 *
	 * @access public
	 * @param Trechocomentario $oTrechocomentario
	 * @return bool
	 */
	public function alterar($oTrechocomentario = NULL){
		if($oTrechocomentario == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTrechocomentario(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTrechocomentario($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oLinha = new Linha($linha_id);
			$oTrechocomentario = new Trechocomentario($id,$comentario,$oLinha);
		}		
		$oTrechocomentarioBD = new TrechocomentarioBD();
		if(!$oTrechocomentarioBD->alterar($oTrechocomentario)){
			$this->msg = $oTrechocomentarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Trechocomentario
	 *
	 * @access public
	 * @param integer $idTrechocomentario
	 * @return bool
	 */
	public function excluir($idTrechocomentario){		
		$oTrechocomentarioBD = new TrechocomentarioBD();		
		if(!$oTrechocomentarioBD->excluir($idTrechocomentario)){
			$this->msg = $oTrechocomentarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Trechocomentario
	 *
	 * @access public
	 * @param integer $id
	 * @return Trechocomentario
	 */
	public function get($id){
		$oTrechocomentarioBD = new TrechocomentarioBD();
		if($oTrechocomentarioBD->msg != ''){
			$this->msg = $oTrechocomentarioBD->msg;
			return false;
		}
		if(!$obj = $oTrechocomentarioBD->get($id)){
		    $this->msg = $oTrechocomentarioBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Trechocomentario
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Trechocomentario[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTrechocomentarioBD = new TrechocomentarioBD();
			$aux = $oTrechocomentarioBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTrechocomentarioBD->msg != ''){
				$this->msg = $oTrechocomentarioBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Trechocomentario
	 *
	 * @access public
	 * @param string $valor
	 * @return Trechocomentario
	 */
	public function consultar($valor){
		$oTrechocomentarioBD = new TrechocomentarioBD();	
		return $oTrechocomentarioBD->consultar($valor);
	}

	/**
	 * Total de registros de Trechocomentario
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTrechocomentarioBD = new TrechocomentarioBD();
		return $oTrechocomentarioBD->totalColecao();
	}

}