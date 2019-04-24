<?php
class ControllerDIA extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar DIA
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formDIA($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormDIA($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oDIA = new DIA($d,$oPERFILACESSO);
		$oDIABD = new DIABD();
		if(!$oDIABD->cadastrar($oDIA)){
			$this->msg = $oDIABD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de DIA
	 *
	 * @access public
	 * @param DIA $oDIA
	 * @return bool
	 */
	public function alterar($oDIA = NULL){
		if($oDIA == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formDIA(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormDIA($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oDIA = new DIA($d,$oPERFILACESSO);
		}		
		$oDIABD = new DIABD();
		if(!$oDIABD->alterar($oDIA)){
			$this->msg = $oDIABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir DIA
	 *
	 * @access public
	 * @param integer $idDIA
	 * @return bool
	 */
	public function excluir($idDIA){		
		$oDIABD = new DIABD();		
		if(!$oDIABD->excluir($idDIA)){
			$this->msg = $oDIABD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de DIA
	 *
	 * @access public

	 * @return DIA
	 */
	public function get(){
		$oDIABD = new DIABD();
		if($oDIABD->msg != ''){
			$this->msg = $oDIABD->msg;
			return false;
		}
		if(!$obj = $oDIABD->get()){
		    $this->msg = $oDIABD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de DIA
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return DIA[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oDIABD = new DIABD();
			$aux = $oDIABD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oDIABD->msg != ''){
				$this->msg = $oDIABD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de DIA
	 *
	 * @access public
	 * @param string $valor
	 * @return DIA
	 */
	public function consultar($valor){
		$oDIABD = new DIABD();	
		return $oDIABD->consultar($valor);
	}

	/**
	 * Total de registros de DIA
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oDIABD = new DIABD();
		return $oDIABD->totalColecao();
	}

}