<?php
class ControllerBgdRequisicaoInfoParada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdRequisicaoInfoParada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdRequisicaoInfoParada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade);
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdParada = new BgdParada($fk_bgd_parada);
		$oBgdRequisicaoInfoParada = new BgdRequisicaoInfoParada($id,$commentsParada,$data_captura,$titleParada,$oBgdCidade,$oBgdCidade,$oBgdParada,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();
		if(!$oBgdRequisicaoInfoParadaBD->cadastrar($oBgdRequisicaoInfoParada)){
			$this->msg = $oBgdRequisicaoInfoParadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @param BgdRequisicaoInfoParada $oBgdRequisicaoInfoParada
	 * @return bool
	 */
	public function alterar($oBgdRequisicaoInfoParada = NULL){
		if($oBgdRequisicaoInfoParada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdRequisicaoInfoParada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdRequisicaoInfoParada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade);
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdParada = new BgdParada($fk_bgd_parada);
			$oBgdRequisicaoInfoParada = new BgdRequisicaoInfoParada($id,$commentsParada,$data_captura,$titleParada,$oBgdCidade,$oBgdCidade,$oBgdParada,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();
		if(!$oBgdRequisicaoInfoParadaBD->alterar($oBgdRequisicaoInfoParada)){
			$this->msg = $oBgdRequisicaoInfoParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @param integer $idBgdRequisicaoInfoParada
	 * @return bool
	 */
	public function excluir($idBgdRequisicaoInfoParada){		
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();		
		if(!$oBgdRequisicaoInfoParadaBD->excluir($idBgdRequisicaoInfoParada)){
			$this->msg = $oBgdRequisicaoInfoParadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdRequisicaoInfoParada
	 */
	public function get($id){
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();
		if($oBgdRequisicaoInfoParadaBD->msg != ''){
			$this->msg = $oBgdRequisicaoInfoParadaBD->msg;
			return false;
		}
		if(!$obj = $oBgdRequisicaoInfoParadaBD->get($id)){
		    $this->msg = $oBgdRequisicaoInfoParadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdRequisicaoInfoParada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdRequisicaoInfoParada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();
			$aux = $oBgdRequisicaoInfoParadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdRequisicaoInfoParadaBD->msg != ''){
				$this->msg = $oBgdRequisicaoInfoParadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdRequisicaoInfoParada
	 */
	public function consultar($valor){
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();	
		return $oBgdRequisicaoInfoParadaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdRequisicaoInfoParada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdRequisicaoInfoParadaBD = new BgdRequisicaoInfoParadaBD();
		return $oBgdRequisicaoInfoParadaBD->totalColecao();
	}

}