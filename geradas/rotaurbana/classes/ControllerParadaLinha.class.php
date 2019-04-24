<?php
class ControllerParadaLinha extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar ParadaLinha
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formParadaLinha($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormParadaLinha($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oParadaLinha = new ParadaLinha($paradas_id,$linha_id);
		$oParadaLinhaBD = new ParadaLinhaBD();
		if(!$oParadaLinhaBD->cadastrar($oParadaLinha)){
			$this->msg = $oParadaLinhaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de ParadaLinha
	 *
	 * @access public
	 * @param ParadaLinha $oParadaLinha
	 * @return bool
	 */
	public function alterar($oParadaLinha = NULL){
		if($oParadaLinha == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formParadaLinha(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormParadaLinha($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oParadaLinha = new ParadaLinha($paradas_id,$linha_id);
		}		
		$oParadaLinhaBD = new ParadaLinhaBD();
		if(!$oParadaLinhaBD->alterar($oParadaLinha)){
			$this->msg = $oParadaLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir ParadaLinha
	 *
	 * @access public
	 * @param integer $idParadaLinha
	 * @return bool
	 */
	public function excluir($idParadaLinha){		
		$oParadaLinhaBD = new ParadaLinhaBD();		
		if(!$oParadaLinhaBD->excluir($idParadaLinha)){
			$this->msg = $oParadaLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de ParadaLinha
	 *
	 * @access public

	 * @return ParadaLinha
	 */
	public function get(){
		$oParadaLinhaBD = new ParadaLinhaBD();
		if($oParadaLinhaBD->msg != ''){
			$this->msg = $oParadaLinhaBD->msg;
			return false;
		}
		if(!$obj = $oParadaLinhaBD->get()){
		    $this->msg = $oParadaLinhaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de ParadaLinha
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return ParadaLinha[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oParadaLinhaBD = new ParadaLinhaBD();
			$aux = $oParadaLinhaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oParadaLinhaBD->msg != ''){
				$this->msg = $oParadaLinhaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de ParadaLinha
	 *
	 * @access public
	 * @param string $valor
	 * @return ParadaLinha
	 */
	public function consultar($valor){
		$oParadaLinhaBD = new ParadaLinhaBD();	
		return $oParadaLinhaBD->consultar($valor);
	}

	/**
	 * Total de registros de ParadaLinha
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oParadaLinhaBD = new ParadaLinhaBD();
		return $oParadaLinhaBD->totalColecao();
	}

}