<?php
class ControllerPrestador extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Prestador
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPrestador($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPrestador($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
		$oPrestador = new Prestador($idPrestador,$oNaturezaContratual,$nome,$numeroContrato,$nomePreposto,$contatoPreposto,$usuario,$senha,$email,$status);
		$oPrestadorBD = new PrestadorBD();
		if(!$oPrestadorBD->cadastrar($oPrestador)){
			$this->msg = $oPrestadorBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Prestador
	 *
	 * @access public
	 * @param Prestador $oPrestador
	 * @return bool
	 */
	public function alterar($oPrestador = NULL){
		if($oPrestador == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPrestador(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPrestador($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
			$oPrestador = new Prestador($idPrestador,$oNaturezaContratual,$nome,$numeroContrato,$nomePreposto,$contatoPreposto,$usuario,$senha,$email,$status);
		}		
		$oPrestadorBD = new PrestadorBD();
		if(!$oPrestadorBD->alterar($oPrestador)){
			$this->msg = $oPrestadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Prestador
	 *
	 * @access public
	 * @param integer $idPrestador
	 * @return bool
	 */
	public function excluir($idPrestador){		
		$oPrestadorBD = new PrestadorBD();		
		if(!$oPrestadorBD->excluir($idPrestador)){
			$this->msg = $oPrestadorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Prestador
	 *
	 * @access public
	 * @param integer $idPrestador
	 * @return Prestador
	 */
	public function get($idPrestador){
		$oPrestadorBD = new PrestadorBD();
		if($oPrestadorBD->msg != ''){
			$this->msg = $oPrestadorBD->msg;
			return false;
		}
		if(!$obj = $oPrestadorBD->get($idPrestador)){
		    $this->msg = $oPrestadorBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Prestador
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Prestador[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPrestadorBD = new PrestadorBD();
			$aux = $oPrestadorBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPrestadorBD->msg != ''){
				$this->msg = $oPrestadorBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Prestador
	 *
	 * @access public
	 * @param string $valor
	 * @return Prestador
	 */
	public function consultar($valor){
		$oPrestadorBD = new PrestadorBD();	
		return $oPrestadorBD->consultar($valor);
	}

	/**
	 * Total de registros de Prestador
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPrestadorBD = new PrestadorBD();
		return $oPrestadorBD->totalColecao();
	}

}