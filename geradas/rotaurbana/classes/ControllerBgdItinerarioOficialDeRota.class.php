<?php
class ControllerBgdItinerarioOficialDeRota extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdItinerarioOficialDeRota($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdItinerarioOficialDeRota($post)){
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
		$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota($id,$data_captura,$oBgdCidade,$oBgdCidade,$oBgdLinha,$oBgdUsuario,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();
		if(!$oBgdItinerarioOficialDeRotaBD->cadastrar($oBgdItinerarioOficialDeRota)){
			$this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @param BgdItinerarioOficialDeRota $oBgdItinerarioOficialDeRota
	 * @return bool
	 */
	public function alterar($oBgdItinerarioOficialDeRota = NULL){
		if($oBgdItinerarioOficialDeRota == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdItinerarioOficialDeRota(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdItinerarioOficialDeRota($post,2)){
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
			$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota($id,$data_captura,$oBgdCidade,$oBgdCidade,$oBgdLinha,$oBgdUsuario,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();
		if(!$oBgdItinerarioOficialDeRotaBD->alterar($oBgdItinerarioOficialDeRota)){
			$this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @param integer $idBgdItinerarioOficialDeRota
	 * @return bool
	 */
	public function excluir($idBgdItinerarioOficialDeRota){		
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();		
		if(!$oBgdItinerarioOficialDeRotaBD->excluir($idBgdItinerarioOficialDeRota)){
			$this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdItinerarioOficialDeRota
	 */
	public function get($id){
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();
		if($oBgdItinerarioOficialDeRotaBD->msg != ''){
			$this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
			return false;
		}
		if(!$obj = $oBgdItinerarioOficialDeRotaBD->get($id)){
		    $this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdItinerarioOficialDeRota
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdItinerarioOficialDeRota[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();
			$aux = $oBgdItinerarioOficialDeRotaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdItinerarioOficialDeRotaBD->msg != ''){
				$this->msg = $oBgdItinerarioOficialDeRotaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdItinerarioOficialDeRota
	 */
	public function consultar($valor){
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();	
		return $oBgdItinerarioOficialDeRotaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdItinerarioOficialDeRota
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdItinerarioOficialDeRotaBD = new BgdItinerarioOficialDeRotaBD();
		return $oBgdItinerarioOficialDeRotaBD->totalColecao();
	}

}