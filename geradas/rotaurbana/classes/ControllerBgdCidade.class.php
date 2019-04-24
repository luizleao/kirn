<?php
class ControllerBgdCidade extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdCidade
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdCidade($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdCidade($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($id,$nome);
		$oBgdCidadeBD = new BgdCidadeBD();
		if(!$oBgdCidadeBD->cadastrar($oBgdCidade)){
			$this->msg = $oBgdCidadeBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdCidade
	 *
	 * @access public
	 * @param BgdCidade $oBgdCidade
	 * @return bool
	 */
	public function alterar($oBgdCidade = NULL){
		if($oBgdCidade == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdCidade(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdCidade($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($id,$nome);
		}		
		$oBgdCidadeBD = new BgdCidadeBD();
		if(!$oBgdCidadeBD->alterar($oBgdCidade)){
			$this->msg = $oBgdCidadeBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdCidade
	 *
	 * @access public
	 * @param integer $idBgdCidade
	 * @return bool
	 */
	public function excluir($idBgdCidade){		
		$oBgdCidadeBD = new BgdCidadeBD();		
		if(!$oBgdCidadeBD->excluir($idBgdCidade)){
			$this->msg = $oBgdCidadeBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdCidade
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdCidade
	 */
	public function get($id){
		$oBgdCidadeBD = new BgdCidadeBD();
		if($oBgdCidadeBD->msg != ''){
			$this->msg = $oBgdCidadeBD->msg;
			return false;
		}
		if(!$obj = $oBgdCidadeBD->get($id)){
		    $this->msg = $oBgdCidadeBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdCidade
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdCidade[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdCidadeBD = new BgdCidadeBD();
			$aux = $oBgdCidadeBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdCidadeBD->msg != ''){
				$this->msg = $oBgdCidadeBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdCidade
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdCidade
	 */
	public function consultar($valor){
		$oBgdCidadeBD = new BgdCidadeBD();	
		return $oBgdCidadeBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdCidade
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdCidadeBD = new BgdCidadeBD();
		return $oBgdCidadeBD->totalColecao();
	}

}