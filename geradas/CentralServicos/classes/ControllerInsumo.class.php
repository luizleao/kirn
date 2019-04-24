<?php
class ControllerInsumo extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Insumo
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formInsumo($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormInsumo($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
		$oInsumo = new Insumo($idInsumo,$oNaturezaContratual,$descricao,$estoque,$valor,$status);
		$oInsumoBD = new InsumoBD();
		if(!$oInsumoBD->cadastrar($oInsumo)){
			$this->msg = $oInsumoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Insumo
	 *
	 * @access public
	 * @param Insumo $oInsumo
	 * @return bool
	 */
	public function alterar($oInsumo = NULL){
		if($oInsumo == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formInsumo(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormInsumo($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
			$oInsumo = new Insumo($idInsumo,$oNaturezaContratual,$descricao,$estoque,$valor,$status);
		}		
		$oInsumoBD = new InsumoBD();
		if(!$oInsumoBD->alterar($oInsumo)){
			$this->msg = $oInsumoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Insumo
	 *
	 * @access public
	 * @param integer $idInsumo
	 * @return bool
	 */
	public function excluir($idInsumo){		
		$oInsumoBD = new InsumoBD();		
		if(!$oInsumoBD->excluir($idInsumo)){
			$this->msg = $oInsumoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Insumo
	 *
	 * @access public
	 * @param integer $idInsumo
	 * @return Insumo
	 */
	public function get($idInsumo){
		$oInsumoBD = new InsumoBD();
		if($oInsumoBD->msg != ''){
			$this->msg = $oInsumoBD->msg;
			return false;
		}
		if(!$obj = $oInsumoBD->get($idInsumo)){
		    $this->msg = $oInsumoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Insumo
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Insumo[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oInsumoBD = new InsumoBD();
			$aux = $oInsumoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oInsumoBD->msg != ''){
				$this->msg = $oInsumoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Insumo
	 *
	 * @access public
	 * @param string $valor
	 * @return Insumo
	 */
	public function consultar($valor){
		$oInsumoBD = new InsumoBD();	
		return $oInsumoBD->consultar($valor);
	}

	/**
	 * Total de registros de Insumo
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oInsumoBD = new InsumoBD();
		return $oInsumoBD->totalColecao();
	}

}