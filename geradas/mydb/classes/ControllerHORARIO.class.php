<?php
class ControllerHORARIO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar HORARIO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formHORARIO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormHORARIO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
		$oHORARIO = new HORARIO($horario_inicio,$horario_fim,$oPERFILACESSO);
		$oHORARIOBD = new HORARIOBD();
		if(!$oHORARIOBD->cadastrar($oHORARIO)){
			$this->msg = $oHORARIOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de HORARIO
	 *
	 * @access public
	 * @param HORARIO $oHORARIO
	 * @return bool
	 */
	public function alterar($oHORARIO = NULL){
		if($oHORARIO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formHORARIO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormHORARIO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPERFILACESSO = new PERFILACESSO($PERFIL_ACESSO_id);
			$oHORARIO = new HORARIO($horario_inicio,$horario_fim,$oPERFILACESSO);
		}		
		$oHORARIOBD = new HORARIOBD();
		if(!$oHORARIOBD->alterar($oHORARIO)){
			$this->msg = $oHORARIOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir HORARIO
	 *
	 * @access public
	 * @param integer $idHORARIO
	 * @return bool
	 */
	public function excluir($idHORARIO){		
		$oHORARIOBD = new HORARIOBD();		
		if(!$oHORARIOBD->excluir($idHORARIO)){
			$this->msg = $oHORARIOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de HORARIO
	 *
	 * @access public

	 * @return HORARIO
	 */
	public function get(){
		$oHORARIOBD = new HORARIOBD();
		if($oHORARIOBD->msg != ''){
			$this->msg = $oHORARIOBD->msg;
			return false;
		}
		if(!$obj = $oHORARIOBD->get()){
		    $this->msg = $oHORARIOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de HORARIO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return HORARIO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oHORARIOBD = new HORARIOBD();
			$aux = $oHORARIOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oHORARIOBD->msg != ''){
				$this->msg = $oHORARIOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de HORARIO
	 *
	 * @access public
	 * @param string $valor
	 * @return HORARIO
	 */
	public function consultar($valor){
		$oHORARIOBD = new HORARIOBD();	
		return $oHORARIOBD->consultar($valor);
	}

	/**
	 * Total de registros de HORARIO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oHORARIOBD = new HORARIOBD();
		return $oHORARIOBD->totalColecao();
	}

}