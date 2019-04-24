<?php
class ControllerParada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Parada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formParada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormParada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oParada = new Parada($id,$latitude,$longitude,$status,$comments,$title,$tipoDeRotaDaParada);
		$oParadaBD = new ParadaBD();
		if(!$oParadaBD->cadastrar($oParada)){
			$this->msg = $oParadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Parada
	 *
	 * @access public
	 * @param Parada $oParada
	 * @return bool
	 */
	public function alterar($oParada = NULL){
		if($oParada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formParada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormParada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oParada = new Parada($id,$latitude,$longitude,$status,$comments,$title,$tipoDeRotaDaParada);
		}		
		$oParadaBD = new ParadaBD();
		if(!$oParadaBD->alterar($oParada)){
			$this->msg = $oParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Parada
	 *
	 * @access public
	 * @param integer $idParada
	 * @return bool
	 */
	public function excluir($idParada){		
		$oParadaBD = new ParadaBD();		
		if(!$oParadaBD->excluir($idParada)){
			$this->msg = $oParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Parada
	 *
	 * @access public
	 * @param integer $id
	 * @return Parada
	 */
	public function get($id){
		$oParadaBD = new ParadaBD();
		if($oParadaBD->msg != ''){
			$this->msg = $oParadaBD->msg;
			return false;
		}
		if(!$obj = $oParadaBD->get($id)){
		    $this->msg = $oParadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Parada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Parada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oParadaBD = new ParadaBD();
			$aux = $oParadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oParadaBD->msg != ''){
				$this->msg = $oParadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Parada
	 *
	 * @access public
	 * @param string $valor
	 * @return Parada
	 */
	public function consultar($valor){
		$oParadaBD = new ParadaBD();	
		return $oParadaBD->consultar($valor);
	}

	/**
	 * Total de registros de Parada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oParadaBD = new ParadaBD();
		return $oParadaBD->totalColecao();
	}

}