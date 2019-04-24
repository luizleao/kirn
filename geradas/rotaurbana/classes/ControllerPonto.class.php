<?php
class ControllerPonto extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Ponto
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPonto($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPonto($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPonto = new Ponto($id,$latitude,$longitude,$linha_id,$codigoAndroid);
		$oPontoBD = new PontoBD();
		if(!$oPontoBD->cadastrar($oPonto)){
			$this->msg = $oPontoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Ponto
	 *
	 * @access public
	 * @param Ponto $oPonto
	 * @return bool
	 */
	public function alterar($oPonto = NULL){
		if($oPonto == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPonto(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPonto($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPonto = new Ponto($id,$latitude,$longitude,$linha_id,$codigoAndroid);
		}		
		$oPontoBD = new PontoBD();
		if(!$oPontoBD->alterar($oPonto)){
			$this->msg = $oPontoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Ponto
	 *
	 * @access public
	 * @param integer $idPonto
	 * @return bool
	 */
	public function excluir($idPonto){		
		$oPontoBD = new PontoBD();		
		if(!$oPontoBD->excluir($idPonto)){
			$this->msg = $oPontoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Ponto
	 *
	 * @access public
	 * @param integer $id
	 * @return Ponto
	 */
	public function get($id){
		$oPontoBD = new PontoBD();
		if($oPontoBD->msg != ''){
			$this->msg = $oPontoBD->msg;
			return false;
		}
		if(!$obj = $oPontoBD->get($id)){
		    $this->msg = $oPontoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Ponto
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Ponto[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPontoBD = new PontoBD();
			$aux = $oPontoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPontoBD->msg != ''){
				$this->msg = $oPontoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Ponto
	 *
	 * @access public
	 * @param string $valor
	 * @return Ponto
	 */
	public function consultar($valor){
		$oPontoBD = new PontoBD();	
		return $oPontoBD->consultar($valor);
	}

	/**
	 * Total de registros de Ponto
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPontoBD = new PontoBD();
		return $oPontoBD->totalColecao();
	}

}