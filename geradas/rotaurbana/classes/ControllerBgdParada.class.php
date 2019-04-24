<?php
class ControllerBgdParada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdParada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdParada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdParada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdParada = new BgdParada($id,$comments,$latitude,$longitude,$title);
		$oBgdParadaBD = new BgdParadaBD();
		if(!$oBgdParadaBD->cadastrar($oBgdParada)){
			$this->msg = $oBgdParadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdParada
	 *
	 * @access public
	 * @param BgdParada $oBgdParada
	 * @return bool
	 */
	public function alterar($oBgdParada = NULL){
		if($oBgdParada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdParada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdParada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdParada = new BgdParada($id,$comments,$latitude,$longitude,$title);
		}		
		$oBgdParadaBD = new BgdParadaBD();
		if(!$oBgdParadaBD->alterar($oBgdParada)){
			$this->msg = $oBgdParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdParada
	 *
	 * @access public
	 * @param integer $idBgdParada
	 * @return bool
	 */
	public function excluir($idBgdParada){		
		$oBgdParadaBD = new BgdParadaBD();		
		if(!$oBgdParadaBD->excluir($idBgdParada)){
			$this->msg = $oBgdParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdParada
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdParada
	 */
	public function get($id){
		$oBgdParadaBD = new BgdParadaBD();
		if($oBgdParadaBD->msg != ''){
			$this->msg = $oBgdParadaBD->msg;
			return false;
		}
		if(!$obj = $oBgdParadaBD->get($id)){
		    $this->msg = $oBgdParadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdParada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdParada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdParadaBD = new BgdParadaBD();
			$aux = $oBgdParadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdParadaBD->msg != ''){
				$this->msg = $oBgdParadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdParada
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdParada
	 */
	public function consultar($valor){
		$oBgdParadaBD = new BgdParadaBD();	
		return $oBgdParadaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdParada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdParadaBD = new BgdParadaBD();
		return $oBgdParadaBD->totalColecao();
	}

}