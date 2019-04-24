<?php
class ControllerPARTIDA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PARTIDA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPARTIDA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPARTIDA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($idmadante);
		$oTIME = new TIME($idvisitante);
		$oPARTIDA = new PARTIDA($id,$oTIME,$oTIME);
		$oPARTIDABD = new PARTIDABD();
		if(!$oPARTIDABD->cadastrar($oPARTIDA)){
			$this->msg = $oPARTIDABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PARTIDA
	 *
	 * @access public
	 * @param PARTIDA $oPARTIDA
	 * @return bool
	 */
	public function alterar($oPARTIDA = NULL){
		if($oPARTIDA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPARTIDA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPARTIDA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($idmadante);
			$oTIME = new TIME($idvisitante);
			$oPARTIDA = new PARTIDA($id,$oTIME,$oTIME);
		}		
		$oPARTIDABD = new PARTIDABD();
		if(!$oPARTIDABD->alterar($oPARTIDA)){
			$this->msg = $oPARTIDABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PARTIDA
	 *
	 * @access public
	 * @param integer $idPARTIDA
	 * @return bool
	 */
	public function excluir($idPARTIDA){		
		$oPARTIDABD = new PARTIDABD();		
		if(!$oPARTIDABD->excluir($idPARTIDA)){
			$this->msg = $oPARTIDABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PARTIDA
	 *
	 * @access public
	 * @param integer $id
	 * @param integer $idmadante
	 * @param integer $idvisitante
	 * @return PARTIDA
	 */
	public function get($id,$idmadante,$idvisitante){
		$oPARTIDABD = new PARTIDABD();
		if($oPARTIDABD->msg != ''){
			$this->msg = $oPARTIDABD->msg;
			return false;
		}
		if(!$obj = $oPARTIDABD->get($id,$idmadante,$idvisitante)){
		    $this->msg = $oPARTIDABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PARTIDA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PARTIDA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPARTIDABD = new PARTIDABD();
			$aux = $oPARTIDABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPARTIDABD->msg != ''){
				$this->msg = $oPARTIDABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PARTIDA
	 *
	 * @access public
	 * @param string $valor
	 * @return PARTIDA
	 */
	public function consultar($valor){
		$oPARTIDABD = new PARTIDABD();	
		return $oPARTIDABD->consultar($valor);
	}

	/**
	 * Total de registros de PARTIDA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPARTIDABD = new PARTIDABD();
		return $oPARTIDABD->totalColecao();
	}

}