<?php
class ControllerTipoServico extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar TipoServico
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTipoServico($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTipoServico($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
		$oTipoServico = new TipoServico($idTipoServico,$oNaturezaContratual,$descricao,$status);
		$oTipoServicoBD = new TipoServicoBD();
		if(!$oTipoServicoBD->cadastrar($oTipoServico)){
			$this->msg = $oTipoServicoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de TipoServico
	 *
	 * @access public
	 * @param TipoServico $oTipoServico
	 * @return bool
	 */
	public function alterar($oTipoServico = NULL){
		if($oTipoServico == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTipoServico(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTipoServico($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oNaturezaContratual = new NaturezaContratual($idNaturezaContratual);
			$oTipoServico = new TipoServico($idTipoServico,$oNaturezaContratual,$descricao,$status);
		}		
		$oTipoServicoBD = new TipoServicoBD();
		if(!$oTipoServicoBD->alterar($oTipoServico)){
			$this->msg = $oTipoServicoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir TipoServico
	 *
	 * @access public
	 * @param integer $idTipoServico
	 * @return bool
	 */
	public function excluir($idTipoServico){		
		$oTipoServicoBD = new TipoServicoBD();		
		if(!$oTipoServicoBD->excluir($idTipoServico)){
			$this->msg = $oTipoServicoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de TipoServico
	 *
	 * @access public
	 * @param integer $idTipoServico
	 * @return TipoServico
	 */
	public function get($idTipoServico){
		$oTipoServicoBD = new TipoServicoBD();
		if($oTipoServicoBD->msg != ''){
			$this->msg = $oTipoServicoBD->msg;
			return false;
		}
		if(!$obj = $oTipoServicoBD->get($idTipoServico)){
		    $this->msg = $oTipoServicoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de TipoServico
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return TipoServico[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTipoServicoBD = new TipoServicoBD();
			$aux = $oTipoServicoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTipoServicoBD->msg != ''){
				$this->msg = $oTipoServicoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de TipoServico
	 *
	 * @access public
	 * @param string $valor
	 * @return TipoServico
	 */
	public function consultar($valor){
		$oTipoServicoBD = new TipoServicoBD();	
		return $oTipoServicoBD->consultar($valor);
	}

	/**
	 * Total de registros de TipoServico
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTipoServicoBD = new TipoServicoBD();
		return $oTipoServicoBD->totalColecao();
	}

}