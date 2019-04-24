<?php
class ControllerEVENTO SUSPEITO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar EVENTO SUSPEITO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formEVENTO SUSPEITO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormEVENTO SUSPEITO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oEVENTO SUSPEITO = new EVENTO SUSPEITO();
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();
		if(!$oEVENTO SUSPEITOBD->cadastrar($oEVENTO SUSPEITO)){
			$this->msg = $oEVENTO SUSPEITOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de EVENTO SUSPEITO
	 *
	 * @access public
	 * @param EVENTO SUSPEITO $oEVENTO SUSPEITO
	 * @return bool
	 */
	public function alterar($oEVENTO SUSPEITO = NULL){
		if($oEVENTO SUSPEITO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formEVENTO SUSPEITO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormEVENTO SUSPEITO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oEVENTO SUSPEITO = new EVENTO SUSPEITO();
		}		
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();
		if(!$oEVENTO SUSPEITOBD->alterar($oEVENTO SUSPEITO)){
			$this->msg = $oEVENTO SUSPEITOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir EVENTO SUSPEITO
	 *
	 * @access public
	 * @param integer $idEVENTO SUSPEITO
	 * @return bool
	 */
	public function excluir($idEVENTO SUSPEITO){		
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();		
		if(!$oEVENTO SUSPEITOBD->excluir($idEVENTO SUSPEITO)){
			$this->msg = $oEVENTO SUSPEITOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de EVENTO SUSPEITO
	 *
	 * @access public

	 * @return EVENTO SUSPEITO
	 */
	public function get(){
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();
		if($oEVENTO SUSPEITOBD->msg != ''){
			$this->msg = $oEVENTO SUSPEITOBD->msg;
			return false;
		}
		if(!$obj = $oEVENTO SUSPEITOBD->get()){
		    $this->msg = $oEVENTO SUSPEITOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de EVENTO SUSPEITO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return EVENTO SUSPEITO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();
			$aux = $oEVENTO SUSPEITOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oEVENTO SUSPEITOBD->msg != ''){
				$this->msg = $oEVENTO SUSPEITOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de EVENTO SUSPEITO
	 *
	 * @access public
	 * @param string $valor
	 * @return EVENTO SUSPEITO
	 */
	public function consultar($valor){
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();	
		return $oEVENTO SUSPEITOBD->consultar($valor);
	}

	/**
	 * Total de registros de EVENTO SUSPEITO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oEVENTO SUSPEITOBD = new EVENTO SUSPEITOBD();
		return $oEVENTO SUSPEITOBD->totalColecao();
	}

}