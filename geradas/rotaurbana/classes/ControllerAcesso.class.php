<?php
class ControllerAcesso extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Acesso
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formAcesso($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormAcesso($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oAcesso = new Acesso($ip,$oIndicador);
		$oAcessoBD = new AcessoBD();
		if(!$oAcessoBD->cadastrar($oAcesso)){
			$this->msg = $oAcessoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Acesso
	 *
	 * @access public
	 * @param Acesso $oAcesso
	 * @return bool
	 */
	public function alterar($oAcesso = NULL){
		if($oAcesso == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formAcesso(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormAcesso($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oAcesso = new Acesso($ip,$oIndicador);
		}		
		$oAcessoBD = new AcessoBD();
		if(!$oAcessoBD->alterar($oAcesso)){
			$this->msg = $oAcessoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Acesso
	 *
	 * @access public
	 * @param integer $idAcesso
	 * @return bool
	 */
	public function excluir($idAcesso){		
		$oAcessoBD = new AcessoBD();		
		if(!$oAcessoBD->excluir($idAcesso)){
			$this->msg = $oAcessoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Acesso
	 *
	 * @access public
	 * @param integer $id
	 * @return Acesso
	 */
	public function get($id){
		$oAcessoBD = new AcessoBD();
		if($oAcessoBD->msg != ''){
			$this->msg = $oAcessoBD->msg;
			return false;
		}
		if(!$obj = $oAcessoBD->get($id)){
		    $this->msg = $oAcessoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Acesso
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Acesso[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oAcessoBD = new AcessoBD();
			$aux = $oAcessoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oAcessoBD->msg != ''){
				$this->msg = $oAcessoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Acesso
	 *
	 * @access public
	 * @param string $valor
	 * @return Acesso
	 */
	public function consultar($valor){
		$oAcessoBD = new AcessoBD();	
		return $oAcessoBD->consultar($valor);
	}

	/**
	 * Total de registros de Acesso
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oAcessoBD = new AcessoBD();
		return $oAcessoBD->totalColecao();
	}

}