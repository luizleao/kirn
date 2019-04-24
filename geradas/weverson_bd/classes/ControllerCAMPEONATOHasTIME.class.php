<?php
class ControllerCAMPEONATOHasTIME extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CAMPEONATOHasTIME
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCAMPEONATOHasTIME($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCAMPEONATOHasTIME($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oCAMPEONATO = new CAMPEONATO($CAMPEONATO_id);
		$oTIME = new TIME($TIME_id);
		$oCAMPEONATOHasTIME = new CAMPEONATOHasTIME($oCAMPEONATO,$oTIME);
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();
		if(!$oCAMPEONATOHasTIMEBD->cadastrar($oCAMPEONATOHasTIME)){
			$this->msg = $oCAMPEONATOHasTIMEBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CAMPEONATOHasTIME
	 *
	 * @access public
	 * @param CAMPEONATOHasTIME $oCAMPEONATOHasTIME
	 * @return bool
	 */
	public function alterar($oCAMPEONATOHasTIME = NULL){
		if($oCAMPEONATOHasTIME == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCAMPEONATOHasTIME(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCAMPEONATOHasTIME($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oCAMPEONATO = new CAMPEONATO($CAMPEONATO_id);
			$oTIME = new TIME($TIME_id);
			$oCAMPEONATOHasTIME = new CAMPEONATOHasTIME($oCAMPEONATO,$oTIME);
		}		
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();
		if(!$oCAMPEONATOHasTIMEBD->alterar($oCAMPEONATOHasTIME)){
			$this->msg = $oCAMPEONATOHasTIMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CAMPEONATOHasTIME
	 *
	 * @access public
	 * @param integer $idCAMPEONATOHasTIME
	 * @return bool
	 */
	public function excluir($idCAMPEONATOHasTIME){		
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();		
		if(!$oCAMPEONATOHasTIMEBD->excluir($idCAMPEONATOHasTIME)){
			$this->msg = $oCAMPEONATOHasTIMEBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CAMPEONATOHasTIME
	 *
	 * @access public
	 * @param integer $CAMPEONATO_id
	 * @param integer $TIME_id
	 * @return CAMPEONATOHasTIME
	 */
	public function get($CAMPEONATO_id,$TIME_id){
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();
		if($oCAMPEONATOHasTIMEBD->msg != ''){
			$this->msg = $oCAMPEONATOHasTIMEBD->msg;
			return false;
		}
		if(!$obj = $oCAMPEONATOHasTIMEBD->get($CAMPEONATO_id,$TIME_id)){
		    $this->msg = $oCAMPEONATOHasTIMEBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CAMPEONATOHasTIME
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CAMPEONATOHasTIME[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();
			$aux = $oCAMPEONATOHasTIMEBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCAMPEONATOHasTIMEBD->msg != ''){
				$this->msg = $oCAMPEONATOHasTIMEBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CAMPEONATOHasTIME
	 *
	 * @access public
	 * @param string $valor
	 * @return CAMPEONATOHasTIME
	 */
	public function consultar($valor){
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();	
		return $oCAMPEONATOHasTIMEBD->consultar($valor);
	}

	/**
	 * Total de registros de CAMPEONATOHasTIME
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCAMPEONATOHasTIMEBD = new CAMPEONATOHasTIMEBD();
		return $oCAMPEONATOHasTIMEBD->totalColecao();
	}

}