<?php
class ControllerHibernateSequence extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar HibernateSequence
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formHibernateSequence($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormHibernateSequence($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oHibernateSequence = new HibernateSequence($next_val);
		$oHibernateSequenceBD = new HibernateSequenceBD();
		if(!$oHibernateSequenceBD->cadastrar($oHibernateSequence)){
			$this->msg = $oHibernateSequenceBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de HibernateSequence
	 *
	 * @access public
	 * @param HibernateSequence $oHibernateSequence
	 * @return bool
	 */
	public function alterar($oHibernateSequence = NULL){
		if($oHibernateSequence == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formHibernateSequence(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormHibernateSequence($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oHibernateSequence = new HibernateSequence($next_val);
		}		
		$oHibernateSequenceBD = new HibernateSequenceBD();
		if(!$oHibernateSequenceBD->alterar($oHibernateSequence)){
			$this->msg = $oHibernateSequenceBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir HibernateSequence
	 *
	 * @access public
	 * @param integer $idHibernateSequence
	 * @return bool
	 */
	public function excluir($idHibernateSequence){		
		$oHibernateSequenceBD = new HibernateSequenceBD();		
		if(!$oHibernateSequenceBD->excluir($idHibernateSequence)){
			$this->msg = $oHibernateSequenceBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de HibernateSequence
	 *
	 * @access public

	 * @return HibernateSequence
	 */
	public function get(){
		$oHibernateSequenceBD = new HibernateSequenceBD();
		if($oHibernateSequenceBD->msg != ''){
			$this->msg = $oHibernateSequenceBD->msg;
			return false;
		}
		if(!$obj = $oHibernateSequenceBD->get()){
		    $this->msg = $oHibernateSequenceBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de HibernateSequence
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return HibernateSequence[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oHibernateSequenceBD = new HibernateSequenceBD();
			$aux = $oHibernateSequenceBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oHibernateSequenceBD->msg != ''){
				$this->msg = $oHibernateSequenceBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de HibernateSequence
	 *
	 * @access public
	 * @param string $valor
	 * @return HibernateSequence
	 */
	public function consultar($valor){
		$oHibernateSequenceBD = new HibernateSequenceBD();	
		return $oHibernateSequenceBD->consultar($valor);
	}

	/**
	 * Total de registros de HibernateSequence
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oHibernateSequenceBD = new HibernateSequenceBD();
		return $oHibernateSequenceBD->totalColecao();
	}

}