<?php
class ControllerJOGADOR extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar JOGADOR
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formJOGADOR($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormJOGADOR($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTIME = new TIME($TIME_id);
		$oJOGADOR = new JOGADOR($cpf,$nome,$n_camisa,$status,$oTIME);
		$oJOGADORBD = new JOGADORBD();
		if(!$oJOGADORBD->cadastrar($oJOGADOR)){
			$this->msg = $oJOGADORBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de JOGADOR
	 *
	 * @access public
	 * @param JOGADOR $oJOGADOR
	 * @return bool
	 */
	public function alterar($oJOGADOR = NULL){
		if($oJOGADOR == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formJOGADOR(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormJOGADOR($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTIME = new TIME($TIME_id);
			$oJOGADOR = new JOGADOR($cpf,$nome,$n_camisa,$status,$oTIME);
		}		
		$oJOGADORBD = new JOGADORBD();
		if(!$oJOGADORBD->alterar($oJOGADOR)){
			$this->msg = $oJOGADORBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir JOGADOR
	 *
	 * @access public
	 * @param integer $idJOGADOR
	 * @return bool
	 */
	public function excluir($idJOGADOR){		
		$oJOGADORBD = new JOGADORBD();		
		if(!$oJOGADORBD->excluir($idJOGADOR)){
			$this->msg = $oJOGADORBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de JOGADOR
	 *
	 * @access public
	 * @param integer $cpf
	 * @return JOGADOR
	 */
	public function get($cpf){
		$oJOGADORBD = new JOGADORBD();
		if($oJOGADORBD->msg != ''){
			$this->msg = $oJOGADORBD->msg;
			return false;
		}
		if(!$obj = $oJOGADORBD->get($cpf)){
		    $this->msg = $oJOGADORBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de JOGADOR
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return JOGADOR[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oJOGADORBD = new JOGADORBD();
			$aux = $oJOGADORBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oJOGADORBD->msg != ''){
				$this->msg = $oJOGADORBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de JOGADOR
	 *
	 * @access public
	 * @param string $valor
	 * @return JOGADOR
	 */
	public function consultar($valor){
		$oJOGADORBD = new JOGADORBD();	
		return $oJOGADORBD->consultar($valor);
	}

	/**
	 * Total de registros de JOGADOR
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oJOGADORBD = new JOGADORBD();
		return $oJOGADORBD->totalColecao();
	}

}