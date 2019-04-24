<?php
class ControllerCheckIn extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar CheckIn
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCheckIn($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCheckIn($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oLinha = new Linha($linha_id);
		$oCheckIn = new CheckIn($id,$posicaoAtual,$oLinha,$latitude,$longitude);
		$oCheckInBD = new CheckInBD();
		if(!$oCheckInBD->cadastrar($oCheckIn)){
			$this->msg = $oCheckInBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de CheckIn
	 *
	 * @access public
	 * @param CheckIn $oCheckIn
	 * @return bool
	 */
	public function alterar($oCheckIn = NULL){
		if($oCheckIn == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCheckIn(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCheckIn($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oLinha = new Linha($linha_id);
			$oCheckIn = new CheckIn($id,$posicaoAtual,$oLinha,$latitude,$longitude);
		}		
		$oCheckInBD = new CheckInBD();
		if(!$oCheckInBD->alterar($oCheckIn)){
			$this->msg = $oCheckInBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir CheckIn
	 *
	 * @access public
	 * @param integer $idCheckIn
	 * @return bool
	 */
	public function excluir($idCheckIn){		
		$oCheckInBD = new CheckInBD();		
		if(!$oCheckInBD->excluir($idCheckIn)){
			$this->msg = $oCheckInBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de CheckIn
	 *
	 * @access public
	 * @param integer $id
	 * @return CheckIn
	 */
	public function get($id){
		$oCheckInBD = new CheckInBD();
		if($oCheckInBD->msg != ''){
			$this->msg = $oCheckInBD->msg;
			return false;
		}
		if(!$obj = $oCheckInBD->get($id)){
		    $this->msg = $oCheckInBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de CheckIn
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return CheckIn[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCheckInBD = new CheckInBD();
			$aux = $oCheckInBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCheckInBD->msg != ''){
				$this->msg = $oCheckInBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de CheckIn
	 *
	 * @access public
	 * @param string $valor
	 * @return CheckIn
	 */
	public function consultar($valor){
		$oCheckInBD = new CheckInBD();	
		return $oCheckInBD->consultar($valor);
	}

	/**
	 * Total de registros de CheckIn
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCheckInBD = new CheckInBD();
		return $oCheckInBD->totalColecao();
	}

}