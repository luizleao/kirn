<?php
class ControllerMapaDeConsultas extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar MapaDeConsultas
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formMapaDeConsultas($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormMapaDeConsultas($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oCidade = new Cidade($cidade_id);
		$oMapaDeConsultas = new MapaDeConsultas($id,$latDestino,$latOrigem,$lngDestino,$lngOrigem,$dataBusca,$oCidade);
		$oMapaDeConsultasBD = new MapaDeConsultasBD();
		if(!$oMapaDeConsultasBD->cadastrar($oMapaDeConsultas)){
			$this->msg = $oMapaDeConsultasBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de MapaDeConsultas
	 *
	 * @access public
	 * @param MapaDeConsultas $oMapaDeConsultas
	 * @return bool
	 */
	public function alterar($oMapaDeConsultas = NULL){
		if($oMapaDeConsultas == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formMapaDeConsultas(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormMapaDeConsultas($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oCidade = new Cidade($cidade_id);
			$oMapaDeConsultas = new MapaDeConsultas($id,$latDestino,$latOrigem,$lngDestino,$lngOrigem,$dataBusca,$oCidade);
		}		
		$oMapaDeConsultasBD = new MapaDeConsultasBD();
		if(!$oMapaDeConsultasBD->alterar($oMapaDeConsultas)){
			$this->msg = $oMapaDeConsultasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir MapaDeConsultas
	 *
	 * @access public
	 * @param integer $idMapaDeConsultas
	 * @return bool
	 */
	public function excluir($idMapaDeConsultas){		
		$oMapaDeConsultasBD = new MapaDeConsultasBD();		
		if(!$oMapaDeConsultasBD->excluir($idMapaDeConsultas)){
			$this->msg = $oMapaDeConsultasBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de MapaDeConsultas
	 *
	 * @access public
	 * @param integer $id
	 * @return MapaDeConsultas
	 */
	public function get($id){
		$oMapaDeConsultasBD = new MapaDeConsultasBD();
		if($oMapaDeConsultasBD->msg != ''){
			$this->msg = $oMapaDeConsultasBD->msg;
			return false;
		}
		if(!$obj = $oMapaDeConsultasBD->get($id)){
		    $this->msg = $oMapaDeConsultasBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de MapaDeConsultas
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return MapaDeConsultas[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oMapaDeConsultasBD = new MapaDeConsultasBD();
			$aux = $oMapaDeConsultasBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oMapaDeConsultasBD->msg != ''){
				$this->msg = $oMapaDeConsultasBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de MapaDeConsultas
	 *
	 * @access public
	 * @param string $valor
	 * @return MapaDeConsultas
	 */
	public function consultar($valor){
		$oMapaDeConsultasBD = new MapaDeConsultasBD();	
		return $oMapaDeConsultasBD->consultar($valor);
	}

	/**
	 * Total de registros de MapaDeConsultas
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oMapaDeConsultasBD = new MapaDeConsultasBD();
		return $oMapaDeConsultasBD->totalColecao();
	}

}