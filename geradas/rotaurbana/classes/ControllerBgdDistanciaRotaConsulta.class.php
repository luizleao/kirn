<?php
class ControllerBgdDistanciaRotaConsulta extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdDistanciaRotaConsulta($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdDistanciaRotaConsulta($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade);
		$oBgdLinha = new BgdLinha($fk_bgd_linha);
		$oBgdDistanciaRotaConsulta = new BgdDistanciaRotaConsulta($id,$data_captura,$distancia,$oBgdCidade,$oBgdLinha,$fonte);
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();
		if(!$oBgdDistanciaRotaConsultaBD->cadastrar($oBgdDistanciaRotaConsulta)){
			$this->msg = $oBgdDistanciaRotaConsultaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @param BgdDistanciaRotaConsulta $oBgdDistanciaRotaConsulta
	 * @return bool
	 */
	public function alterar($oBgdDistanciaRotaConsulta = NULL){
		if($oBgdDistanciaRotaConsulta == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdDistanciaRotaConsulta(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdDistanciaRotaConsulta($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade);
			$oBgdLinha = new BgdLinha($fk_bgd_linha);
			$oBgdDistanciaRotaConsulta = new BgdDistanciaRotaConsulta($id,$data_captura,$distancia,$oBgdCidade,$oBgdLinha,$fonte);
		}		
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();
		if(!$oBgdDistanciaRotaConsultaBD->alterar($oBgdDistanciaRotaConsulta)){
			$this->msg = $oBgdDistanciaRotaConsultaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @param integer $idBgdDistanciaRotaConsulta
	 * @return bool
	 */
	public function excluir($idBgdDistanciaRotaConsulta){		
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();		
		if(!$oBgdDistanciaRotaConsultaBD->excluir($idBgdDistanciaRotaConsulta)){
			$this->msg = $oBgdDistanciaRotaConsultaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdDistanciaRotaConsulta
	 */
	public function get($id){
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();
		if($oBgdDistanciaRotaConsultaBD->msg != ''){
			$this->msg = $oBgdDistanciaRotaConsultaBD->msg;
			return false;
		}
		if(!$obj = $oBgdDistanciaRotaConsultaBD->get($id)){
		    $this->msg = $oBgdDistanciaRotaConsultaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdDistanciaRotaConsulta
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdDistanciaRotaConsulta[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();
			$aux = $oBgdDistanciaRotaConsultaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdDistanciaRotaConsultaBD->msg != ''){
				$this->msg = $oBgdDistanciaRotaConsultaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdDistanciaRotaConsulta
	 */
	public function consultar($valor){
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();	
		return $oBgdDistanciaRotaConsultaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdDistanciaRotaConsulta
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdDistanciaRotaConsultaBD = new BgdDistanciaRotaConsultaBD();
		return $oBgdDistanciaRotaConsultaBD->totalColecao();
	}

}