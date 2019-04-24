<?php
class ControllerLogVoicer extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar LogVoicer
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formLogVoicer($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormLogVoicer($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oLogVoicer = new LogVoicer($id,$compreendido,$idUsuario,$menuAtual,$momento,$resultado);
		$oLogVoicerBD = new LogVoicerBD();
		if(!$oLogVoicerBD->cadastrar($oLogVoicer)){
			$this->msg = $oLogVoicerBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de LogVoicer
	 *
	 * @access public
	 * @param LogVoicer $oLogVoicer
	 * @return bool
	 */
	public function alterar($oLogVoicer = NULL){
		if($oLogVoicer == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formLogVoicer(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormLogVoicer($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oLogVoicer = new LogVoicer($id,$compreendido,$idUsuario,$menuAtual,$momento,$resultado);
		}		
		$oLogVoicerBD = new LogVoicerBD();
		if(!$oLogVoicerBD->alterar($oLogVoicer)){
			$this->msg = $oLogVoicerBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir LogVoicer
	 *
	 * @access public
	 * @param integer $idLogVoicer
	 * @return bool
	 */
	public function excluir($idLogVoicer){		
		$oLogVoicerBD = new LogVoicerBD();		
		if(!$oLogVoicerBD->excluir($idLogVoicer)){
			$this->msg = $oLogVoicerBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de LogVoicer
	 *
	 * @access public
	 * @param integer $id
	 * @return LogVoicer
	 */
	public function get($id){
		$oLogVoicerBD = new LogVoicerBD();
		if($oLogVoicerBD->msg != ''){
			$this->msg = $oLogVoicerBD->msg;
			return false;
		}
		if(!$obj = $oLogVoicerBD->get($id)){
		    $this->msg = $oLogVoicerBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de LogVoicer
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return LogVoicer[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oLogVoicerBD = new LogVoicerBD();
			$aux = $oLogVoicerBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oLogVoicerBD->msg != ''){
				$this->msg = $oLogVoicerBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de LogVoicer
	 *
	 * @access public
	 * @param string $valor
	 * @return LogVoicer
	 */
	public function consultar($valor){
		$oLogVoicerBD = new LogVoicerBD();	
		return $oLogVoicerBD->consultar($valor);
	}

	/**
	 * Total de registros de LogVoicer
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oLogVoicerBD = new LogVoicerBD();
		return $oLogVoicerBD->totalColecao();
	}

}