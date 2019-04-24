<?php
class ControllerBgdEdicaoParada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdEdicaoParada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdEdicaoParada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdEdicaoParada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($bgd_cidade);
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdParada = new BgdParada($fk_bgd_parada);
		$oBgdEdicaoParada = new BgdEdicaoParada($id,$commentsParada,$data_captura,$titleParada,$oBgdCidade,$oBgdCidade,$oBgdParada,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();
		if(!$oBgdEdicaoParadaBD->cadastrar($oBgdEdicaoParada)){
			$this->msg = $oBgdEdicaoParadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdEdicaoParada
	 *
	 * @access public
	 * @param BgdEdicaoParada $oBgdEdicaoParada
	 * @return bool
	 */
	public function alterar($oBgdEdicaoParada = NULL){
		if($oBgdEdicaoParada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdEdicaoParada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdEdicaoParada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($bgd_cidade);
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdParada = new BgdParada($fk_bgd_parada);
			$oBgdEdicaoParada = new BgdEdicaoParada($id,$commentsParada,$data_captura,$titleParada,$oBgdCidade,$oBgdCidade,$oBgdParada,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();
		if(!$oBgdEdicaoParadaBD->alterar($oBgdEdicaoParada)){
			$this->msg = $oBgdEdicaoParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdEdicaoParada
	 *
	 * @access public
	 * @param integer $idBgdEdicaoParada
	 * @return bool
	 */
	public function excluir($idBgdEdicaoParada){		
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();		
		if(!$oBgdEdicaoParadaBD->excluir($idBgdEdicaoParada)){
			$this->msg = $oBgdEdicaoParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdEdicaoParada
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdEdicaoParada
	 */
	public function get($id){
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();
		if($oBgdEdicaoParadaBD->msg != ''){
			$this->msg = $oBgdEdicaoParadaBD->msg;
			return false;
		}
		if(!$obj = $oBgdEdicaoParadaBD->get($id)){
		    $this->msg = $oBgdEdicaoParadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdEdicaoParada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdEdicaoParada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();
			$aux = $oBgdEdicaoParadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdEdicaoParadaBD->msg != ''){
				$this->msg = $oBgdEdicaoParadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdEdicaoParada
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdEdicaoParada
	 */
	public function consultar($valor){
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();	
		return $oBgdEdicaoParadaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdEdicaoParada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdEdicaoParadaBD = new BgdEdicaoParadaBD();
		return $oBgdEdicaoParadaBD->totalColecao();
	}

}