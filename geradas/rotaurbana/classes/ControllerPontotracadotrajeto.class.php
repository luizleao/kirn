<?php
class ControllerPontotracadotrajeto extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Pontotracadotrajeto
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPontotracadotrajeto($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPontotracadotrajeto($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPontotracadotrajeto = new Pontotracadotrajeto($id,$latitude,$longitude,$posicao,$linha_id,$tipo);
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();
		if(!$oPontotracadotrajetoBD->cadastrar($oPontotracadotrajeto)){
			$this->msg = $oPontotracadotrajetoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Pontotracadotrajeto
	 *
	 * @access public
	 * @param Pontotracadotrajeto $oPontotracadotrajeto
	 * @return bool
	 */
	public function alterar($oPontotracadotrajeto = NULL){
		if($oPontotracadotrajeto == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPontotracadotrajeto(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPontotracadotrajeto($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPontotracadotrajeto = new Pontotracadotrajeto($id,$latitude,$longitude,$posicao,$linha_id,$tipo);
		}		
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();
		if(!$oPontotracadotrajetoBD->alterar($oPontotracadotrajeto)){
			$this->msg = $oPontotracadotrajetoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Pontotracadotrajeto
	 *
	 * @access public
	 * @param integer $idPontotracadotrajeto
	 * @return bool
	 */
	public function excluir($idPontotracadotrajeto){		
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();		
		if(!$oPontotracadotrajetoBD->excluir($idPontotracadotrajeto)){
			$this->msg = $oPontotracadotrajetoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Pontotracadotrajeto
	 *
	 * @access public
	 * @param integer $id
	 * @return Pontotracadotrajeto
	 */
	public function get($id){
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();
		if($oPontotracadotrajetoBD->msg != ''){
			$this->msg = $oPontotracadotrajetoBD->msg;
			return false;
		}
		if(!$obj = $oPontotracadotrajetoBD->get($id)){
		    $this->msg = $oPontotracadotrajetoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Pontotracadotrajeto
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Pontotracadotrajeto[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPontotracadotrajetoBD = new PontotracadotrajetoBD();
			$aux = $oPontotracadotrajetoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPontotracadotrajetoBD->msg != ''){
				$this->msg = $oPontotracadotrajetoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Pontotracadotrajeto
	 *
	 * @access public
	 * @param string $valor
	 * @return Pontotracadotrajeto
	 */
	public function consultar($valor){
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();	
		return $oPontotracadotrajetoBD->consultar($valor);
	}

	/**
	 * Total de registros de Pontotracadotrajeto
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPontotracadotrajetoBD = new PontotracadotrajetoBD();
		return $oPontotracadotrajetoBD->totalColecao();
	}

}