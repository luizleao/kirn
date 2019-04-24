<?php
class ControllerCompartilhamento extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Compartilhamento
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCompartilhamento($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCompartilhamento($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oIndicador = new Indicador($id);
		$oCompartilhamento = new Compartilhamento($cont,$oIndicador);
		$oCompartilhamentoBD = new CompartilhamentoBD();
		if(!$oCompartilhamentoBD->cadastrar($oCompartilhamento)){
			$this->msg = $oCompartilhamentoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Compartilhamento
	 *
	 * @access public
	 * @param Compartilhamento $oCompartilhamento
	 * @return bool
	 */
	public function alterar($oCompartilhamento = NULL){
		if($oCompartilhamento == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCompartilhamento(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCompartilhamento($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oIndicador = new Indicador($id);
			$oCompartilhamento = new Compartilhamento($cont,$oIndicador);
		}		
		$oCompartilhamentoBD = new CompartilhamentoBD();
		if(!$oCompartilhamentoBD->alterar($oCompartilhamento)){
			$this->msg = $oCompartilhamentoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Compartilhamento
	 *
	 * @access public
	 * @param integer $idCompartilhamento
	 * @return bool
	 */
	public function excluir($idCompartilhamento){		
		$oCompartilhamentoBD = new CompartilhamentoBD();		
		if(!$oCompartilhamentoBD->excluir($idCompartilhamento)){
			$this->msg = $oCompartilhamentoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Compartilhamento
	 *
	 * @access public
	 * @param integer $id
	 * @return Compartilhamento
	 */
	public function get($id){
		$oCompartilhamentoBD = new CompartilhamentoBD();
		if($oCompartilhamentoBD->msg != ''){
			$this->msg = $oCompartilhamentoBD->msg;
			return false;
		}
		if(!$obj = $oCompartilhamentoBD->get($id)){
		    $this->msg = $oCompartilhamentoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Compartilhamento
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Compartilhamento[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCompartilhamentoBD = new CompartilhamentoBD();
			$aux = $oCompartilhamentoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCompartilhamentoBD->msg != ''){
				$this->msg = $oCompartilhamentoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Compartilhamento
	 *
	 * @access public
	 * @param string $valor
	 * @return Compartilhamento
	 */
	public function consultar($valor){
		$oCompartilhamentoBD = new CompartilhamentoBD();	
		return $oCompartilhamentoBD->consultar($valor);
	}

	/**
	 * Total de registros de Compartilhamento
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCompartilhamentoBD = new CompartilhamentoBD();
		return $oCompartilhamentoBD->totalColecao();
	}

}