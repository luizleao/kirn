<?php
class ControllerPontopesquisa extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Pontopesquisa
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPontopesquisa($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPontopesquisa($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oLinha = new Linha($linha_id);
		$oPontopesquisa = new Pontopesquisa($id,$latitude,$longitude,$posicao,$tipo,$oLinha);
		$oPontopesquisaBD = new PontopesquisaBD();
		if(!$oPontopesquisaBD->cadastrar($oPontopesquisa)){
			$this->msg = $oPontopesquisaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Pontopesquisa
	 *
	 * @access public
	 * @param Pontopesquisa $oPontopesquisa
	 * @return bool
	 */
	public function alterar($oPontopesquisa = NULL){
		if($oPontopesquisa == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPontopesquisa(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPontopesquisa($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oLinha = new Linha($linha_id);
			$oPontopesquisa = new Pontopesquisa($id,$latitude,$longitude,$posicao,$tipo,$oLinha);
		}		
		$oPontopesquisaBD = new PontopesquisaBD();
		if(!$oPontopesquisaBD->alterar($oPontopesquisa)){
			$this->msg = $oPontopesquisaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Pontopesquisa
	 *
	 * @access public
	 * @param integer $idPontopesquisa
	 * @return bool
	 */
	public function excluir($idPontopesquisa){		
		$oPontopesquisaBD = new PontopesquisaBD();		
		if(!$oPontopesquisaBD->excluir($idPontopesquisa)){
			$this->msg = $oPontopesquisaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Pontopesquisa
	 *
	 * @access public
	 * @param integer $id
	 * @return Pontopesquisa
	 */
	public function get($id){
		$oPontopesquisaBD = new PontopesquisaBD();
		if($oPontopesquisaBD->msg != ''){
			$this->msg = $oPontopesquisaBD->msg;
			return false;
		}
		if(!$obj = $oPontopesquisaBD->get($id)){
		    $this->msg = $oPontopesquisaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Pontopesquisa
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Pontopesquisa[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPontopesquisaBD = new PontopesquisaBD();
			$aux = $oPontopesquisaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPontopesquisaBD->msg != ''){
				$this->msg = $oPontopesquisaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Pontopesquisa
	 *
	 * @access public
	 * @param string $valor
	 * @return Pontopesquisa
	 */
	public function consultar($valor){
		$oPontopesquisaBD = new PontopesquisaBD();	
		return $oPontopesquisaBD->consultar($valor);
	}

	/**
	 * Total de registros de Pontopesquisa
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPontopesquisaBD = new PontopesquisaBD();
		return $oPontopesquisaBD->totalColecao();
	}

}