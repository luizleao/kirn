<?php
class ControllerVAR extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar VAR
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formVAR($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormVAR($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($idmadante);
		$oTIME = new TIME($idvisitante);
		$oPARTIDA = new PARTIDA($oTIME);
		$oVAR = new VAR($id,$oPARTIDA);
		$oVARBD = new VARBD();
		if(!$oVARBD->cadastrar($oVAR)){
			$this->msg = $oVARBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de VAR
	 *
	 * @access public
	 * @param VAR $oVAR
	 * @return bool
	 */
	public function alterar($oVAR = NULL){
		if($oVAR == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formVAR(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormVAR($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($idmadante);
			$oTIME = new TIME($idvisitante);
			$oPARTIDA = new PARTIDA($oTIME);
			$oVAR = new VAR($id,$oPARTIDA);
		}		
		$oVARBD = new VARBD();
		if(!$oVARBD->alterar($oVAR)){
			$this->msg = $oVARBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir VAR
	 *
	 * @access public
	 * @param integer $idVAR
	 * @return bool
	 */
	public function excluir($idVAR){		
		$oVARBD = new VARBD();		
		if(!$oVARBD->excluir($idVAR)){
			$this->msg = $oVARBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de VAR
	 *
	 * @access public
	 * @param integer $id
	 * @param integer $PARTIDA_id
	 * @return VAR
	 */
	public function get($id,$PARTIDA_id){
		$oVARBD = new VARBD();
		if($oVARBD->msg != ''){
			$this->msg = $oVARBD->msg;
			return false;
		}
		if(!$obj = $oVARBD->get($id,$PARTIDA_id)){
		    $this->msg = $oVARBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de VAR
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return VAR[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oVARBD = new VARBD();
			$aux = $oVARBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oVARBD->msg != ''){
				$this->msg = $oVARBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de VAR
	 *
	 * @access public
	 * @param string $valor
	 * @return VAR
	 */
	public function consultar($valor){
		$oVARBD = new VARBD();	
		return $oVARBD->consultar($valor);
	}

	/**
	 * Total de registros de VAR
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oVARBD = new VARBD();
		return $oVARBD->totalColecao();
	}

}