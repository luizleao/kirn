<?php
class ControllerBgdMapaDeConsultas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdMapaDeConsultas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdMapaDeConsultas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdMapaDeConsultas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade);
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdMapaDeConsultas = new BgdMapaDeConsultas($id,$data_captura,$latDestino,$latOrigem,$lngDestino,$lngOrigem,$oBgdCidade,$oBgdCidade,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();
		if(!$oBgdMapaDeConsultasBD->cadastrar($oBgdMapaDeConsultas)){
			$this->msg = $oBgdMapaDeConsultasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdMapaDeConsultas
	 *
	 * @access public
	 * @param BgdMapaDeConsultas $oBgdMapaDeConsultas
	 * @return bool
	 */
	public function alterar($oBgdMapaDeConsultas = NULL){
		if($oBgdMapaDeConsultas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdMapaDeConsultas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdMapaDeConsultas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade);
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdMapaDeConsultas = new BgdMapaDeConsultas($id,$data_captura,$latDestino,$latOrigem,$lngDestino,$lngOrigem,$oBgdCidade,$oBgdCidade,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();
		if(!$oBgdMapaDeConsultasBD->alterar($oBgdMapaDeConsultas)){
			$this->msg = $oBgdMapaDeConsultasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdMapaDeConsultas
	 *
	 * @access public
	 * @param integer $idBgdMapaDeConsultas
	 * @return bool
	 */
	public function excluir($idBgdMapaDeConsultas){		
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();		
		if(!$oBgdMapaDeConsultasBD->excluir($idBgdMapaDeConsultas)){
			$this->msg = $oBgdMapaDeConsultasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdMapaDeConsultas
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdMapaDeConsultas
	 */
	public function get($id){
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();
		if($oBgdMapaDeConsultasBD->msg != ''){
			$this->msg = $oBgdMapaDeConsultasBD->msg;
			return false;
		}
		if(!$obj = $oBgdMapaDeConsultasBD->get($id)){
		    $this->msg = $oBgdMapaDeConsultasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdMapaDeConsultas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdMapaDeConsultas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();
			$aux = $oBgdMapaDeConsultasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdMapaDeConsultasBD->msg != ''){
				$this->msg = $oBgdMapaDeConsultasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdMapaDeConsultas
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdMapaDeConsultas
	 */
	public function consultar($valor){
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();	
		return $oBgdMapaDeConsultasBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdMapaDeConsultas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdMapaDeConsultasBD = new BgdMapaDeConsultasBD();
		return $oBgdMapaDeConsultasBD->totalColecao();
	}

}