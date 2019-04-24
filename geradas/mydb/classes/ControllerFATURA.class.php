<?php
class ControllerFATURA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar FATURA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formFATURA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormFATURA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oCLIENTE = new CLIENTE($CLIENTE_id);
		$oFATURA = new FATURA($valor,$vencimento,$pagamento,$oCLIENTE);
		$oFATURABD = new FATURABD();
		if(!$oFATURABD->cadastrar($oFATURA)){
			$this->msg = $oFATURABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de FATURA
	 *
	 * @access public
	 * @param FATURA $oFATURA
	 * @return bool
	 */
	public function alterar($oFATURA = NULL){
		if($oFATURA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formFATURA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormFATURA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oCLIENTE = new CLIENTE($CLIENTE_id);
			$oFATURA = new FATURA($valor,$vencimento,$pagamento,$oCLIENTE);
		}		
		$oFATURABD = new FATURABD();
		if(!$oFATURABD->alterar($oFATURA)){
			$this->msg = $oFATURABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir FATURA
	 *
	 * @access public
	 * @param integer $idFATURA
	 * @return bool
	 */
	public function excluir($idFATURA){		
		$oFATURABD = new FATURABD();		
		if(!$oFATURABD->excluir($idFATURA)){
			$this->msg = $oFATURABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de FATURA
	 *
	 * @access public

	 * @return FATURA
	 */
	public function get(){
		$oFATURABD = new FATURABD();
		if($oFATURABD->msg != ''){
			$this->msg = $oFATURABD->msg;
			return false;
		}
		if(!$obj = $oFATURABD->get()){
		    $this->msg = $oFATURABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de FATURA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return FATURA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oFATURABD = new FATURABD();
			$aux = $oFATURABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oFATURABD->msg != ''){
				$this->msg = $oFATURABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de FATURA
	 *
	 * @access public
	 * @param string $valor
	 * @return FATURA
	 */
	public function consultar($valor){
		$oFATURABD = new FATURABD();	
		return $oFATURABD->consultar($valor);
	}

	/**
	 * Total de registros de FATURA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oFATURABD = new FATURABD();
		return $oFATURABD->totalColecao();
	}

}