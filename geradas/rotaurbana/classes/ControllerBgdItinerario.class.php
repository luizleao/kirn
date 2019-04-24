<?php
class ControllerBgdItinerario extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdItinerario
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdItinerario($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdItinerario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota($fk_bgd_itinerario_oficial_de_rota_id);
		$oBgdItinerario = new BgdItinerario($oBgdItinerarioOficialDeRota,$fk_bgd_ponto_tracado_trajeto_id);
		$oBgdItinerarioBD = new BgdItinerarioBD();
		if(!$oBgdItinerarioBD->cadastrar($oBgdItinerario)){
			$this->msg = $oBgdItinerarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdItinerario
	 *
	 * @access public
	 * @param BgdItinerario $oBgdItinerario
	 * @return bool
	 */
	public function alterar($oBgdItinerario = NULL){
		if($oBgdItinerario == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdItinerario(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdItinerario($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota($fk_bgd_itinerario_oficial_de_rota_id);
			$oBgdItinerario = new BgdItinerario($oBgdItinerarioOficialDeRota,$fk_bgd_ponto_tracado_trajeto_id);
		}		
		$oBgdItinerarioBD = new BgdItinerarioBD();
		if(!$oBgdItinerarioBD->alterar($oBgdItinerario)){
			$this->msg = $oBgdItinerarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdItinerario
	 *
	 * @access public
	 * @param integer $idBgdItinerario
	 * @return bool
	 */
	public function excluir($idBgdItinerario){		
		$oBgdItinerarioBD = new BgdItinerarioBD();		
		if(!$oBgdItinerarioBD->excluir($idBgdItinerario)){
			$this->msg = $oBgdItinerarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdItinerario
	 *
	 * @access public
	 * @param integer $fk_bgd_itinerario_oficial_de_rota_id
	 * @param integer $fk_bgd_ponto_tracado_trajeto_id
	 * @return BgdItinerario
	 */
	public function get($fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id){
		$oBgdItinerarioBD = new BgdItinerarioBD();
		if($oBgdItinerarioBD->msg != ''){
			$this->msg = $oBgdItinerarioBD->msg;
			return false;
		}
		if(!$obj = $oBgdItinerarioBD->get($fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id)){
		    $this->msg = $oBgdItinerarioBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdItinerario
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdItinerario[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdItinerarioBD = new BgdItinerarioBD();
			$aux = $oBgdItinerarioBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdItinerarioBD->msg != ''){
				$this->msg = $oBgdItinerarioBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdItinerario
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdItinerario
	 */
	public function consultar($valor){
		$oBgdItinerarioBD = new BgdItinerarioBD();	
		return $oBgdItinerarioBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdItinerario
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdItinerarioBD = new BgdItinerarioBD();
		return $oBgdItinerarioBD->totalColecao();
	}

}