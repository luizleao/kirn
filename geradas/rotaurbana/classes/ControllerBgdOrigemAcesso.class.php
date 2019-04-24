<?php
class ControllerBgdOrigemAcesso extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdOrigemAcesso
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdOrigemAcesso($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdOrigemAcesso($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdOrigemAcesso = new BgdOrigemAcesso($id,$data_captura,$lat_proxma_usuario,$lng_proxma_usuario,$origem_acesso,$oBgdCidade,$fonte);
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();
		if(!$oBgdOrigemAcessoBD->cadastrar($oBgdOrigemAcesso)){
			$this->msg = $oBgdOrigemAcessoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdOrigemAcesso
	 *
	 * @access public
	 * @param BgdOrigemAcesso $oBgdOrigemAcesso
	 * @return bool
	 */
	public function alterar($oBgdOrigemAcesso = NULL){
		if($oBgdOrigemAcesso == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdOrigemAcesso(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdOrigemAcesso($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdOrigemAcesso = new BgdOrigemAcesso($id,$data_captura,$lat_proxma_usuario,$lng_proxma_usuario,$origem_acesso,$oBgdCidade,$fonte);
		}		
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();
		if(!$oBgdOrigemAcessoBD->alterar($oBgdOrigemAcesso)){
			$this->msg = $oBgdOrigemAcessoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdOrigemAcesso
	 *
	 * @access public
	 * @param integer $idBgdOrigemAcesso
	 * @return bool
	 */
	public function excluir($idBgdOrigemAcesso){		
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();		
		if(!$oBgdOrigemAcessoBD->excluir($idBgdOrigemAcesso)){
			$this->msg = $oBgdOrigemAcessoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdOrigemAcesso
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdOrigemAcesso
	 */
	public function get($id){
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();
		if($oBgdOrigemAcessoBD->msg != ''){
			$this->msg = $oBgdOrigemAcessoBD->msg;
			return false;
		}
		if(!$obj = $oBgdOrigemAcessoBD->get($id)){
		    $this->msg = $oBgdOrigemAcessoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdOrigemAcesso
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdOrigemAcesso[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();
			$aux = $oBgdOrigemAcessoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdOrigemAcessoBD->msg != ''){
				$this->msg = $oBgdOrigemAcessoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdOrigemAcesso
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdOrigemAcesso
	 */
	public function consultar($valor){
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();	
		return $oBgdOrigemAcessoBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdOrigemAcesso
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdOrigemAcessoBD = new BgdOrigemAcessoBD();
		return $oBgdOrigemAcessoBD->totalColecao();
	}

}