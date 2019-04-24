<?php
class ControllerARBITROAUX extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar ARBITROAUX
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formARBITROAUX($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormARBITROAUX($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($idmadante);
		$oTIME = new TIME($idvisitante);
		$oPARTIDA = new PARTIDA($oTIME);
		$oARBITROAUX = new ARBITROAUX($id,$oPARTIDA);
		$oARBITROAUXBD = new ARBITROAUXBD();
		if(!$oARBITROAUXBD->cadastrar($oARBITROAUX)){
			$this->msg = $oARBITROAUXBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de ARBITROAUX
	 *
	 * @access public
	 * @param ARBITROAUX $oARBITROAUX
	 * @return bool
	 */
	public function alterar($oARBITROAUX = NULL){
		if($oARBITROAUX == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formARBITROAUX(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormARBITROAUX($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($idmadante);
			$oTIME = new TIME($idvisitante);
			$oPARTIDA = new PARTIDA($oTIME);
			$oARBITROAUX = new ARBITROAUX($id,$oPARTIDA);
		}		
		$oARBITROAUXBD = new ARBITROAUXBD();
		if(!$oARBITROAUXBD->alterar($oARBITROAUX)){
			$this->msg = $oARBITROAUXBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir ARBITROAUX
	 *
	 * @access public
	 * @param integer $idARBITROAUX
	 * @return bool
	 */
	public function excluir($idARBITROAUX){		
		$oARBITROAUXBD = new ARBITROAUXBD();		
		if(!$oARBITROAUXBD->excluir($idARBITROAUX)){
			$this->msg = $oARBITROAUXBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de ARBITROAUX
	 *
	 * @access public
	 * @param integer $id
	 * @param integer $PARTIDA_id
	 * @return ARBITROAUX
	 */
	public function get($id,$PARTIDA_id){
		$oARBITROAUXBD = new ARBITROAUXBD();
		if($oARBITROAUXBD->msg != ''){
			$this->msg = $oARBITROAUXBD->msg;
			return false;
		}
		if(!$obj = $oARBITROAUXBD->get($id,$PARTIDA_id)){
		    $this->msg = $oARBITROAUXBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de ARBITROAUX
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return ARBITROAUX[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oARBITROAUXBD = new ARBITROAUXBD();
			$aux = $oARBITROAUXBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oARBITROAUXBD->msg != ''){
				$this->msg = $oARBITROAUXBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de ARBITROAUX
	 *
	 * @access public
	 * @param string $valor
	 * @return ARBITROAUX
	 */
	public function consultar($valor){
		$oARBITROAUXBD = new ARBITROAUXBD();	
		return $oARBITROAUXBD->consultar($valor);
	}

	/**
	 * Total de registros de ARBITROAUX
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oARBITROAUXBD = new ARBITROAUXBD();
		return $oARBITROAUXBD->totalColecao();
	}

}