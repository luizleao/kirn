<?php
class ControllerENDERECO extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar ENDERECO
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formENDERECO($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormENDERECO($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oCIDADE = new CIDADE($CIDADE_id);
		$oENDERECO = new ENDERECO($id,$rua,$bairro,$cep,$numero,$complemento,$oCIDADE);
		$oENDERECOBD = new ENDERECOBD();
		if(!$oENDERECOBD->cadastrar($oENDERECO)){
			$this->msg = $oENDERECOBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de ENDERECO
	 *
	 * @access public
	 * @param ENDERECO $oENDERECO
	 * @return bool
	 */
	public function alterar($oENDERECO = NULL){
		if($oENDERECO == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formENDERECO(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormENDERECO($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oCIDADE = new CIDADE($CIDADE_id);
			$oENDERECO = new ENDERECO($id,$rua,$bairro,$cep,$numero,$complemento,$oCIDADE);
		}		
		$oENDERECOBD = new ENDERECOBD();
		if(!$oENDERECOBD->alterar($oENDERECO)){
			$this->msg = $oENDERECOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir ENDERECO
	 *
	 * @access public
	 * @param integer $idENDERECO
	 * @return bool
	 */
	public function excluir($idENDERECO){		
		$oENDERECOBD = new ENDERECOBD();		
		if(!$oENDERECOBD->excluir($idENDERECO)){
			$this->msg = $oENDERECOBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de ENDERECO
	 *
	 * @access public
	 * @param integer $id
	 * @return ENDERECO
	 */
	public function get($id){
		$oENDERECOBD = new ENDERECOBD();
		if($oENDERECOBD->msg != ''){
			$this->msg = $oENDERECOBD->msg;
			return false;
		}
		if(!$obj = $oENDERECOBD->get($id)){
		    $this->msg = $oENDERECOBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de ENDERECO
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return ENDERECO[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oENDERECOBD = new ENDERECOBD();
			$aux = $oENDERECOBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oENDERECOBD->msg != ''){
				$this->msg = $oENDERECOBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de ENDERECO
	 *
	 * @access public
	 * @param string $valor
	 * @return ENDERECO
	 */
	public function consultar($valor){
		$oENDERECOBD = new ENDERECOBD();	
		return $oENDERECOBD->consultar($valor);
	}

	/**
	 * Total de registros de ENDERECO
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oENDERECOBD = new ENDERECOBD();
		return $oENDERECOBD->totalColecao();
	}

}