<?php
class ControllerBat extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Bat
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBat($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBat($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSensor = new Sensor($locasens);
		$oUsuario = new Usuario($pessoa);
		$oBat = new Bat($id_bat,$oSensor,$oUsuario,$descricao,$data,$raiva);
		$oBatBD = new BatBD();
		if(!$oBatBD->cadastrar($oBat)){
			$this->msg = $oBatBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Bat
	 *
	 * @access public
	 * @param Bat $oBat
	 * @return bool
	 */
	public function alterar($oBat = NULL){
		if($oBat == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBat(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBat($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSensor = new Sensor($locasens);
			$oUsuario = new Usuario($pessoa);
			$oBat = new Bat($id_bat,$oSensor,$oUsuario,$descricao,$data,$raiva);
		}		
		$oBatBD = new BatBD();
		if(!$oBatBD->alterar($oBat)){
			$this->msg = $oBatBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Bat
	 *
	 * @access public
	 * @param integer $idBat
	 * @return bool
	 */
	public function excluir($idBat){		
		$oBatBD = new BatBD();		
		if(!$oBatBD->excluir($idBat)){
			$this->msg = $oBatBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Bat
	 *
	 * @access public
	 * @param integer $id_bat
	 * @return Bat
	 */
	public function get($id_bat){
		$oBatBD = new BatBD();
		if($oBatBD->msg != ''){
			$this->msg = $oBatBD->msg;
			return false;
		}
		if(!$obj = $oBatBD->get($id_bat)){
		    $this->msg = $oBatBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Bat
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Bat[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBatBD = new BatBD();
			$aux = $oBatBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBatBD->msg != ''){
				$this->msg = $oBatBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Bat
	 *
	 * @access public
	 * @param string $valor
	 * @return Bat
	 */
	public function consultar($valor){
		$oBatBD = new BatBD();	
		return $oBatBD->consultar($valor);
	}

	/**
	 * Total de registros de Bat
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBatBD = new BatBD();
		return $oBatBD->totalColecao();
	}

}