<?php
class ControllerCAMPEONATO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CAMPEONATO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCAMPEONATO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCAMPEONATO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oCAMPEONATO = new CAMPEONATO($id);
		$oCAMPEONATOBD = new CAMPEONATOBD();
		if(!$oCAMPEONATOBD->cadastrar($oCAMPEONATO)){
			$this->msg = $oCAMPEONATOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CAMPEONATO
	 *
	 * @access public
	 * @param CAMPEONATO $oCAMPEONATO
	 * @return bool
	 */
	public function alterar($oCAMPEONATO = NULL){
		if($oCAMPEONATO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCAMPEONATO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCAMPEONATO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oCAMPEONATO = new CAMPEONATO($id);
		}		
		$oCAMPEONATOBD = new CAMPEONATOBD();
		if(!$oCAMPEONATOBD->alterar($oCAMPEONATO)){
			$this->msg = $oCAMPEONATOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CAMPEONATO
	 *
	 * @access public
	 * @param integer $idCAMPEONATO
	 * @return bool
	 */
	public function excluir($idCAMPEONATO){		
		$oCAMPEONATOBD = new CAMPEONATOBD();		
		if(!$oCAMPEONATOBD->excluir($idCAMPEONATO)){
			$this->msg = $oCAMPEONATOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CAMPEONATO
	 *
	 * @access public
	 * @param integer $id
	 * @return CAMPEONATO
	 */
	public function get($id){
		$oCAMPEONATOBD = new CAMPEONATOBD();
		if($oCAMPEONATOBD->msg != ''){
			$this->msg = $oCAMPEONATOBD->msg;
			return false;
		}
		if(!$obj = $oCAMPEONATOBD->get($id)){
		    $this->msg = $oCAMPEONATOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CAMPEONATO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CAMPEONATO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCAMPEONATOBD = new CAMPEONATOBD();
			$aux = $oCAMPEONATOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCAMPEONATOBD->msg != ''){
				$this->msg = $oCAMPEONATOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CAMPEONATO
	 *
	 * @access public
	 * @param string $valor
	 * @return CAMPEONATO
	 */
	public function consultar($valor){
		$oCAMPEONATOBD = new CAMPEONATOBD();	
		return $oCAMPEONATOBD->consultar($valor);
	}

	/**
	 * Total de registros de CAMPEONATO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCAMPEONATOBD = new CAMPEONATOBD();
		return $oCAMPEONATOBD->totalColecao();
	}

}