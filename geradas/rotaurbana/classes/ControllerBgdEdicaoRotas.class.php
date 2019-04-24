<?php
class ControllerBgdEdicaoRotas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdEdicaoRotas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdEdicaoRotas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdEdicaoRotas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade);
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdLinha = new BgdLinha($fk_bgd_linha);
		$oBgdUsuario = new BgdUsuario($fk_bgd_usuario);
		$oBgdEdicaoRotas = new BgdEdicaoRotas($id,$codigoLinha,$comentarioLinha,$data_captura,$nomeLinhas,$oBgdCidade,$oBgdCidade,$oBgdLinha,$oBgdUsuario,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();
		if(!$oBgdEdicaoRotasBD->cadastrar($oBgdEdicaoRotas)){
			$this->msg = $oBgdEdicaoRotasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdEdicaoRotas
	 *
	 * @access public
	 * @param BgdEdicaoRotas $oBgdEdicaoRotas
	 * @return bool
	 */
	public function alterar($oBgdEdicaoRotas = NULL){
		if($oBgdEdicaoRotas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdEdicaoRotas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdEdicaoRotas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade);
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdLinha = new BgdLinha($fk_bgd_linha);
			$oBgdUsuario = new BgdUsuario($fk_bgd_usuario);
			$oBgdEdicaoRotas = new BgdEdicaoRotas($id,$codigoLinha,$comentarioLinha,$data_captura,$nomeLinhas,$oBgdCidade,$oBgdCidade,$oBgdLinha,$oBgdUsuario,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();
		if(!$oBgdEdicaoRotasBD->alterar($oBgdEdicaoRotas)){
			$this->msg = $oBgdEdicaoRotasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdEdicaoRotas
	 *
	 * @access public
	 * @param integer $idBgdEdicaoRotas
	 * @return bool
	 */
	public function excluir($idBgdEdicaoRotas){		
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();		
		if(!$oBgdEdicaoRotasBD->excluir($idBgdEdicaoRotas)){
			$this->msg = $oBgdEdicaoRotasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdEdicaoRotas
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdEdicaoRotas
	 */
	public function get($id){
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();
		if($oBgdEdicaoRotasBD->msg != ''){
			$this->msg = $oBgdEdicaoRotasBD->msg;
			return false;
		}
		if(!$obj = $oBgdEdicaoRotasBD->get($id)){
		    $this->msg = $oBgdEdicaoRotasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdEdicaoRotas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdEdicaoRotas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();
			$aux = $oBgdEdicaoRotasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdEdicaoRotasBD->msg != ''){
				$this->msg = $oBgdEdicaoRotasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdEdicaoRotas
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdEdicaoRotas
	 */
	public function consultar($valor){
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();	
		return $oBgdEdicaoRotasBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdEdicaoRotas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdEdicaoRotasBD = new BgdEdicaoRotasBD();
		return $oBgdEdicaoRotasBD->totalColecao();
	}

}