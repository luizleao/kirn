<?php
class ControllerBgdLinha extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdLinha
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdLinha($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdLinha($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdLinha = new BgdLinha($id,$codigo,$comentario,$nome);
		$oBgdLinhaBD = new BgdLinhaBD();
		if(!$oBgdLinhaBD->cadastrar($oBgdLinha)){
			$this->msg = $oBgdLinhaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdLinha
	 *
	 * @access public
	 * @param BgdLinha $oBgdLinha
	 * @return bool
	 */
	public function alterar($oBgdLinha = NULL){
		if($oBgdLinha == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdLinha(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdLinha($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdLinha = new BgdLinha($id,$codigo,$comentario,$nome);
		}		
		$oBgdLinhaBD = new BgdLinhaBD();
		if(!$oBgdLinhaBD->alterar($oBgdLinha)){
			$this->msg = $oBgdLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdLinha
	 *
	 * @access public
	 * @param integer $idBgdLinha
	 * @return bool
	 */
	public function excluir($idBgdLinha){		
		$oBgdLinhaBD = new BgdLinhaBD();		
		if(!$oBgdLinhaBD->excluir($idBgdLinha)){
			$this->msg = $oBgdLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdLinha
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdLinha
	 */
	public function get($id){
		$oBgdLinhaBD = new BgdLinhaBD();
		if($oBgdLinhaBD->msg != ''){
			$this->msg = $oBgdLinhaBD->msg;
			return false;
		}
		if(!$obj = $oBgdLinhaBD->get($id)){
		    $this->msg = $oBgdLinhaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdLinha
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdLinha[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdLinhaBD = new BgdLinhaBD();
			$aux = $oBgdLinhaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdLinhaBD->msg != ''){
				$this->msg = $oBgdLinhaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdLinha
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdLinha
	 */
	public function consultar($valor){
		$oBgdLinhaBD = new BgdLinhaBD();	
		return $oBgdLinhaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdLinha
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdLinhaBD = new BgdLinhaBD();
		return $oBgdLinhaBD->totalColecao();
	}

}