<?php
class ControllerNaturezaContratual extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar NaturezaContratual
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formNaturezaContratual($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormNaturezaContratual($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual,$descricao,$status);
		$oNaturezaContratualBD = new NaturezaContratualBD();
		if(!$oNaturezaContratualBD->cadastrar($oNaturezaContratual)){
			$this->msg = $oNaturezaContratualBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de NaturezaContratual
	 *
	 * @access public
	 * @param NaturezaContratual $oNaturezaContratual
	 * @return bool
	 */
	public function alterar($oNaturezaContratual = NULL){
		if($oNaturezaContratual == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formNaturezaContratual(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormNaturezaContratual($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual,$descricao,$status);
		}		
		$oNaturezaContratualBD = new NaturezaContratualBD();
		if(!$oNaturezaContratualBD->alterar($oNaturezaContratual)){
			$this->msg = $oNaturezaContratualBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir NaturezaContratual
	 *
	 * @access public
	 * @param integer $idNaturezaContratual
	 * @return bool
	 */
	public function excluir($idNaturezaContratual){		
		$oNaturezaContratualBD = new NaturezaContratualBD();		
		if(!$oNaturezaContratualBD->excluir($idNaturezaContratual)){
			$this->msg = $oNaturezaContratualBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de NaturezaContratual
	 *
	 * @access public
	 * @param integer $idNaturezaContratual
	 * @return NaturezaContratual
	 */
	public function get($idNaturezaContratual){
		$oNaturezaContratualBD = new NaturezaContratualBD();
		if($oNaturezaContratualBD->msg != ''){
			$this->msg = $oNaturezaContratualBD->msg;
			return false;
		}
		if(!$obj = $oNaturezaContratualBD->get($idNaturezaContratual)){
		    $this->msg = $oNaturezaContratualBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de NaturezaContratual
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return NaturezaContratual[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oNaturezaContratualBD = new NaturezaContratualBD();
			$aux = $oNaturezaContratualBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oNaturezaContratualBD->msg != ''){
				$this->msg = $oNaturezaContratualBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de NaturezaContratual
	 *
	 * @access public
	 * @param string $valor
	 * @return NaturezaContratual
	 */
	public function consultar($valor){
		$oNaturezaContratualBD = new NaturezaContratualBD();	
		return $oNaturezaContratualBD->consultar($valor);
	}

	/**
	 * Total de registros de NaturezaContratual
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oNaturezaContratualBD = new NaturezaContratualBD();
		return $oNaturezaContratualBD->totalColecao();
	}

}