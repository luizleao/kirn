<?php
class ControllerPais extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Pais
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPais($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPais($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oPais = new Pais($id,$nome,$sigla);
		$oPaisBD = new PaisBD();
		if(!$oPaisBD->cadastrar($oPais)){
			$this->msg = $oPaisBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Pais
	 *
	 * @access public
	 * @param Pais $oPais
	 * @return bool
	 */
	public function alterar($oPais = NULL){
		if($oPais == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPais(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPais($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oPais = new Pais($id,$nome,$sigla);
		}		
		$oPaisBD = new PaisBD();
		if(!$oPaisBD->alterar($oPais)){
			$this->msg = $oPaisBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Pais
	 *
	 * @access public
	 * @param integer $idPais
	 * @return bool
	 */
	public function excluir($idPais){		
		$oPaisBD = new PaisBD();		
		if(!$oPaisBD->excluir($idPais)){
			$this->msg = $oPaisBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Pais
	 *
	 * @access public
	 * @param integer $id
	 * @return Pais
	 */
	public function get($id){
		$oPaisBD = new PaisBD();
		if($oPaisBD->msg != ''){
			$this->msg = $oPaisBD->msg;
			return false;
		}
		if(!$obj = $oPaisBD->get($id)){
		    $this->msg = $oPaisBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Pais
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Pais[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPaisBD = new PaisBD();
			$aux = $oPaisBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPaisBD->msg != ''){
				$this->msg = $oPaisBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Pais
	 *
	 * @access public
	 * @param string $valor
	 * @return Pais
	 */
	public function consultar($valor){
		$oPaisBD = new PaisBD();	
		return $oPaisBD->consultar($valor);
	}

	/**
	 * Total de registros de Pais
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPaisBD = new PaisBD();
		return $oPaisBD->totalColecao();
	}

}