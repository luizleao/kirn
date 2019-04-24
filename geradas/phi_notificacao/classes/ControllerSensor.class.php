<?php
class ControllerSensor extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Sensor
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formSensor($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormSensor($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSensor = new Sensor($id_sensor,$localizacao,$descricao);
		$oSensorBD = new SensorBD();
		if(!$oSensorBD->cadastrar($oSensor)){
			$this->msg = $oSensorBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Sensor
	 *
	 * @access public
	 * @param Sensor $oSensor
	 * @return bool
	 */
	public function alterar($oSensor = NULL){
		if($oSensor == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formSensor(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormSensor($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSensor = new Sensor($id_sensor,$localizacao,$descricao);
		}		
		$oSensorBD = new SensorBD();
		if(!$oSensorBD->alterar($oSensor)){
			$this->msg = $oSensorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Sensor
	 *
	 * @access public
	 * @param integer $idSensor
	 * @return bool
	 */
	public function excluir($idSensor){		
		$oSensorBD = new SensorBD();		
		if(!$oSensorBD->excluir($idSensor)){
			$this->msg = $oSensorBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Sensor
	 *
	 * @access public
	 * @param integer $id_sensor
	 * @return Sensor
	 */
	public function get($id_sensor){
		$oSensorBD = new SensorBD();
		if($oSensorBD->msg != ''){
			$this->msg = $oSensorBD->msg;
			return false;
		}
		if(!$obj = $oSensorBD->get($id_sensor)){
		    $this->msg = $oSensorBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Sensor
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Sensor[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oSensorBD = new SensorBD();
			$aux = $oSensorBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oSensorBD->msg != ''){
				$this->msg = $oSensorBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Sensor
	 *
	 * @access public
	 * @param string $valor
	 * @return Sensor
	 */
	public function consultar($valor){
		$oSensorBD = new SensorBD();	
		return $oSensorBD->consultar($valor);
	}

	/**
	 * Total de registros de Sensor
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oSensorBD = new SensorBD();
		return $oSensorBD->totalColecao();
	}

}