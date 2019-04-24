<?php
class ControllerSicasLotacao extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar SicasLotacao
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSicasLotacao($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSicasLotacao($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSicasLotacao = new SicasLotacao($cd_lotacao);
		$oSicasLotacaoBD = new SicasLotacaoBD();
		if(!$oSicasLotacaoBD->cadastrar($oSicasLotacao)){
			$this->msg = $oSicasLotacaoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de SicasLotacao
	 *
	 * @access public
	 * @param SicasLotacao $oSicasLotacao
	 * @return bool
	 */
	public function alterar($oSicasLotacao = NULL){
		if($oSicasLotacao == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSicasLotacao(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSicasLotacao($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSicasLotacao = new SicasLotacao($cd_lotacao);
		}		
		$oSicasLotacaoBD = new SicasLotacaoBD();
		if(!$oSicasLotacaoBD->alterar($oSicasLotacao)){
			$this->msg = $oSicasLotacaoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir SicasLotacao
	 *
	 * @access public
	 * @param integer $idSicasLotacao
	 * @return bool
	 */
	public function excluir($idSicasLotacao){		
		$oSicasLotacaoBD = new SicasLotacaoBD();		
		if(!$oSicasLotacaoBD->excluir($idSicasLotacao)){
			$this->msg = $oSicasLotacaoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de SicasLotacao
	 *
	 * @access public
	 * @param integer $cd_lotacao
	 * @return SicasLotacao
	 */
	public function get($cd_lotacao){
		$oSicasLotacaoBD = new SicasLotacaoBD();
		if($oSicasLotacaoBD->msg != ''){
			$this->msg = $oSicasLotacaoBD->msg;
			return false;
		}
		if(!$obj = $oSicasLotacaoBD->get($cd_lotacao)){
		    $this->msg = $oSicasLotacaoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de SicasLotacao
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return SicasLotacao[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSicasLotacaoBD = new SicasLotacaoBD();
			$aux = $oSicasLotacaoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSicasLotacaoBD->msg != ''){
				$this->msg = $oSicasLotacaoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de SicasLotacao
	 *
	 * @access public
	 * @param string $valor
	 * @return SicasLotacao
	 */
	public function consultar($valor){
		$oSicasLotacaoBD = new SicasLotacaoBD();	
		return $oSicasLotacaoBD->consultar($valor);
	}

	/**
	 * Total de registros de SicasLotacao
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSicasLotacaoBD = new SicasLotacaoBD();
		return $oSicasLotacaoBD->totalColecao();
	}

}