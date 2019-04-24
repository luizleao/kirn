<?php
class ControllerPlantao extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Plantao
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPlantao($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPlantao($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($p_usuario_id);
		$oSensor = new Sensor($p_id_sensor);
		$oPlantao = new Plantao($p_id,$oUsuario,$oSensor,$datai,$dataf);
		$oPlantaoBD = new PlantaoBD();
		if(!$oPlantaoBD->cadastrar($oPlantao)){
			$this->msg = $oPlantaoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Plantao
	 *
	 * @access public
	 * @param Plantao $oPlantao
	 * @return bool
	 */
	public function alterar($oPlantao = NULL){
		if($oPlantao == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPlantao(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPlantao($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oUsuario = new Usuario($p_usuario_id);
			$oSensor = new Sensor($p_id_sensor);
			$oPlantao = new Plantao($p_id,$oUsuario,$oSensor,$datai,$dataf);
		}		
		$oPlantaoBD = new PlantaoBD();
		if(!$oPlantaoBD->alterar($oPlantao)){
			$this->msg = $oPlantaoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Plantao
	 *
	 * @access public
	 * @param integer $idPlantao
	 * @return bool
	 */
	public function excluir($idPlantao){		
		$oPlantaoBD = new PlantaoBD();		
		if(!$oPlantaoBD->excluir($idPlantao)){
			$this->msg = $oPlantaoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Plantao
	 *
	 * @access public
	 * @param integer $p_id
	 * @return Plantao
	 */
	public function get($p_id){
		$oPlantaoBD = new PlantaoBD();
		if($oPlantaoBD->msg != ''){
			$this->msg = $oPlantaoBD->msg;
			return false;
		}
		if(!$obj = $oPlantaoBD->get($p_id)){
		    $this->msg = $oPlantaoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Plantao
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Plantao[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPlantaoBD = new PlantaoBD();
			$aux = $oPlantaoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPlantaoBD->msg != ''){
				$this->msg = $oPlantaoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Plantao
	 *
	 * @access public
	 * @param string $valor
	 * @return Plantao
	 */
	public function consultar($valor){
		$oPlantaoBD = new PlantaoBD();	
		return $oPlantaoBD->consultar($valor);
	}

	/**
	 * Total de registros de Plantao
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPlantaoBD = new PlantaoBD();
		return $oPlantaoBD->totalColecao();
	}

}